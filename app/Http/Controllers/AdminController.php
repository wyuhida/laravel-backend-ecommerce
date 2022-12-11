<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function AdminLogout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function UserProfile(Request $request){
        $adminData = User::find(1);
        return view('backend.admin.admin_profile',compact('adminData'));
    }

    public function UserProfileStore(Request $request){
        $data = User::find(1);
        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        $notification = array(
            'message'=> 'User Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('user.profile')->with($notification);
    }

    public function ChangePassword(Request $request){
        return view('backend.admin.change_password');
    }

    public function ChangePasswordUpdate(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);



        $hashedPassword = User::find(1)->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
            $user = User::find(1);
            $user->password = Hash::make($request->password);
            $user->save();

            Auth::logout();
           

            return redirect()->route('admin.logout')->with($validateData);
        }else{
            return redirect()->route('admin.logout');
        }
    }

}
