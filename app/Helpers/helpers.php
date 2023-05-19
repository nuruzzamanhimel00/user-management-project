<?php

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
