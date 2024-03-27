<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
//
//        User::factory()->create([
//            'name' => 'Test',
//            'email' => 'test@test.com',
//        ]);

        $languages = json_decode(file_get_contents(storage_path('lang.json')), true);

        foreach ($languages as $language) {
            Language::create([
                'slug' => $language['code'],
                'name_en' => $language['en'],
                'name_ru' => $language['ru'],
                'name_native' => $language['native'],
            ]);
        }

    }
}


/**
 *Archive
 */

//$languages = json_decode(file_get_contents(storage_path('langs.json')), true);
//
//$formatted = [];
//
//foreach ($languages as $code => $nameEn) {
//    $formatted[] = [
//        'code' => $code,
//        'en' => $nameEn,
//        'ru' => cloudTranslate($nameEn, 'en', 'ru'),
//        'native' => cloudTranslate($nameEn, 'en', $code),
//    ];
//}
//
//
//file_put_contents(storage_path('lang.json'), json_encode($formatted, 256));
//
//dd('done');
