<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;
use Image;
use Session;

class CategoryController extends Controller
{
    public function categories(){
        Session::put('page', 'categories');
        $categories = Category::get();
        return view('admin.categories.categories')->with(compact('categories'));
    }
    public function updateCategoryStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $id = $data['category_id'];
            $status;
            if($data['status']=="Active"){
                $status = 0;
            }elseif($data['status']=="Inactive"){
                $status = 1;
            }
            $category = Category::where('id', $id)->update([
                'status'=> $status
            ]);
            return response()->json([
                'status'=> $status,
                'category_id'=> $id
            ]);
        }
    }
    public function addEditCategory(Request $request, $id=null){


        if($id==""){
            $title = "Add Category";
            //add category functionality
            $category = new Category;

        }else{

            $title = "Edit Category";
            //edit category functionality

        }
        if($request->isMethod('post')){

            $data = $request->all();

            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'parent_id' => 'required',
                'category_image'=>'image'
            ];

            $customMessages = [
                'name.required' => 'Category Name is Required',
                'name.regex' => 'Valid Category Name is Required',
                'parent_id.required' => 'Section is Required',
                'url.required' => 'Valid URL is Required', 
                'category_image.image' => 'Valid Image is Required'
            ];
            //dd($request->hasFile('category_image'));

            $this->validate($request,$rules,$customMessages);

            $category->category_name =      $data['name'];
            $category->parent_id =          $data['parent_id'];
            $category->section_id =         $data['section'];
            $category->category_image =     $data['category_image'];
            $category->category_discount =  $data['category_discount'];
            $category->url =                $data['category_url'];
            $category->description =        $data['description'];
            $category->meta_description =   $data['meta_description'];
            $category->meta_title =         $data['meta_title'];
            $category->meta_keywords =      $data['meta_keywords'];
            $category->status =             1;

            //dd($request->hasFile('category_image'));
            if($request->hasFile('category_image')){
                $img_temp = $request->file('category_image');
                if($img_temp->isValid()){
                    $extension = $img_temp->getClientOriginalExtension();
                    $imageName = rand(1111,99999).'.'.$extension;
                    $imagePath = public_path('/images/category_image/').$imageName;
                    //upload the image
                    Image::make($img_temp)->save($imagePath);
                }else if(!empty($data['current_category_image'])){
                    $imageName = $data['current_category_image'];
                }else{
                    $imageName= "";
                }
                $category->category_image = $imageName;
            }
            $category->save();
            //dd($data);
        }
        //get sections
        $getSections = Section::get();
        $getLevels = [];

        return view('admin.categories.add_edit_category')->with(compact('title','getSections','getLevels'));

    }
}
