<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Admin;
use Intervention\Image\ImageManagerStatic as Image;
use Hash;
use Auth;
use Session;

class AdminController extends Controller
{ 

    public function dashboard(){
        Session::put('page', 'dashboard'); 
        return view('admin.admin_dashboard');
    }

    public function settings(Request $request){ 
        //echo "<pre>"; print_r(Auth::guard('admin')->user()); die;
        Session::put('page', 'settings');
    //dd($request);
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        //dd($adminDetails);
        if($request->isMethod('post')){

        }
        return view('admin.admin_settings')->with(compact('adminDetails'));

    }

    public function checkCurrentPw(Request $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data); 
        //echo print_r(Auth::guard('admin')->user()->password); die;
        if(Hash::check($data['password'], Auth::guard('admin')->user()->password)){
            echo "true";
        }else{
            echo "false";
        }
    }
    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if(Hash::check($data['password'], Auth::guard('admin')->user()->password)){
                if($data['new-password'] !== $data['confirm-password']){
                    Session::flash('error_message', 'Both new passwords do not match.');
                    return redirect()->back();
                } 
                if(Hash::check($data['new-password'], Auth::guard('admin')->user()->password)){
                    Session::flash('error_message', 'The current password should not match the new password.');
                    return redirect()->back();
                }
                if($data['new-password'] === $data['confirm-password'] && $data['new-password'] != ""){
                     Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new-password'])]);
                     Session::flash('success_message', 'Your password has been updated.');
                     return redirect()->back();
                }  
            }else{
                Session::flash('error_message', 'Your current password is incorrect.');
                return redirect()->back();
            }
        }
    }
    public function update(Request $request){
        Session::put('page', 'update-admin-details');

        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();

        if($request->isMethod('post')){

            $data= $request->all();

            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u', 
                'admin_mobile' => 'required|numeric',
                //'admin_image' => 'image'
            ];

            $customMessages = [ 
                'admin_name.required'=> "Name is required",
                'admin_name.alpha' => "Valid name is required",
                'admin_mobile.required' => "Mobile # is required",
                'admin_mobile.numeric' => "Valid Mobile # required",
                'admin_image.required' => "Admin Image is required"

            ];
            $this->validate($request, $rules, $customMessages); 

            if($request->hasFile('admin_image')){
                $img_temp = $request->file('admin_image'); 
                if($img_temp->isValid()){
                    $extension = $img_temp->getClientOriginalExtension();
                    $imageName = rand(1111,99999).'.'.$extension;
                    $imagePath = public_path('/images/admin_image/').$imageName;
                    //upload the image
                    Image::make($img_temp)->save($imagePath);
                }else if(!empty($data['current_admin_image'])){
                    $imageName = $data['current_admin_image'];
                }else{
                    $imageName= "";
                }
            }

            Admin::where('id', Auth::guard('admin')->user()->id)->update([
                'name'=> $data['admin_name'],
                'mobile' => $data['admin_mobile'],
                'image' => $imageName
            ]);

            Session::flash('success_message', 'Admin details updated successfully!');

            return redirect()->back();

        }

        return view('admin.update_admin_details')->with(compact('adminDetails'));

    }

    public function login(Request $request){
        //echo $password = Hash::make('dummypassword'); die;
        if($request->isMethod('post')){

            $data= $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessages = [
                'email.required' => 'We need to know your e-mail address!',
                'email.email' => 'Valid email is required',
                'password.required' => 'Password is required'
            ];

            //$validator = Validator::make($request, $rules, $customMessages);
            $this->validate($request, $rules, $customMessages);
            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                Session::put('page', 'dashboard');

                return redirect('admin/dashboard');

            }else{

                $request->session()->flash('error_message','Invalid email or password.');

                return redirect()->back();
            
            }
            //echo "<pre>"; print_r($data); die;
        }
        return view('admin.admin_login');
    }



    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->back();  
    }

}
