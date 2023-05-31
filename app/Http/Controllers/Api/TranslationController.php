<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Translation;
use App\Models\Text;

class TranslationController extends Controller
{
    public function translate($id)
    {
        $default_id = Language::where('title', 'English')->first()->id;

        $translations = Text::with(['translations' => function ($query) use ($id, $default_id) {
            $query->where(function ($subQuery) use ($id, $default_id) {
                $subQuery->where('language_id', $id)
                    ->orWhere('language_id', $default_id);
            });   
        }])->whereHas('translations', function ($query) use ($id, $default_id) {
                $query->where(function ($subQuery) use ($id, $default_id) {
                    $subQuery->where('language_id', $id)
                        ->orWhere('language_id', $default_id);
                });
            }) ->get();
        $data = [];
        foreach ($translations as $translation) {
            foreach ($translation->translations as $lang_translation) {
                if (Translation::find($lang_translation->id)->language->id == $id) {
                    $data[$translation->text]['main'] = $lang_translation->translation;

                    continue;
                }
                $data[$translation->text]['default'] = $lang_translation->translation;
            }
        }
        return $data;
    }
}
