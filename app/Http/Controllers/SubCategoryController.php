<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SubCategory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Laravel\Facades\Image;


class SubCategoryController extends Controller
{
    public function AllSubCat(){
        $subcategories = SubCategory::latest()->paginate(3);
    // $products = Product::all();
        return view('admin.subcategory.index', compact('subcategories'));
       }
       // store
   public function AddSubCat(Request $request){
    // for debaging
    // dd($request->subcategory_image);
    $request->validate([
        'subcategory_name' => 'required|max:255',
        'subcategory_image' => 'required|mimes:jpg,bmp,png,jpeg,svg,gif|max:2048',
    ],
    [
        'subcategory_name.required' => 'please Input Product Name',
        'subcategory_image.mimes' => 'please input jpg,or bmp and pnd',
    ]);

// with intervention 3
// upload
$image = $request->file('subcategory_image');
// generate unic name
$imageName = time().'.'.$image->getClientOriginalExtension();
// upload image in public detectory
$image->move('img/subcategory', $imageName);
// now resize and save another derectory but move file already uplode reail image
$ImageManager = new ImageManager(new Driver());
$thumbImage = $ImageManager->read('img/subcategory/'.$imageName);
$thumbImage->cover(250, 250);
$response= $thumbImage->save(public_path('img/subcategory/thumbnails/'.$imageName));
// its use for debuging
// dd($imageName,$request->subcategory_image);
SubCategory::insert([
        'subcategory_name' => $request->subcategory_name,
        'subcategory_image' => $imageName,
        'created_at' => Carbon::now()
    ]);
    return redirect()->route('all.subcategory')->with('success','Subcategory Inserted');
   }
// Edit
public function Edit($id){
    $subcategories = SubCategory::find($id);
    return view('admin.subcategory.edit',compact('subcategories'));
}
// updata
public function Update(Request $request,$id){
    $request->validate([
        'subcategory_name' => 'required|max:255',
        'subcategory_image' => 'required|mimes:jpg,bmp,png',
    ],
    [
        'subcategory_name.required' => 'please Input Product Name',
        'subcategory_image.mimes' => 'please input jpg,or bmp and pnd',
    ]);

    $subcategory_image = $request->file('subcategory_image');
    $img = SubCategory::find($id);
    $old_img='img/subcategory/'.$img->subcategory_image;
    $old_edited_img = 'img/subcategory//thumbnails/'.$img->subcategory_image;
    if($subcategory_image){
     $image = $request->file('subcategory_image');
// generate unic name
$imageName = time().'.'.$image->getClientOriginalExtension();
$image->move('img/subcategory', $imageName);
$ImageManager = new ImageManager(new Driver());
$thumbImage = $ImageManager->read('img/subcategory/'.$imageName);
$thumbImage->cover(250, 250);
$response= $thumbImage->save(public_path('img/subcategory/thumbnails/'.$imageName));

  unlink($old_img);
    unlink($old_edited_img);
    SubCategory::find($id)->update([

        'subcategory_name' => $request->subcategory_name,
        'subcategory_image' => $imageName,
        'created_at' => Carbon::now()
    ]);
    }
    else{
        SubCategory::find($id)->update([

            'subcategory_name' => $request->subcategory_name,
            'created_at' => Carbon::now()
        ]);


    }
    return redirect()->route('all.subcategory')->with('success','Subcategory Updated');
   }
// Delete
public function Delete($id){

    $img = SubCategory::find($id);
    $old_img='img/subcategory/'.$img->subcategory_image;
    $old_edited_img = 'img/subcategory//thumbnails/'.$img->subcategory_image;
    unlink($old_img);
    unlink($old_edited_img);
    SubCategory::find($id)->delete();
    return redirect()->route('all.subcategory')->with('success','Subcategory Deleted');

   }
}
