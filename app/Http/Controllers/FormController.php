<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformationForm;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class FormController extends Controller
{
    // index
    public function index()
    {
        $orang = User::all();
        return view('form.information_form', compact('orang'));
    }
    // save data
    public function saveRecord( Request $request)
    {
        $request->validate([
            'user_id'  => 'required',
            'company'       => 'required',
            'email'     => 'required|string|email|max:255',
            'phone'     => 'required|min:11|numeric',
            // 'image'     => 'required|image',
            // 'country'   => 'required|string|max:255',
        ]);

        // $image = time().'.'.$request->image->extension();  
        // $request->image->move(public_path('images'), $image);

        $form = new InformationForm;
        $form->user_id  = $request->user_id;
        $form->company   = $request->company;
        $form->email     = $request->email;
        $form->phone     = $request->phone;
        // $form->image     = $image;
        // $form->country   = $request->country;
        $form->save();
        Toastr::success('Insert data successfully :)','Success');
        return redirect()->route('form/information/show');
    }
    // show data table
    public function show()
    {
        // $data = DB::table('information_forms')->get();
        $data = InformationForm::latest()->get();
        return view('form.view_detail',compact('data'));
    }

    // view edit
    public function viewEdit($id)
    {
        // $data = DB::table('information_forms')->where('id',$id)->get();
        $data = InformationForm::find($id);
        $orang = User::all();
        return view('form.view_edit',compact('data', 'orang'));
        
    }
    // update 
    public function viewUpdate( Request $request)
    {

        $id        = $request->id;
        $user_id   = $request->user_id;
        $company   = $request->company;
        $email     = $request->email;
        $phone     = $request->phone;
        // $country   = $request->country;
 
        // $old_image = InformationForm::find($id);
        // $image_name = $request->hidden_image;
        // $image = $request->file('image');
 
        // if($image != '')
        // {
        //     $image_name = rand() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $image_name);
        //     unlink('images/'.$old_image->image);
        // }
    
        $update = [
 
            'id'       => $id,
            'user_id' => $user_id,
            // 'image'    => $image_name,
            'company'      => $company,
            'phone'    => $phone,
            'email'  => $email,
        ];
        InformationForm::where('id',$request->id)->update($update);
        Toastr::success('Data updated successfully :)','Success');
        return redirect()->route('form/information/show');
    }
    // delete
    public function delete($id)
    {
        $delete = InformationForm::findorfail($id);
        // unlink('images/'.$delete->image);
        $delete->delete();
        Toastr::success('Data deleted successfully :)','Success');
        return redirect()->route('form/information/show');
    }
}
