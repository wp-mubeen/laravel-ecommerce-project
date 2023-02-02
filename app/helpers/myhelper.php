<?php
namespace App\helpers;



use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class Custom{
    public static function uppercase(string $string = ''){
        return strtoupper($string);
    }
    public static function SaveProfile( $data, $uid){

       // $profile = DB::table('profile')->where('user_id', $uid)->first();

        $profile = Profile::where('user_id', $uid)
            ->update($data);

        if(!$profile){
            Profile::create($data);
        }

    }
}
