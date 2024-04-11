<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Gumlet\ImageResize;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function AllProducts()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }


    public function AddProduct()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        //dd($brands);
        $activeVendors = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        return view('backend.product.add_product', compact('brands', 'categories', 'activeVendors'));
    }

    public function StoreProduct(Request $request)
    {
        // dd($request);
        // die;
        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        //? resize image 
        $resizer = new ImageResize($image);
        $resizer->resize(800, 800);
        $resizer->save('upload/products/thambnail/' . $name_gen);

        $save_url = 'upload/products/thambnail/' . $name_gen;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'vendor_id' => $request->vendor_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'product_price' => $request->selling_price,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'product_thambnail' => $save_url,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_deals' => $request->special_deals,
            'special_offers' => $request->special_offers,
            'status' => 1,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'created_at' => now(),
        ]);


        //? Upload multi image data
        $images = $request->file('multi_img');

        //? loop through and add multi image
        foreach ($images as $img) {
            $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();

            //? resize image 
            $resizer = new ImageResize($img);
            $resizer->resize(1100, 1100);
            $resizer->save('upload/products/multi-image/' . $name_gen);

            $uploadPath = 'upload/products/multi-image/' . $name_gen;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => now(),
            ]);
        }


        $notification = [
            'message' => 'Product inserted successfully',
            'alert-type' => 'success',
        ];


        return redirect()->route('all.product')->with($notification);
    }



    public function EditProduct($productID)
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $activeVendors = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        $products = Product::findOrFail($productID);
        $subCategories = SubCategory::latest()->get();
        $multiImages = MultiImg::where('product_id', $productID)->latest()->get();

        return view('backend.product.edit_product', compact(
            'brands',
            'categories',
            'activeVendors',
            'products',
            'subCategories',
            'multiImages',
        ));
    }


    public function UpdateProduct(Request $request)
    {
        // dd($request);
        // die;
        $product_id = $request->id;

        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'vendor_id' => $request->vendor_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'product_price' => $request->selling_price,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_deals' => $request->special_deals,
            'special_offers' => $request->special_offers,
            'status' => 1,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'created_at' => now(),
        ]);


        $notification = [
            'message' => 'Product Updated Without Image Succesfully',
            'alert-type' => 'success',
        ];


        return redirect()->route('all.product')->with($notification);
    }


    public function UpdateProductThambnail(Request $request)
    {
        // dd($request);
        // die;
        $pro_id = $request->id;
        $old_image = $request->old_image;

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        //? resize image 
        $resizer = new ImageResize($image);
        $resizer->resize(800, 800);
        $resizer->save('upload/products/thambnail/' . $name_gen);

        $save_url = 'upload/products/thambnail/' . $name_gen;

        //? unlink old image
        if (file_exists($old_image))
            unlink($old_image);


        //? Update product thumbnail
        Product::findOrFail($pro_id)->update([
            'product_thambnail' => $save_url,
            'updated_at' => now(),
        ]);


        $notification = [
            'message' => 'Product Image Thambnail Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.product')->with($notification);
    }

    public function UpdateProductMultiImage(Request $request)
    {
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();

            //? resize image 
            $resizer = new ImageResize($img);
            $resizer->resize(800, 800);
            $resizer->save('upload/products/multi-image/' . $name_gen);

            $uploadPath = 'upload/products/multi-image/' . $name_gen;

            //? update image
            MultiImg::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => now()
            ]);
        }


        $notification = [
            'message' => 'Product Multi Image Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
