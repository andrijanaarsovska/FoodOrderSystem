<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\Websitemail;

class ClientController extends Controller
{
    public function ClientLogin(){
        return view('client.login');
    }

    public function ClientDashboard(){
        return view('client.index');
    }

    public function ClientRegister(){
        return view('client.client_register');
    }

    public function ClientLoginSubmit(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
        ];
        if (Auth::guard('client')->attempt($data)) {
            return redirect()->route('client.dashboard')->with('success','Login successfully');
        }
        else{
            return redirect()->route('client.login')->with('error','Invalid credentials');
        }
    }

    public function ClientRegisterSubmit(Request $request){
        $request->validate([
           'name'=> ['required', 'string', 'max:255'],
           'email'=> ['required', 'string', 'email', 'max:255', 'unique:clients'],
        ]);

        Client::insert([
           'name' => $request->name,
           'email' => $request->email,
           'phone' => $request->phone,
           'address' => $request->address,
           'password' => Hash::make($request->password),
           'role' => 'client',
            'status' => '0',
        ]);

        $notification = array(
            'message' => 'Client Registered Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('client.login')->with($notification);
    }

    public function ClientLogout(){
        Auth::guard('client')->logout();
        return redirect()->route('client.login')->with('success','Logout successfully');

    }

    public function ClientForgetPassword(){
        return view('client.forget_password');
    }

    public function ClientPasswordSubmit(Request $request){
        $request->validate([
            'email'=>'required|email',
        ]);
        $client_data = Client::where('email', $request->email)->first();

        if(!$client_data){
            return redirect()->back()->with('error','Invalid email!');
        }
        $token = hash('sha256', time());
        $client_data->token = $token;
        $client_data->update();

        $reset_link = url('client/reset_password/'.$token.'/'.$request->email);

        $subject = "Reset Password";
        $message = "Please use this link to reset your password";
        $message .= "<a href='".$reset_link."'>Reset Password</a>";


        \Mail::to($request->email)->send(new Websitemail($subject,$message));
        return redirect()->back()->with('success','Reset password email send successfully');
    }

    public function ClientResetPasswordSubmit(Request $request){
        $request->validate([
            'password'=>'required',
            'password_confirmation'=>'required|same:password',
        ]);

        $client_data = Client::where('email', $request->email)->where('token', $request->token)->first();

        $client_data->password = Hash::make($request->password);
        $client_data->token = "";
        $client_data->update();

        return redirect()->route('client.login')->with('success','Password reset successfully');

    }

    public function ClientResetPassword($token,$email){
        $client_data = Client::where('email', $email)->where('token', $token)->first();

        if(!$client_data){
            return redirect()->route('client.login')->with('error','Invalid token!');
        }
        return view('client.reset_password',compact('token','email'));
    }

    public function ClientProfile()
    {
        $city = City::latest()->get();
        $id = Auth::guard('client')->id();
        $profile_data = Client::find($id);
        return view('client.client_profile',compact('profile_data', 'city'));
    }

    public function ClientProfileStore(Request $request){
        $id = Auth::guard('client')->id();
        $data = Client::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->city_id = $request->city_id;
        $data->shop_info = $request->shop_info;

        $oldPhotoPath =  $data->photo;

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/client_images'), $filename);
            $data->photo = $filename;

            if($oldPhotoPath && $oldPhotoPath !== $filename){
                $this->deleteOldImage($oldPhotoPath);
            }
        }

        $oldPhotoPath =  $data->cover_photo;
        if($request->hasFile('cover_photo')){
            $file = $request->file('cover_photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/client_images'), $filename);
            $data->cover_photo = $filename;

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
        $fullPath = public_path('upload/client_images').'/'.$oldPhotoPath;
        if(file_exists($fullPath)){
            unlink($fullPath);
        }
    }


    public function ClientChangePassword()
    {
        $id = Auth::guard('client')->id();
        $profile_data = Client::find($id);
        return view('client.client_change_password',compact('profile_data'));
    }

    public function ClientPasswordUpdate(Request $request){
        $client = Auth::guard('client')->user();
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required|confirmed'
        ]);

        if(!Hash::check($request->old_password,  $client ->password)){
            $notification = array(
                'message' => 'Old password does not match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        //Update the new password
        Client::whereId($client ->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password updated successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }



}
