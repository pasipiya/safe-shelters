<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Redirect;
use App\User;
use App\Shelter;
use App\Content;
use Auth;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
            $content=DB::table('contents')->get();
            return view('admin.add_web_content')->with('content',$content);
    }

    public function createContent(Request $request){
        $validator = Validator::make($request->all(),[
            'content_name' =>'required',
            'content_code' =>'required',
        ]);


        if($validator->fails()){
            $request->session()->flash('delete','Please check fields again');
            return redirect("/web_content");

        } else{
            $content = new Content([
                'content_name' => $request->get('content_name'),
                'content_code' =>  $request->get('content_code'),
                'status' =>  $request->get('status'),
                'content' =>  $request->get('content'),

                ]);
                $content->save();


            $request->session()->flash('success','Content created Successfully');
            return redirect("/web_content");

        }
    }

    public function edit(Request $request,$id)
    {
        $data=DB::table('contents')->where('id',$id)->get();
        return view('admin.web_content')->with('data',$data);
    }

    public function update(Request $request)
    {
        try{
            $id= $request->get('id');
            $data = Content::find($id);
            $data->content = $request->get('content');
            $data->save();
            $request->session()->flash('success','Updated Successfully');
            return back();
        }catch(\Exception $error){
            $request->session()->flash('delete','Unable Update Content. Please try again.');
            return back();
        }

    }


    public function active(Request $request, $id)
    {
        $accept = Content::find($id);
        $accept->status = '1';
        $accept->save();
        $request->session()->flash('success','Content Activated Successfully');
        return redirect('/web_content');
    }

    public function deactive(Request $request, $id)
    {
        $accept = Content::find($id);
        $accept->status = '0';
        $accept->save();
        $request->session()->flash('success','Content Deactivated Successfully');
        return redirect('/web_content');
    }



}
