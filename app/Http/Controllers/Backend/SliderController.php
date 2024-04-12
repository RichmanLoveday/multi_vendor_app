<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Gumlet\ImageResize;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function AllSlider()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_all', compact('sliders'));
    }

    public function AddSlider()
    {
        return view('backend.slider.slider_add');
    }

    public function StoreSlider(Request $request)
    {
        // dd($request);
        // die;

        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        //? resize image 
        $resizer = new ImageResize($image);
        $resizer->resize(120, 120);
        $resizer->save('upload/slider/' . $name_gen);

        $save_url = 'upload/slider/' . $name_gen;

        //? insert brand to db
        Slider::insert([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url,
            'created_at' => now(),
        ]);


        //? notification message
        $notification = [
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success',
        ];


        return redirect()->route('all.slider')->with($notification);
    }


    public function EditSlider($id)
    {
        $sliders = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('sliders'));
    }


    public function UpdateSlider(Request $request)
    {
        // dd($request);
        // die;
        $slider_id = $request->id;
        $old_image = $request->old_image;

        //? check if image exist
        if ($request->file('slider_image')) {
            $slider_image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();


            //? resize image 
            $resizer = new ImageResize($slider_image);
            $resizer->resize(120, 120);
            $resizer->save('upload/slider/' . $name_gen);

            $save_url = 'upload/slider/' . $name_gen;


            //? update slider
            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $save_url,
                'updated_at' => now(),
            ]);

            //? unlink images
            if (file_exists($old_image)) {
                @unlink($old_image);
            }


            $notification = [
                'message' => 'Slider updated successfully with image',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.slider')->with($notification);
        } else {
            //? update slider
            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'updated_at' => now(),
            ]);


            $notification = [
                'message' => 'Slider updated successfully without image',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.slider')->with($notification);
        }
    }


    public function SliderDelete($id)
    {
        $slider_image = Slider::findOrFail($id)->slider_image;

        if (file_exists($slider_image)) {
            @unlink($slider_image);
        }

        Slider::findOrFail($id)->delete();

        $notification = [
            'message' => 'Slider deleted successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}