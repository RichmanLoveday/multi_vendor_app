<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class VendorController extends Controller
{
    public function VendorDashboard()
    {
        return view('vendor.index');
    }


    public function VendorRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'vendor_join' => $request->vendor_join,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'status' => 'inactive',
        ]);

        $notification = [
            'message' => 'Vendor Registered Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('vendor.login')->with($notification);
    }


    public function VendorLogin()
    {
        return view('Vendor.vendor_login');
    }


    public function VendorProfile()
    {
        //? get login user data
        $id = Auth::user()->id;
        $vendorData = User::findOrFail($id);
        return view('vendor.vendor_profile', compact('vendorData'));
    }


    public function VendorProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::findOrFail($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->vendor_join = $request->vendor_join;
        $data->vendor_short_info = $request->vendor_short_info;

        //? check if file or image was uploaded
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/vendor_images/' . $data->photo));        //? unlink prev image

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/vendor_images'), $filename);
            $data['photo'] = $filename;
        }

        //? save data to db
        $data->save();

        $notification = [
            'message' => 'Vendor Profile Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }


    public function VendorChangePassword()
    {
        return view('vendor.vendor_change_password');
    }

    public function VendorUpdatePassword(Request $request)
    {

        //? validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        //? Match old password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->with('error', "Old Password Doesn't Match");
        }


        //? Update new password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);


        return back()->with('status', 'Password Changed Successfully');
    }


    public function VendorDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    }

    public function BecomeVendor()
    {
        return view('auth.become_vendor');
    }
}
