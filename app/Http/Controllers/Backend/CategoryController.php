<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Gumlet\ImageResize;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_all', compact('categories'));
    }


    public function AddCategory()
    {
        return view('backend.category.category_add');
    }


    public function StoreCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_image' => 'required'
        ]);


        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        //? resize image 
        $resizer = new ImageResize($image);
        $resizer->resize(120, 120);
        $resizer->save('upload/category/' . $name_gen);

        $save_url = 'upload/category/' . $name_gen;

        //? insert brand to db
        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'category_image' => $save_url,
            'created_at' => now(),
        ]);


        //? notification message
        $notification = [
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success',
        ];


        return redirect()->route('all.category')->with($notification);
    }


    public function EditCategory(string $categoryID)
    {
        $category = Category::findOrFail($categoryID);
        return view('backend.category.category_edit', compact('category'));
    }

    public function UpdateCategory(Request $request)
    {
        $category_id = $request->id;
        $old_image = $request->old_image;

        //? validate inputs
        $request->validate([
            'category_name' => 'required',
        ]);


        if ($request->file('category_image')) {
            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            //? resize image 
            $resizer = new ImageResize($image);
            $resizer->resize(120, 120);
            $resizer->save('upload/category/' . $name_gen);

            $save_url = 'upload/category/' . $name_gen;

            //? unlink images
            if (file_exists($old_image)) {
                @unlink($old_image);
            }

            //? update category with image
            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => $save_url,
            ]);

            $notification = [
                'message' => 'Category Updated with image Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.category')->with($notification);
        } else {

            //? update category without image
            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            ]);


            $notification = [
                'message' => 'Category Updated without image Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.category')->with($notification);
        }
    }


    public function DeleteCategory(string $categoryID)
    {
        //? access brand 
        $category = Category::findOrFail($categoryID);
        $img = $category->category_image;

        //? unlink images
        @unlink($img);

        //? delete brand based on id
        Category::findOrFail($categoryID)->delete();

        $notification = [
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
