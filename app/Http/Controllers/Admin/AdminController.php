<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Auth;
use Session;
class AdminController extends Controller
{
    //
    public function dashboard(){
    	return view('admin.admin_dashboard');
    }
    public function login(Request $request){
    	// echo $password = Hash::make('123'); die;
    	if ($request->isMethod('post')) {
    		$data = $request->all();
    		// echo "<pre>";
    		// print_r($data);
    		// echo "</pre>";
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
}
