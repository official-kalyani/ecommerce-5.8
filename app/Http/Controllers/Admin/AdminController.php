<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Auth;
use Session;
use App\Admin;
class AdminController extends Controller
{
    //
    public function dashboard(){
    	return view('admin.admin_dashboard');
    }
    public function settings(){
        // echo "<pre>";print_r(Auth::guard('admin')->user());echo "</pre>";exit();
        $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('admin.admin_settings')->with(compact('adminDetails'));
    }
    public function login(Request $request){
    	// echo $password = Hash::make('123'); die;
    	if ($request->isMethod('post')) {
    		$data = $request->all();
    		// echo "<pre>";
    		// print_r($data);
    		// echo "</pre>";
            $rules=[
                'email' => 'required|email',
                'password' => 'required',
            ];
            $customMessage = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid email is required',
                'password.required' => 'Password is required',
            ];
            $this->validate($request,$rules,$customMessage);
    		// $validatedData = $request->validate([
    			
		    // ]);
    		if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
    			return redirect('admin/dashboard');
    		}else{
    			Session::flash('error_message',"Invalid Email or Password");
    			return redirect()->back();
    		}
    	}
    	return view('admin.admin_login');
    }
    public function logout(){
    	Auth::guard('admin')->logout();
    	return redirect('/admin');
    }
    public function chkCurrentPassword(Request $request){
        $data = $request->all();
        // echo '<pre>';print_r($data);die();
        // echo Auth::guard('admin')->user()->password;die();
        if (Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)) {
           echo "true";
        }else{
            echo "false";
        }
    }
    public function updateCurrentPassword(Request $request){
        if ($request->isMethod('post')) {
            $data =$request->all();
            // echo '<pre>';print_r($data);die();
            //check current password is correct
            if (Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)) {
                // check if new password = confirm password
                if ($data['new_pwd'] == $data['confirm_pwd']) {
                   Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                   Session::flash('success_message','Password has been updated');
                }else{
                Session::flash('error_message','New Password not match with confirm Password');
                
                }

            }else{
                Session::flash('error_message','Your current password is incorrect');
                
            }
            return redirect()->back(); 
        }
    }
}

