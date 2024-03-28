<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Gumlet\ImageResize;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all', compact('brands'));
    }


    public function AddBrand()
    {

        return view('backend.brand.brand_add');
    }


    public function StoreBrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required',
            'brand_image' => 'required'
        ]);


        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        //? resize image 
        $resizer = new ImageResize($image);
        $resizer->resize(300, 300);
        $resizer->save('upload/brand/' . $name_gen);

        $save_url = 'upload/brand/' . $name_gen;

        //? insert brand to db
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $save_url,
            'created_at' => now(),
        ]);


        //? notification message
        $notification = [
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success',
        ];


        return redirect()->route('all.brand')->with($notification);
    }


    public function EditBrand(string $brandID)
    {
        $brand = Brand::findOrFail($brandID);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function UpdateBrand(Request $request)
    {
        $brand_id = $request->id;
        $old_image = $request->old_image;

        //? validate inputs
        $request->validate([
            'brand_name' => 'required',
        ]);


        if ($request->file('brand_image')) {
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            //? resize image 
            $resizer = new ImageResize($image);
            $resizer->resize(300, 300);
            $resizer->save('upload/brand/' . $name_gen);

            $save_url = 'upload/brand/' . $name_gen;

            //? unlink images
            if (file_exists($old_image)) {
                @unlink($old_image);
            }

            //? update brand with image
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
            ]);

            $notification = [
                'message' => 'Brand Updated with image Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.brand')->with($notification);
        } else {

            //? update brand without image
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            ]);


            $notification = [
                'message' => 'Brand Updated without image Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.brand')->with($notification);
        }
    }

    public function DeleteBrand(string $brandID)
    {
        //? access brand 
        $brand = Brand::findOrFail($brandID);
        $img = $brand->brand_image;

        //? unlink images
        @unlink($img);

        //? delete brand based on id
        Brand::findOrFail($brandID)->delete();

        $notification = [
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
