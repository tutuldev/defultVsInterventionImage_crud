<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Laravel\Facades\Image;


class ProductController extends Controller
{
    public function AllProduct(){
        $products = Product::latest()->paginate(3);
    // $products = Product::all();

        return view('admin.product.index', compact('products'));
       }

       // store
   public function Addproduct(Request $request){


    // dd($request->product_name);


    $request->validate([
        'product_name' => 'required|max:255',
        'product_image' => 'required|mimes:jpg,bmp,png,jpeg,svg,gif|max:2048',

    ],
    [
        'product_name.required' => 'please Input Product Name',
        'product_image.mimes' => 'please input jpg,or bmp and pnd',

    ]);




    // $product_image = $request->file('product_image');

    // this code is not need when we use image intervention image package

    // $name_gen = hexdec(uniqid());
    // $img_ext = strtolower($product_image->getClientOriginalExtension());
    // $img_name = $name_gen.'.'.$img_ext;
    // $up_location = 'img/product/';
    // $last_img = $up_location.$img_name;
    // $product_image->move($up_location,$img_name);

    // with intervention 2
    // $name_gen = hexdec(uniqid()).'.'.$product_image->getClientOriginalExtension();
    // Image::make($brand_image)->resize(200,200)->save('img/product/'.$name_gen);
    // $last_img = 'img/product/'.$name_gen;

// with intervention 3
    // if($request->hasfile('product_image')){
    //     $manager = new ImageManager(new Driver());
    //     $new_name = $request->product_image.".".$request->file('product_image')->getClientOriginalExtension();
        // $img = $manager->read($request->file('product_image'));
        // $img->toJpeg(80)->save(base_path('public/img/product/'.$new_name));
    // }

// upload
$image = $request->file('product_image');
// generate unic name
$imageName = time().'.'.$image->getClientOriginalExtension();
// upload image in public detectory

$image->move('img/product', $imageName);

// now resize and save another derectory but move file already uplode reail image
$ImageManager = new ImageManager(new Driver());
// reading uploaded image from local file system(uploads)
// $ImageManager->read('uploads/.$imageName');
// uporer file ta ke ekta variabe a neya jabe
$thumbImage = $ImageManager->read('img/product/'.$imageName);
// now final resizing
// $thumbImage->resize(250, 250);
// resize diye sudu resize hoi but cover diye crop and resize are both work
$thumbImage->cover(250, 250);
// store the resize image in different directory
// note save funcion cant create file so we must manualy create file before-----------------||||||
// $thumbImage->save(public_path('img/product/thumbnails/'.$imageName));
// store another variable to use success alert easly
$response= $thumbImage->save(public_path('img/product/thumbnails/'.$imageName));

// its use for debuging
// dd($imageName,$request->product_image);
    Product::insert([
        'product_name' => $request->product_name,
        'product_image' => $imageName,
        'created_at' => Carbon::now()
    ]);

    return redirect()->route('all.product')->with('success','product Inserted');
   }

// if($response){
//     // when success
//     return back()->with('success','Image uploaded and resized successfully');
// }
// return back()->with('error',' Unable to  uploaded and resized successfully');



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
    $img = Product::find($id);
    $old_img='img/product/'.$img->product_image;
    $old_edited_img = 'img/product//thumbnails/'.$img->product_image;
    if($product_image){
     $image = $request->file('product_image');
// generate unic name
$imageName = time().'.'.$image->getClientOriginalExtension();
// upload image in public detectory
$image->move('img/product', $imageName);
$ImageManager = new ImageManager(new Driver());
$thumbImage = $ImageManager->read('img/product/'.$imageName);
$thumbImage->cover(250, 250);
$response= $thumbImage->save(public_path('img/product/thumbnails/'.$imageName));

  unlink($old_img);
    unlink($old_edited_img);
    Product::find($id)->update([

        'product_name' => $request->product_name,
        'product_image' => $imageName,
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
    $old_img='img/product/'.$img->product_image;
    $old_edited_img = 'img/product//thumbnails/'.$img->product_image;
    unlink($old_img);
    unlink($old_edited_img);
    Product::find($id)->delete();
    return redirect()->route('all.product')->with('success','Product Deleted');

   }

}
