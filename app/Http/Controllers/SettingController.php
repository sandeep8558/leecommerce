<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','administrator']);
    }

    public function settings(){
        return view("administrator.settings");
    }

    public function get_setting(Request $request){
        $key = $request->key;
        $val = $request->val;
        $setting = Setting::where('key', $key);
        $a = null;
        if($setting->exists()){
            $a = $setting->first();
        } else {
            $a = Setting::create(['key' => $key,'val' => $val]);
        }
        return $a;
    }

    public function save_setting(Request $request){

        $key = $request->key;
        $val = $request->val;
        $setting = Setting::where('key', $key);
        $a = null;

        if(isset($request->what)){
            if($request->what == 'file'){

                if(gettype($request->media) == "object"){
                    if($file = $request->file('media')){
                        $name = time().'_'.mt_rand(100000,999999).'_'.$file->getClientOriginalName();
                        $file->move("Setting", $name);
                        $val = "/"."Setting"."/".$name;

                        if($setting->exists()){
                            $fl = $setting->first()->val;
                            if($fl != null || $fl != ""){
                                if(file_exists(substr($fl, 1))){
                                    unlink(substr($fl, 1));
                                }
                            }
                        }
                    }
                }

            }
        }
        
        if($setting->exists()){
            $a = $setting->update(['val' => $val]);
        } else {
            $a = Setting::create(['key' => $key,'val' => $val]);
        }
        return $a;
    }
}
