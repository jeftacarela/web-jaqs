<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    //
    public function index()
    {
        if(Gate::allows('isAdmin')){
            $user = DB::table('users')->get();
           return view('usermanagement.usercontroller',compact('user'));
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }
    // view detail 
    public function viewDetail($id)
    {  
        if(Gate::allows('isAdmin')){
            if (Auth::user()->role_name=='Team Member')
            {
                $data = DB::table('users')->where('id',$id)->get();
                $roleName = DB::table('role_type_users')->get();
                $userStatus = DB::table('user_types')->get();
                return view('usermanagement.view_users',compact('data','roleName','userStatus'));
            }
            else
            {
                return redirect()->route('home');
            }
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }
    //
    public function addNew()
    {
        if(Gate::allows('isAdmin')){
            return view('usermanagement.add_new_user');
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }
    // save new user
    public function addNewUserSave(Request $request)
    {
        if(Gate::allows('isAdmin')){
            $request->validate([
                'name'      => 'required|string|max:255',
                //    'image'     => 'required|image',
                'email'     => 'required|string|email|max:255|unique:users',
                'phone'     => 'required|min:11|numeric',
                'role_name' => 'required|string|max:255',
                'password'  => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
            ]);

            //    $image = time().'.'.$request->image->extension();  
            //    $request->image->move(public_path('images'), $image);

            $user = new User;
            $user->name         = $request->name;
            //    $user->avatar       = $image;
            $user->email        = $request->email;
            $user->phone        = $request->phone;
            $user->role_name    = $request->role_name;
            $user->password     = Hash::make($request->password);
            $user->save();
            Toastr::success('Created New Account','Success');
            return redirect()->route('user/management');
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
   }
   
   // update
   public function update(Request $request)
   {
       if(Gate::allows('isAdmin')){
            $id           = $request->id;
            $name         = $request->name;
            $email        = $request->email;
            $phone        = $request->phone ;
            //    $status       = $request->status;
            $role_name    = $request->role_name;

            //    $old_image = User::find($id);
            //    $image_name = $request->hidden_image;
            //    $image = $request->file('image');

            //    if($old_image->avatar=='photo_defaults.jpg')
            //    {
            //        if($image != '')
            //        {
            //            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            //            $image->move(public_path('images'), $image_name);
            //        }
            //    }
            //    else{
                
            //        if($image != '')
            //        {
            //            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            //            $image->move(public_path('images'), $image_name);
            //            unlink('images/'.$old_image->avatar);
            //        }
            //    }
            
            $update = [

                'id'           => $id,
                'name'         => $name,
                //    'avatar'       => $image_name,
                'email'        => $email,
                'phone' => $phone ,
                //    'status'       => $status,
                'role_name'    => $role_name,
            ];
            User::where('id',$request->id)->update($update);
            Toastr::success('User Updated','Success');
            return redirect()->route('user/management');
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
   }

   // delete
   public function delete($id)
   {
       if(Gate::allows('isAdmin')){
            $delete = User::find($id);
            //    unlink('images/'.$delete->avatar);
            $delete->delete();
            Toastr::success('User Deleted','Success');
            return redirect()->route('user/management');
       } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
   }

   // view admin profile only (my profile)
   public function showProfile()
    {
        if(Gate::allows('isAdmin')){
            $user = Auth::user();
            return view('usermanagement.showProfile', compact('user'));
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

    public function viewProfile($id)
    {
        if(Gate::allows('isAdmin')){
            // $orang = User::findorfail($id);
            // $user = Auth::user();
            $orang = DB::table('users')->where('id', $id)->get();
            return view('usermanagement.viewProfile', compact('orang'));
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
    }

   // view change password
   public function changePassword($id)
   {
       if(Gate::allows('isAdmin')){
            $orang = DB::table('users')->where('id', $id)->get();
            return view('usermanagement.change_password', compact('orang'));
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
   }
   
   // change password in db
   public function updatePassword(Request $request)
   {
       if(Gate::allows('isAdmin')){
            $request->validate([
                'password' => ['required', new MatchOldPassword],
                'new_password' => ['required'],
                'new_confirm_password' => ['same:new_password'],
            ]);

                User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
                Toastr::success('Password Changed :)','Success');
                return redirect()->route('admin/profile');
        } else {
            Toastr::error('ADMIN ONLY');
            return redirect()->back();
        }
   }
}
