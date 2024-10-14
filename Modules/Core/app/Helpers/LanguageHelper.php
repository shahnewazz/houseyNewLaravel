<?php
use Modules\Core\Models\Language;
use Modules\Core\Models\Translation;

if(!function_exists('setLanguage')) {
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
}

if(!function_exists('addTranslation')) {
    function addTranslation(object $request, string $model, int|string $id): bool
    {
        foreach ($request->lang as $index => $key) {
            foreach (['name','description','title'] as $type){
                if (isset($request[$type][$index]) && $key != 'en') {
                    
                    $translation = new Translation();
                    $translation->translatable_type = $model;
                    $translation->translatable_id = $id;
                    $translation->language_code = $key;
                    $translation->field_name = $type;
                    $translation->content = $request[$type][$index];
                    $translation->save();
                }
            }
        }
        return true;
    }
}

if(!function_exists('addTranslation')) {
    function updateTranslation(object $request, string $model, int|string $id): bool
    {
        foreach ($request->lang as $index => $key) {
            foreach (['name', 'description', 'title', 'text'] as $type) {
                
                if (isset($request[$type]) && is_array($request[$type]) && array_key_exists($index, $request[$type]) && $key != 'en') {
                    
                    // Try to find an existing translation
                    $translation = Translation::where('translatable_id', $id)
                        ->where('translatable_type', $model)
                        ->where('language_code', $key)
                        ->where('field_name', $type)
                        ->first();
                    
                    if ($translation) {
                        $translation->content = $request[$type][$index]; 
                        $translation->save();
                    }
                }
            }
        }
        return true;
    }
}

if(!function_exists('addTranslation')) {
    function deleteTranslation(object $request, string $model, int|string $id): bool
    {
        foreach ($request->lang as $index => $key) {
            foreach (['name', 'description', 'title', 'text'] as $type) {
                if (isset($request[$type]) && is_array($request[$type]) && array_key_exists($index, $request[$type]) && $key != 'en') {
                    Translation::where('translatable_id', $id)
                        ->where('translatable_type', $model)
                        ->where('language_code', $key)
                        ->where('field_name', $type)
                        ->delete();
                }
            }
        }
        return true;
    }
}

if(!function_exists('addTranslation')) {
    function deleteTranslationByCode(int|string $code): bool
    {
        Translation::where('language_code', $code)->delete();
        return true;
    }
}