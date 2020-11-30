<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Shelter;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {   $id=Auth::user()->id;
        $users = DB::table('users')->where('id',$id)->get();
        return view('admin.user_profile')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passReset()
    {
        //$id=Auth::user()->id;  
        return view('admin.pass_reset');

    }
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
        
            'password' => ['required', 'string', 'min:8'],
        ]);
        
        if($validator->fails()){ 
            $request->session()->flash('delete','Password should be 8 strings.');
            return redirect('pass_reset');
        }else{

            $id=Auth::user()->id;
            $pass=$request->get('password');
            $repass=$request->get('re_password');
            if($pass!=$repass){
                $request->session()->flash('delete','Password is not matched.');
                return redirect('pass_reset');
            }
            $user = User::find($id);
            $user->password = Hash::make($pass);
            $user->save();
            $request->session()->flash('success','Password has changed successfully.');
            $to_user_email=Auth::user()->email;
            Mail::to($to_user_email)->send(new PasswordReset());
            return view('admin.pass_reset');
        }


   
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        try{
            $validator = Validator::make($request->all(),[
                
                //'image' => 'required|image|mimes:pdf,jpeg,png,jpg,gif,svg|max:5048',
                "image" => "mimes:jpeg,png,jpg|max:10000",
            ]);
    
            
            if($validator->fails()){ 
                $request->session()->flash('delete','Your profile picture format is not Valid');
                return redirect('userProfile');
            }else{

            

        $id=Auth::user()->id;
        $pic=Auth::user()->profile_pic;
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->address = $request->get('address');
        $user->contact_no = $request->get('contact_no');
        $user->rating = $request->get('description');
        
        if ($request->hasFile('image')) {  
            $fileName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('Images'), $fileName); 
            $imagePath=$user->profile_pic;

            if(!is_null($imagePath)){
                $image_path = "/Images/$imagePath";
                unlink(public_path() . $image_path);
            }
            
            $user->profile_pic = $fileName;

            }

        $user->save();
        $request->session()->flash('success','User Information Updated Successfully');
        return redirect('userProfile');

            }
        }catch(\Exception $error){
                $request->session()->flash('delete','Unable to save your Profile Data. Please try again.');
                return redirect('userProfile');
        }
    }

    public function view()
    {
        $id=Auth::user()->id;
        $users = DB::table('users')->where('role','2')->orderBy('id', 'DESC')->get();
     
        return view('admin.view_users')->with('users',$users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        try{
        $user = User::find($id);
        $user->delete();
        $imagePath=$user->profile_pic;
        $image_path = "/Images/$imagePath";   // Value is not URL but directory file path 
        unlink(public_path() . $image_path);

        $request->session()->flash('delete','User Deleted Successfully');
        return redirect('/view_users');
        }catch(\Exception $error){
            $request->session()->flash('delete','Something went wrong. Please try again.');
            return redirect("/view_users");}
    }

    public function active(Request $request, $id)
    {
       
        $accept = User::find($id);
        $accept->status = '1';
        $accept->save();
        $shelter = Shelter::where('user_id', $id)->update(['shel_status' => 1]);
        $request->session()->flash('success','User Activated Successfully');
        return redirect('/view_users');
    }

    public function deactive(Request $request, $id)
    {
        $accept = User::find($id);
        $accept->status = '0';
        $accept->save();
        $shelter = Shelter::where('user_id', $id)->update(['shel_status' => 0]);
        $request->session()->flash('success','User Deactivated Successfully');
        return redirect('/view_users');
    }
}
