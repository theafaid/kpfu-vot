<?php

/**
 * @param $text
 * @param $source
 * @param $target
 * @return mixed
 */
if (! function_exists('cloudTranslate')) {
    function cloudTranslate($text, $source = 'en', $target = 'es')
    {
        $res = \Illuminate\Support\Facades\Http::withHeaders([
        ])->post('https://translation.googleapis.com/language/translate/v2?key=AIzaSyB7SFP79Yz4YZxNDRiAlNPDbl8i6GI7Lh8', [
            'key' => 'AIzaSyB7SFP79Yz4YZxNDRiAlNPDbl8i6GI7Lh8',
            'source' => $source,
            'target' => $target,
            'q' => $text,
            'format' => 'text',
        ]);

        if (! $res->successful()) {
            dd($res->json());
        }

        return $res->json()['data']['translations'][0]['translatedText'];
    }

}
