<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Index(){
        return view('frontend.index');
    }

    public function ProfileStore(Request $request){
        $id = Auth::guard('web')->id();
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $oldPhotoPath =  $data->photo;

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'), $filename);
            $data->photo = $filename;

            if($oldPhotoPath && $oldPhotoPath !== $filename){
                $this->deleteOldImage($oldPhotoPath);
            }
        }
        $data->save();

        $notification = array(
            'message' => 'Profile updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    private function deleteOldImage(string $oldPhotoPath):void
    {
        $fullPath = public_path('upload/user_images').'/'.$oldPhotoPath;
        if(file_exists($fullPath)){
            unlink($fullPath);
        }
    }


    public function UserLogout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

    public function UserChangePassword(){
        return view('frontend.dashboard.change_password');
    }

    public function UserPasswordUpdate(Request $request){
        $user = Auth::guard('web')->user();
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required|confirmed'
        ]);

        if(!Hash::check($request->old_password,  $user ->password)){
            $notification = array(
                'message' => 'Old password does not match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        //Update the new password
        User::whereId($user ->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password updated successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }




}
