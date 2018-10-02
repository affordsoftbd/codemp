<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;;
use Session;

class CommonController extends Controller
{


    public function getLeaderByRole(Request $request){
        try {
            $leaders = User::where('role_id', $request->role_id-1)->where('status','Active')->get();
            $options = '<option disabled selected value="">আপনার নেতা</option>';
            foreach($leaders as $leader){
                $options .='<option value="'.$leader->id.'">'.$leader->first_name.' '.$leader->last_name.'</option>';
            }
            return ['status'=>200, 'options'=>$options];
        }
        catch (\Exception $e) {
            return ['status'=>401, 'options'=>$e->getMessage()];
        }
    }

    public function getDistrictByDivision(Request $request){
        try {
            $districts = DB::table('districts')->where('division_id', $request->division_id)->get();
            $options = '<option disabled selected value="">আপনার জেলা</option>';
            foreach($districts as $district){
                $options .='<option value="'.$district->district_id.'">'.$district->district_name.'</option>';
            }
            return ['status'=>200, 'options'=>$options];
        }
        catch (\Exception $e) {
            return ['status'=>4001, 'options'=>$e->getMessage()];
        }
    }
    public function getThanaByDistrict(Request $request){
        try {
            $thanas= DB::table('thanas')->where('district_id', $request->district_id)->get();
            $options = '<option disabled selected value="">আপনার থানা</option>';
            foreach($thanas as $thana){
                $options .='<option value="'.$thana->thana_id.'">'.$thana->thana_name.'</option>';
            }
            return ['status'=>200, 'options'=>$options];
        }
        catch (\Exception $e) {
            return ['status'=>4001, 'options'=>$e->getMessage()];
        }
    }
    public function getZipByThana(Request $request){
        try {
            $zips = DB::table('zips')->where('thana_id', $request->thana_id)->get();
            $options = '<option disabled selected value="">আপনার জিপ</option>';
            foreach($zips as $zip){
                $options .='<option value="'.$zip->zip_id.'">'.$zip->zip_code.'</option>';
            }
            return ['status'=>200, 'options'=>$options];
        }
        catch (\Exception $e) {
            return ['status'=>4001, 'options'=>$e->getMessage()];
        }
    }

    public function error404(){
        return "Error 404! Page not found";
    }
}
