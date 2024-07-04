<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function AllProduct(){
        $products = Product::latest()->paginate(3);
    // $products = Product::all();

        return view('admin.product.index', compact('products'));
       }

       // store
   public function Addproduct(Request $request){
    $request->validate([
        'product_name' => 'required|max:255',
        'product_image' => 'required|mimes:jpg,bmp,png',

    ],
    [
        'product_name.required' => 'please Input Product Name',
        'product_image.mimes' => 'please input jpg,or bmp and pnd',

    ]);

    $product_image = $request->file('product_image');

    $name_gen = hexdec(uniqid());
    $img_ext = strtolower($product_image->getClientOriginalExtension());
    $img_name = $name_gen.'.'.$img_ext;
    $up_location = 'img/product/';
    $last_img = $up_location.$img_name;
    $product_image->move($up_location,$img_name);

    Product::insert([

        'product_name' => $request->product_name,
        'product_image' => $last_img,
        'created_at' => Carbon::now()
    ]);

    return redirect()->route('all.product')->with('success','product Inserted');
   }
// Edit
public function Edit($id){
    $products = Product::find($id);
    return view('admin.product.edit',compact('products'));
}

// updata
public function Update(Request $request,$id){
    $request->validate([
        'product_name' => 'required|max:255',
        // 'product_image' => 'required|mimes:jpg,bmp,png',

    ],
    [
        'product_name.required' => 'please Input Product Name',
        // 'product_image.mimes' => 'please input jpg,or bmp and pnd',

    ]);

    $product_image = $request->file('product_image');
    $old_img = $request->old_image;
    if($product_image){
    $name_gen = hexdec(uniqid());
    $img_ext = strtolower($product_image->getClientOriginalExtension());
    $img_name = $name_gen.'.'.$img_ext;
    $up_location = 'img/product/';
    $last_img = $up_location.$img_name;
    $product_image->move($up_location,$img_name);
    unlink($old_img);
    Product::find($id)->update([

        'product_name' => $request->product_name,
        'product_image' => $last_img,
        'created_at' => Carbon::now()
    ]);
    }
    else{
        Product::find($id)->update([

            'product_name' => $request->product_name,
            'created_at' => Carbon::now()
        ]);


    }
    return redirect()->route('all.product')->with('success','Product Updated');
   }
// Delete
public function Delete($id){
    $img = Product::find($id);
    $old_img=$img->product_image;
    unlink($old_img);
    Product::find($id)->delete();
    return redirect()->route('all.product')->with('success','Product Deleted');

   }

}
