<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Redirect;
use App\User;
use App\Shelter;
use App\appCountry;
use Auth;

class ShelterController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addShel(Request $request)
    {
        $countries = DB::table('apps_countries')->get();
        return view('admin.add_shelter')->with('countries',$countries);
    }
     
    public function create(Request $request)
    {
       try{
        $validator = Validator::make($request->all(),[
            'shelterName' =>'required',
            'rooms' =>'required',
            'contactNo1' =>'required',
            'shelterAddress'=>'required',
            'shelterCity'=>'required',
            'shelterCountry'=>'required',
            'shelterPostalCode' =>'required',
            'shelterLongitude' =>'required',
            'shelterLatitudes' =>'required',
            
            //"image" => "mimes:jpeg,png,jpg|max:5048"
        ]);

        if($validator->fails()){ 
            $request->session()->flash('delete','Please check fields again');
            return redirect("/add_shelter");
            
        } else{ 
            $id=Auth::user()->id;
         
                $shelter = new Shelter([           
                    'user_id' =>$id,
                    'shel_name' => $request->get('shelterName'),
                    'shel_rooms' =>  $request->get('rooms'),
                    'shel_contact_1' =>  $request->get('contactNo1'),
                    'website' =>  $request->get('website'),
                    'shel_description' =>  $request->get('shelterDescription'),
                    'shel_address' =>  $request->get('shelterAddress'),
                    'shel_city' =>  $request->get('shelterCity'),
                    'shel_country' =>  $request->get('shelterCountry'),
                    'shel_postal_code' =>  $request->get('shelterPostalCode'),
                    'shel_longitude' =>  $request->get('shelterLongitude'),
                    'shel_latitude' =>  $request->get('shelterLatitudes'),
                    'shel_status' =>0,
                    ]);
                    $shelter->save();
              

                $request->session()->flash('success','Shelter created Successfully');
                return redirect("/add_shelter"); 
        }


       }catch(\Exception $error){
        $request->session()->flash('delete','Unable to create your shelter. Please try again.');
        return redirect("/add_shelter");
       
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $id=Auth::user()->id;
        $shel_user = DB::table('shelters')->where('user_id', $id)->orderBy('id', 'DESC')->get();
        $admin_user = DB::table('shelters')->join('users', 'shelters.user_id', '=', 'users.id')
        ->select('shelters.*','users.name','users.email','users.status')
        ->orderBy('shelters.id', 'DESC')->get();
        return view('admin.view_shelters')->with('shel_user',$shel_user)->with('admin_user',$admin_user);
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
    public function edit(Request $request,$id)
    {
        $countries = DB::table('apps_countries')->get();
        $shel_data = DB::table('shelters')->where('id', $id)->get();
        return view('admin.update_shelter')->with('shel_data',$shel_data)->with('countries',$countries);
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
            $shel_id= $request->get('shel_id');
            $validator = Validator::make($request->all(),[
               
                'shel_name' => $request->get('shelterName'),
                'shel_rooms' =>  $request->get('rooms'),
             
                //'image' => 'required|image|mimes:pdf,jpeg,png,jpg,gif,svg|max:5048',
                //"image" => "mimes:jpeg,png,jpg|max:10000",
            ]);
            
            
            if($validator->fails()){ 
                $request->session()->flash('delete','Please check fields again');
                return redirect("/edit_shelter/$shel_id");
            }else{
                
        
        $shelter = Shelter::find($shel_id);
        $shelter->shel_name = $request->get('shelterName');
        $shelter->shel_rooms = $request->get('rooms');
        $shelter->shel_country = $request->get('shelterCountry');
        $shelter->shel_contact_1 = $request->get('contactNo1');
        $shelter->website = $request->get('website');
        $shelter->shel_description = $request->get('shelterDescription');
        $shelter->shel_address = $request->get('shelterAddress');
        $shelter->shel_city = $request->get('shelterCity');
        $shelter->shel_postal_code = $request->get('shelterPostalCode');
        $shelter->shel_longitude = $request->get('shelterLongitude');
        $shelter->shel_latitude = $request->get('shelterLatitudes');
        
     

        $shelter->save();
        $request->session()->flash('success','Shelter Information Updated Successfully');
        return redirect("/edit_shelter/$shel_id");
        }

        }catch(\Exception $error){
                $request->session()->flash('delete','Unable to save your Shelter Data. Please try again.');
                return redirect("/edit_shelter/$shel_id");
        }
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
        $shelter = Shelter::find($id);
        $shelter->delete();
        $imagePath=$shelter->shel_pic;
        $image_path = "/Images/$imagePath";   // Value is not URL but directory file path 
        unlink(public_path() . $image_path);
        $request->session()->flash('delete','Shelter Deleted Successfully');
        return redirect('/view_shelters');
        }catch(\Exception $error){
            $request->session()->flash('delete','Something went wrong. Please try again.');
            return redirect("/view_shelters");}
    }

    public function active(Request $request, $id)
    {
        $accept = Shelter::find($id);
        $accept->shel_status = '1';
        $accept->save();
        $request->session()->flash('success','Shelter Activated Successfully');
        return redirect('/view_shelters');
    }

    public function deactive(Request $request, $id)
    {
        $accept = Shelter::find($id);
        $accept->shel_status = '0';
        $accept->save();
        $request->session()->flash('success','Shelter Deactivated Successfully');
        return redirect('/view_shelters');
    }


}
