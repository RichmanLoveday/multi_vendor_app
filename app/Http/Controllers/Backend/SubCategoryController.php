<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function AllSubCategory()
    {
        $subCategories = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_all', compact('subCategories'));
    }


    public function AddSubCategory()
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('backend.subcategory.subcategory_add', compact('categories'));
    }

    public function StoreSubCategory(Request $request)
    {
        // $request->validate([
        //     'subcategory_name' => 'required',
        //     'category_id' => 'required,'
        // ]);


        //? insert brand to db
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
            'created_at' => now(),
        ]);


        //? notification message
        $notification = [
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success',
        ];


        return redirect()->route('all.subcategory')->with($notification);
    }

    public function EditSubCategory(string $subcatID)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($subcatID);

        return view('backend.subcategory.subcategory_edit', compact('categories', 'subcategory'));
    }


    public function UpdateSubCategory(Request $request)
    {
        $subcat_id = $request->id;

        //? update sub category
        SubCategory::findOrFail($subcat_id)->update([
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
            'updated_at' => now(),
        ]);


        //? notification message
        $notification = [
            'message' => 'SubCategory Updated Successfully Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.subcategory')->with($notification);
    }

    public function DeleteSubCategory($id)
    {
        SubCategory::findOrFail($id)->delete();

        $notification = [
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
