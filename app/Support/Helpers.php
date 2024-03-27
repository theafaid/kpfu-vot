<?php

/**
 * @param $text
 * @param $source
 * @param $target
 * @return mixed
 */
if (! function_exists('cloudTranslate')) {
    function cloudTranslate($text, $source = 'ar', $target = 'en')
    {
        try {
            $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=" . $source . "&tl=" . $target . "&dt=t&q=" . urlencode($text);
            $res = \Illuminate\Support\Facades\Http::get($url);
            return $res->json()[0][0][0];
        } catch (\Exception $ex) {
            return $text;
        }
    }

}
