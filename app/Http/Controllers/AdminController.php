<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminProfile()
    {
        //? get login user data
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile', compact('adminData'));
    }


    public function AdminStoreProfile(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::findOrFail($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        //? check if file or image was uploaded
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));        //? unlink prev image

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        //? save data to db
        $data->save();

        $notification = [
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }


    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request)
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

    public function InactiveVendor()
    {
        $inactiveVendor = User::where('status', 'inactive')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.inactive_vendor', compact('inactiveVendor'));
    }


    public function ActiveVendor()
    {
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.active_vendor', compact('activeVendor'));
    }

    public function InactiveVendorDetails(string $vendorID)
    {
        $inactiveVendorDetails = User::findOrFail($vendorID);
        return view('backend.vendor.inactive_vendor_details', compact('inactiveVendorDetails'));
    }

    public function ActiveVendorDetails(string $vendorID)
    {
        $activeVendorDetails = User::findOrFail($vendorID);
        return view('backend.vendor.active_vendor_details', compact('activeVendorDetails'));
    }


    public function ActiveVendorApprove(Request $request)
    {
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'active',
        ]);

        $notification = [
            'message' => 'Vendor Activated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('active.vendor')->with($notification);
    }

    public function InActiveVendorApprove(Request $request)
    {
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'inactive',
        ]);

        $notification = [
            'message' => 'Vendor Deactivated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('inactive.vendor')->with($notification);
    }


    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
