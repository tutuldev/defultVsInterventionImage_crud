<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;


class BrandController extends Controller
{
   public function AllBrand(){
    // $brands = Brand::lates()->paginate(5);
    $brands = Brand::latest()->paginate(3);
    // $brands = Brand::all();

    return view('admin.brand.index', compact('brands'));
   }
// store
   public function StoreBrand(Request $request){
    $request->validate([
        'brand_name' => 'required|max:255',
        'brand_image' => 'required|mimes:jpg,bmp,png',

    ],
    [
        'category_name.required' => 'please Input Category Name',
        'category_name.mimes' => 'please input jpg,or bmp and pnd',

    ]);

    $brand_image = $request->file('brand_image');

    $name_gen = hexdec(uniqid());
    $img_ext = strtolower($brand_image->getClientOriginalExtension());
    $img_name = $name_gen.'.'.$img_ext;
    $up_location = 'img/brand/';
    $last_img = $up_location.$img_name;
    $brand_image->move($up_location,$img_name);

    Brand::insert([

        'brand_name' => $request->brand_name,
        'brand_image' => $last_img,
        'created_at' => Carbon::now()
    ]);

    return redirect()->back()->with('success','Brand_image Inserted');
   }

//    edit
public function Edit($id){
    $brands = Brand::find($id);
    return view('admin.brand.edit',compact('brands'));
}
// update
public function update(Request $request,$id){
    $request->validate([
        'brand_name' => 'required|max:255',
        'brand_image' => 'mimes:jpg,bmp,png',

    ],
    [
        'category_name.required' => 'please Input Category Name',
        'category_name.mimes' => 'please input jpg,or bmp and pnd',

    ]);

    $brand_image = $request->file('brand_image');
    $old_img = $request->old_image;
    if($brand_image){

    $name_gen = hexdec(uniqid());
    $img_ext = strtolower($brand_image->getClientOriginalExtension());
    $img_name = $name_gen.'.'.$img_ext;
    $up_location = 'img/brand/';
    $last_img = $up_location.$img_name;
    $brand_image->move($up_location,$img_name);
    unlink($old_img);
    Brand::find($id)->update([

        'brand_name' => $request->brand_name,
        'brand_image' => $last_img,
        'created_at' => Carbon::now()
    ]);
    return redirect()->back()->with('success','Brand_image Edited');
    }else{
        Brand::find($id)->update([

            'brand_name' => $request->brand_name,
            'created_at' => Carbon::now()
        ]);
    return redirect()->back()->with('success','Brand_image Edited');

    }
   }

   public function Delete($id){
    $img = Brand::find($id);
    $old_img=$img->brand_image;
    unlink($old_img);
    Brand::find($id)->delete();
    return redirect()->back()->with('success','Brand Deleted');

   }
}
