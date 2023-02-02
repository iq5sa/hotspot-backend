<?php

namespace App\Http\Controllers\Api;

use App\AdsBtnClick;
use App\AdsView;
use App\Http\Controllers\Controller;
use App\Location;
use App\Models\View_ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdsController extends Controller
{
    //


    public function show(Request $request){



        $site_key = $request->site_key;

        if (empty($site_key)){
            return response()->json(["status"=>false,"message"=>"Site key required"]);
        }


        $findLocation = \App\Location::where("uuid","=",$site_key)->get()->first();

        $location_id = $findLocation->id;

        $view_ads = DB::table("view_ads")->where("location_id","=",$location_id)
            ->join("ads","view_ads.ad_id","=","ads.id")
            ->where("ads.expired_at",">",now())->inRandomOrder()->first();



        if ($view_ads !=null){
            $adsView = new AdsView();
            $adsView->location_id = $location_id;
            $adsView->ad_id = $view_ads->ad_id;
            $adsView->save();


            return response()->json(["status"=>true,"data"=>$view_ads]);


        }

        return response()->json(["status"=>false,"message"=>"No data found"]);


    }


    public function saveClicks(Request $request){


        $request->validate([
           "location_key"=>"required",
           "ad_id"=>"required"
        ]);

        $locations = Location::where("uuid","=",$request->location_key)->first();

        $clicksTable = new AdsBtnClick();
        $clicksTable->location_id = $locations->id;
        $clicksTable->ad_id = intval($request->ad_id);
        $clicksTable->save();

        return response()->json(["status"=>true,"message"=>"click saved"]);



    }


}
