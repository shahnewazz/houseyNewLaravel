<?php
use Modules\Core\Models\Language;
use Modules\Core\Models\Translation;

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

function updateTranslation(object $request, string $model, int|string $id): bool
{
    foreach ($request->lang as $index => $key) {
        foreach (['name','description','title'] as $type){
            if (isset($request[$type][$index]) && $key != 'en') {
                
                $translation = Translation::where('translatable_id', $id)
                ->where('translatable_type', $model)
                ->where('language_code', $key)
                ->where('field_name', $type)
                ->first();

                if($translation){
                    $translation->content = $request[$type][$index];
                    $translation->save();
                }else{
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
    }
    return true;
}
