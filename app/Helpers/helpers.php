<?php

use App\Models\User;
use Illuminate\Support\Facades\Storage;

if (!function_exists('get_page_meta')) {

    function get_page_meta($metaName = "title", $raw=false)
    {
        if (session()->has('page_meta_' . $metaName)) {
            $title = session()->get("page_meta_" . $metaName);
//            session()->forget("page_meta_" . $metaName);
            if ($raw){
                return str_replace(' |', '', $title);
            }else{
                return $title;
            }
        }
        return null;
    }
}

if (!function_exists('set_page_meta')) {

    function set_page_meta($content = null, $metaName = "title")
    {
        // dd($content, $metaName);
        if ($content && $metaName == "title") {
            session()->put('page_meta_' . $metaName, $content . ' |');
        } else {
            session()->put('page_meta_' . $metaName, $content);
        }
    }
}

if (!function_exists('user_assign_roles')) {

    function user_assign_roles($userId)
    {
        return User::find($userId)->roles;
    }
}

if (!function_exists('user_assign_roles_display')) {

    function user_assign_roles_display($userId)
    {
        $roles_name = [];
        $user_roles =user_assign_roles($userId);
        if(count($user_roles) > 0){
            foreach($user_roles as $role){

                array_push($roles_name,$role->name);
            }
            return implode(',',$roles_name);
        }

        // dd('roles_name',$roles_name, );
    }
}


function generateSlug($value)
{
    try {
        return preg_replace('/\s+/u', '-', trim($value));
    } catch (\Exception $e) {
        return '';
    }
}

function getStorageImage( $name ,$path )
{
    // if ($name && Storage::exists($path . '/' . $name)) {
    if ($name && file_exists($path . '/' . $name)) {

        return asset($path.'/'.$name) ;

    }
   return asset('images/default.png');
}
