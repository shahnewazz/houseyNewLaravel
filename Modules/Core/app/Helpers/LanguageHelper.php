<?php
use Modules\Core\Models\Language;

function setLanguage($code)
{
    $lang = Language::select('code', 'direction')->where('code', $code)->first();

    if(session()->has('lang')){
        session()->forget('lang');
    }

    if($lang){
        session()->put('lang',$lang->code); 
        session()->put('lang_dir', $lang->direction);
        return true;
    }

    session()->put('lang', config('app.locale'));
    return false;

}