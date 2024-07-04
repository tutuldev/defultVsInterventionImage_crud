<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;


class CategoryController extends Controller
{
 public function AllCat(){
    // $categories = Category::all();
    // $categories = Category::latest()->paginate(3);
    // $categories = DB::table('categories')->get();
    $categories = DB::table('categories')->join('users','categories.user_id','users.id')->select('categories.*','users.name')->paginate(3);


    return view('admin.category.index',compact('categories'));
 }
 public function AddCat(Request $request){
    $request->validate([
        'category_name' => 'required|max:255',

    ],
    [
        'category_name.required' => 'please Input Category Name',
        'category_name.max' => 'please input less then 255 chars',

    ]);
// (1)insert with orm
    Category::insert([
        'category_name'=>$request->category_name,
        'user_id'=>Auth::user()->id,
        'created_at'=>Carbon::now(),
    ]);

    // (2)insert with query builder
    // $data = array();
    // $data['category_name']= $request->category_name;
    // $data['user_id']= Auth::user()->id;
    // DB::table('categories')->insert($data);
return Redirect()->back()->with('success','Category Inserted');

// (3)another way with orm
    // $category = new Category;
    // $category->category_name =$request->category_name;
    // $category->user_id =Auth::user()->id;
    // $category->save();

 }

//  edit
public function Edit($id){
    // orm
    // $categories= Category::find($id);
    $categories= DB::table('categories')->where('id',$id)->first();
    return view('admin.category.edit',compact('categories'));
}
// update
public function update(Request $request,$id){
    $request->validate([
        'category_name' => 'required|max:255',

    ],
    [
        'category_name.required' => 'please Input Category Name',
        'category_name.max' => 'please input less then 255 chars',

    ]);
//     $update = Category::find($id)->update([
//         'category_name'=>$request->category_name,
//         'user_id'=>Auth::user()->id
// ]);

$data = array();
$data['category_name']=$request->category_name;
$data['user_id']=Auth::user()->id;

DB::table('categories')->where('id',$id)->update($data);
return Redirect()->route('all.category')->with('success','Category Updated');

}

public function pdelete($id){


    $delete = Category::find($id)->forceDelete();
return Redirect()->back()->with('success','Category Deleted');

}

}
