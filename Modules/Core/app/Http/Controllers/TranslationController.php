<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Models\Language;
use App\Http\Controllers\Controller;
use Modules\Core\Models\Translation;

class TranslationController extends Controller
{
    // public function add(object $request, string $model, int|string $id): bool
    // {
    //     foreach ($request->lang as $index => $key) {
    //         foreach (['name','description','title'] as $type){
    //             if (isset($request[$type][$index]) && $key != 'en') {

    //                 $translation = new Translation();
    //                 $translation->translatable_type = $model;
    //                 $translation->translatable_id = $id;
    //                 $translation->language_code = $key;
    //                 $translation->field_name = $type;
    //                 $translation->content = $request[$type][$index];
    //                 $translation->save();
    //             }
    //         }
    //     }
    //     return true;
    // }
}
