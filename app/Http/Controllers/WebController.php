<?php

namespace App\Http\Controllers;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Redirect;
use App\User;
use App\Shelter;
use App\appCountry;
use App\appsPostalCode;
use Auth;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   $countries = DB::table('apps_countries')->get();
        $content=DB::table('contents')->where('status','1')->get();
        $shel_data = DB::table('shelters')->where('shel_status','1')->get();
        return view('main.index')->with('shel_data',$shel_data)->with('countries',$countries);

    }


    public function liveSearch(Request $request)
    {

        if($request->ajax())
        {
         $output = '';
         $query = $request->get('query');
         if($query != '')
         {
            $data =Shelter::query()->select('shelters.*')->where(function ($query) {
                $query->where('shel_status','1');
            })
            ->where(function ($row) use ($query){
                $row->where('shel_address', 'LIKE', "%{$query}%")
                      ->orWhere('shel_city', 'LIKE', "%{$query}%");
            })->take('4')->get();
/*
          $data = DB::table('shelters')
            ->orWhere('shel_postal_code', 'like', '%'.$query.'%')
            ->orWhere('shel_city', 'like', '%'.$query.'%')
            ->orWhere('shel_address', 'like', '%'.$query.'%')
            ->where('shel_status','1')
            ->orderBy('id', 'desc')
            ->take('4')
            ->get();
            */
         }
         else
         {
          $data = DB::table('shelters')
            ->where('shel_status','1')
            ->orderBy('id', 'desc')
            ->get();
         }
         $total_row = $data->count();
         if($total_row > 0)
         {
          foreach($data as $row)
          {

            if($row->shel_postal_code!=null){
                $output .='<p>'.$row->shel_postal_code.'</p>';
            }
            if($row->shel_city!=null){
                $output .='<p>'.$row->shel_city.'</p>';
            }

            if($row->shel_address!=null){
                $output .='<p>'.$row->shel_address.'</p>';
            }
            //$output .='<p>'.$row->shel_city.'</p>';
          //
          //$output .='<p>'.$row->shel_address.'</p>';
          }
         }
         else
         {
             /*
            $output .='<p>No Data Found</p>';
            */
         }

         $data = array(
          'table_data'  => $output
         );

         echo json_encode($data);
        }

    }


    public function searchShelter(Request $request)
    {
        $countries = DB::table('apps_countries')->get();
        $content=DB::table('contents')->where('status','1')->get();
        $shel_data = DB::table('shelters')->where('shel_status','1')->get();
        $searchTerm=$request->get('search');
        $searchCountry=$request->get('shelterCountry');

/*
        if($searchCountry=="United Kingdom"){
            $contry_code="GB";
            //$searchTerm = substr($searchTerm, 0, strpos($searchTerm, ' ')+1);
            if($searchTerm == trim($searchTerm) && strpos($searchTerm, ' ') !== false){
                $searchTerm = substr($searchTerm, 0, strpos($searchTerm, ' ')+1);

            }
            echo $searchTerm;
            //$searchTerm="OX1";


            $postal_code_data=appsPostalCode::query()->select('apps_postal_code.*')
            ->where('country_code',$contry_code)
            ->where('postal_code',$searchTerm)
            ->orWhere('postal_code','LIKE',"%$searchTerm%")
            ->get();
            foreach($postal_code_data as $row){}
            $longitude=$row->longitude;
            $latitude=$row->latitude;

            $distance="1";
            $search_data=DB::select( DB::raw("SELECT *,((ACOS(SIN($latitude * PI() / 180) * SIN(`shel_latitude` * PI() / 180) + COS($latitude * PI() / 180) * COS(`shel_latitude` * PI() / 180) * COS(($longitude - `shel_longitude`) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS `distance` FROM `shelters`
            WHERE(`shel_latitude` BETWEEN ($latitude - $distance) AND ($latitude + $distance)
            AND `shel_longitude` BETWEEN ($longitude - $distance) AND ($longitude + $distance)) ORDER BY `distance` ASC limit 10"));
            return view('main.index')->with('search_data',$search_data)->with('shel_data',$shel_data)->with('countries',$countries);
        }

*/
        if($searchCountry=="Please choose country"){
            $request->session()->flash('delete','Please choose country');
            return back();
        }

        $search_1=substr("$searchTerm",0,4);
        if (is_numeric($searchTerm)) {
            $search_data=Shelter::query()->select('shelters.*')
            ->where('shel_postal_code','REGEXP', '^[0-9]')
            ->where('shel_status','1')
            ->where('shel_country',$searchCountry)
            ->orderBy(DB::raw("ABS(shel_postal_code - $searchTerm)"))
            ->take('10')
            ->get();
            if(count($search_data) == 0) {
                $request->session()->flash('delete','There are currently no available results in this region, please search for a different location.');
                return back();
            }else{
                return view('main.index')->with('search_data',$search_data)->with('shel_data',$shel_data)->with('countries',$countries);
            }
        }elseif($searchCountry=="United Kingdom"){
            $contry_code="GB";
            if(empty($searchTerm)){
                 $search_data =Shelter::query()->select('shelters.*')->where(function ($query) use($searchCountry) {
                    $query->where('shel_status','1')
                    ->where('shel_country',$searchCountry);
                })
                ->where(function ($query) use ($searchTerm){
                    $query->where('shel_address', 'LIKE', "%{$searchTerm}%")
                          ->orWhere('shel_city', 'LIKE', "%{$searchTerm}%");
                })->get();
                if(count($search_data) == 0) {
                    $request->session()->flash('delete','There are currently no available results in this region, please search for a different location.');
                    return back();
                }else{
                    return view('main.index')->with('search_data',$search_data)->with('shel_data',$shel_data)->with('countries',$countries);
                }
            }
            //$searchTerm = substr($searchTerm, 0, strpos($searchTerm, ' ')+1);
            if($searchTerm == trim($searchTerm) && strpos($searchTerm, ' ') !== false){
                $searchTerm = substr($searchTerm, 0, strpos($searchTerm, ' ')+1);
            }
            $search3 = substr("$searchTerm", 0,3);
            $postal_code_data=appsPostalCode::query()->select('apps_postal_code.*')
            ->where('country_code',$contry_code)
            ->where('postal_code',$searchTerm)
            ->orWhere('postal_code','LIKE',"%$searchTerm%")
            ->orWhere('postal_code','LIKE',"%$search3%")
            ->get();

            if(!count($postal_code_data)==0){
                foreach($postal_code_data as $row){}
                $longitude=$row->longitude;
                $latitude=$row->latitude;

                $distance="100";
                $search_data=DB::select( DB::raw("SELECT *,((ACOS(SIN($latitude * PI() / 180) * SIN(`shel_latitude` * PI() / 180) + COS($latitude * PI() / 180) * COS(`shel_latitude` * PI() / 180) * COS(($longitude - `shel_longitude`) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS `distance` FROM `shelters`
                WHERE(`shel_country`='$searchCountry' AND `shel_latitude` BETWEEN ($latitude - $distance) AND ($latitude + $distance)
                AND `shel_longitude` BETWEEN ($longitude - $distance) AND ($longitude + $distance)) ORDER BY `distance` ASC limit 10"));

                if(count($search_data) == 0) {
                    $request->session()->flash('delete','There are currently no available results in this region, please search for a different location.');
                    return back();
                }else{
                    return view('main.index')->with('search_data',$search_data)->with('shel_data',$shel_data)->with('countries',$countries);
                }
            }elseif(count($postal_code_data)==0){
                $search_data =Shelter::query()->select('shelters.*')->where(function ($query) use($searchCountry) {
                    $query->where('shel_status','1')
                    ->where('shel_country',$searchCountry);
                })
                ->where(function ($query) use ($searchTerm){
                    $query->where('shel_address', 'LIKE', "%{$searchTerm}%")
                          ->orWhere('shel_city', 'LIKE', "%{$searchTerm}%");
                })->get();

                $search_data =Shelter::query()
                ->where('shel_status','1')
                ->where('shel_country',$searchCountry)
                ->where('shel_address', 'LIKE', "%{$searchTerm}%")
                ->orWhere('shel_address', 'LIKE', "%{$search_1}%")
                ->orWhere('shel_country', 'LIKE', "%{$searchTerm}%")
                ->orWhere('shel_country', 'LIKE', "%{$search_1}%")
                ->orWhere('shel_city', 'LIKE', "%{$search_1}%")
                ->where('shel_city', 'LIKE', "%{$searchTerm}%")
                ->get();

                if(count($search_data) == 0) {
                    $request->session()->flash('delete','There are currently no available results in this region, please search for a different location.');
                    return back();
                }else{
                    return view('main.index')->with('search_data',$search_data)->with('shel_data',$shel_data)->with('countries',$countries);
                }
            }

            else{
                $request->session()->flash('delete','Please check your postal code again');
                return back();
            }
        }elseif($searchCountry=="Canada"){
            $contry_code="CA";
            if(empty($searchTerm)){
                $search_data =Shelter::query()->select('shelters.*')->where(function ($query) use($searchCountry) {
                   $query->where('shel_status','1')
                   ->where('shel_country',$searchCountry);
               })
               ->where(function ($query) use ($searchTerm){
                   $query->where('shel_address', 'LIKE', "%{$searchTerm}%")
                         ->orWhere('shel_city', 'LIKE', "%{$searchTerm}%");
               })->get();
               if(count($search_data) == 0) {
                $request->session()->flash('delete','There are currently no available results in this region, please search for a different location.');
                return back();
            }else{
                return view('main.index')->with('search_data',$search_data)->with('shel_data',$shel_data)->with('countries',$countries);
            }
           }
            //$searchTerm = substr($searchTerm, 0, strpos($searchTerm, ' ')+1);
            if($searchTerm == trim($searchTerm) && strpos($searchTerm, ' ') !== false){
                $searchTerm = substr($searchTerm, 0, strpos($searchTerm, ' ')+1);
            }
            $search3 = substr("$searchTerm", 0,3);
            $postal_code_data=appsPostalCode::query()->select('apps_postal_code.*')
            ->where('country_code',$contry_code)
            ->where('postal_code',$searchTerm)
            ->orWhere('postal_code','LIKE',"%$searchTerm%")
            ->orWhere('postal_code','LIKE',"%$search3%")
            ->get();

            if(!count($postal_code_data)==0){
                foreach($postal_code_data as $row){}
                $longitude=$row->longitude;
                $latitude=$row->latitude;

                $distance="100";
                $search_data=DB::select( DB::raw("SELECT *,((ACOS(SIN($latitude * PI() / 180) * SIN(`shel_latitude` * PI() / 180) + COS($latitude * PI() / 180) * COS(`shel_latitude` * PI() / 180) * COS(($longitude - `shel_longitude`) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS `distance` FROM `shelters`
                WHERE(`shel_country`='$searchCountry' AND `shel_latitude` BETWEEN ($latitude - $distance) AND ($latitude + $distance)
                AND `shel_longitude` BETWEEN ($longitude - $distance) AND ($longitude + $distance)) ORDER BY `distance` ASC limit 10"));
                          if(empty($search_data)){
                            $request->session()->flash('delete','There are currently no available results in this region, please search for a different location.');
                            return back();
                        };

                        if(count($search_data) == 0) {
                            $request->session()->flash('delete','There are currently no available results in this region, please search for a different location.');
                            return back();
                        }else{
                            return view('main.index')->with('search_data',$search_data)->with('shel_data',$shel_data)->with('countries',$countries);
                        }

            }elseif(count($postal_code_data)==0){
                $search_data =Shelter::query()->select('shelters.*')->where(function ($query) use($searchCountry) {
                    $query->where('shel_status','1')
                    ->where('shel_country',$searchCountry);
                })
                ->where(function ($query) use ($searchTerm){
                    $query->where('shel_address', 'LIKE', "%{$searchTerm}%")
                          ->orWhere('shel_city', 'LIKE', "%{$searchTerm}%");
                })->get();

                $search_data =Shelter::query()
                ->where('shel_status','1')
                ->where('shel_country',$searchCountry)
                ->where('shel_address', 'LIKE', "%{$searchTerm}%")
                ->orWhere('shel_address', 'LIKE', "%{$search_1}%")
                ->orWhere('shel_country', 'LIKE', "%{$searchTerm}%")
                ->orWhere('shel_country', 'LIKE', "%{$search_1}%")
                ->orWhere('shel_city', 'LIKE', "%{$search_1}%")
                ->where('shel_city', 'LIKE', "%{$searchTerm}%")
                ->get();
                if(count($search_data) == 0) {
                    $request->session()->flash('delete','There are currently no available results in this region, please search for a different location.');
                    return back();
                }else{
                    return view('main.index')->with('search_data',$search_data)->with('shel_data',$shel_data)->with('countries',$countries);
                }

            }

            else{
                $request->session()->flash('delete','Please check your postal code again');
                return back();
            }
        }
        else{

            $search_data =Shelter::query()->select('shelters.*')->where(function ($query) use($searchCountry) {
                $query->where('shel_status','1')
                ->where('shel_country',$searchCountry);
            })
            ->where(function ($query) use ($searchTerm){
                $query->where('shel_address', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('shel_city', 'LIKE', "%{$searchTerm}%");
            })->get();

            if(count($search_data) == 0) {
                $request->session()->flash('delete','There are currently no available results in this region, please search for a different location.');
                return back();
            }else{
                return view('main.index')->with('search_data',$search_data)->with('shel_data',$shel_data)->with('countries',$countries);
            }


            /*
            $search_data =Shelter::query()
            ->where('shel_status','1')
            ->where('shel_country',$searchCountry)
            ->where('shel_address', 'LIKE', "%{$searchTerm}%")
            ->orWhere('shel_address', 'LIKE', "%{$search_1}%")
            ->orWhere('shel_country', 'LIKE', "%{$searchTerm}%")
            ->orWhere('shel_country', 'LIKE', "%{$search_1}%")
            ->orWhere('shel_city', 'LIKE', "%{$search_1}%")
            ->where('shel_city', 'LIKE', "%{$searchTerm}%")
            ->get();
            */


        }


    }


    public function sendMessage(Request $request)
    {
        try{
            //$email=$request->get('email');
            $to="admin@gmail.com";
            Mail::to($to)->send(new ContactFormMail($request));
            $request->session()->flash('success','Message sent Successfully');
            return redirect("/contact");
        }catch(\Exception $error){
        $request->session()->flash('delete','Unable to send message. Please try again.');
        return redirect("/contact");
        }

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
