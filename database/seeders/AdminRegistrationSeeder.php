<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            \DB::table('registrations')->insert([
                'team_name'                 => 'teamCYBRiDGE' . $i,
                'team_name_furigana'        => 'チームサイブリッジ' . $i,
                'representative_firstname'  => '水口' . $i,
                'representative_lastname'   => '翼' . $i,
                'firstname_furigana'        => 'ミズグチ' . $i,
                'lastname_furigana'         => 'ツバサ' . $i,
                'email'                     => 'mail' . ($i) . '@gmail.com',
                'email_team'                => 'mail_team' . ($i) . '@gmail.com',
                'type'                      => [1, 2, 3][array_rand([1, 2, 3])],
                'corp_name'                 => '株式会社サイブリッジ' . $i,
                'corp_name_katakana'        => 'カブシキガイシャサイブリッジ' . $i,
                'corp_building_zip'         => '1510051',
                'corp_building_pref'        => '東京都',
                'corp_building_city'        => '渋谷区',
                'corp_building_address'     => '千駄ヶ谷',
                'corp_building_name'        => 'リンクスクエア新宿14F',
                'corp_building_tel'         => '0345778960',
                'sub_firtsname'             => '三田' . $i,
                'sub_lastname'              => '真理' . $i,
                'sub_furigana_firtsname'    => 'ミタ' . $i,
                'sub_furigana_lastname'     => 'マサミチ' . $i,
                'sub_birthday'              => '2022-04-01',
                'sub_email'                 => 'mail' . ($i) . 'sub@gmail.com',
                'sub_tel'                   => '0001234567',
                'sub_zip'                   => '1510051',
                'sub_pref'                  => '東京都',
                'sub_city'                  => '渋谷区',
                'sub_address'               => '千駄ヶ谷',
                'sub_building'              => 'リンクスクエア新宿14F',
                'pic_firtsname'             => '三田' . $i,
                'pic_lastname'              => '真理' . $i,
                'pic_furigana_firtsname'    => 'ミタ' . $i,
                'pic_furigana_lastname'     => 'マサミチ' . $i,
                'pic_birthday'              => '2022-04-01',
                'pic_email'                 => 'mail' . ($i) . 'pic@gmail.com',
                'pic_tel'                   => '0001234567',
                'pic_zip'                   => '1510051',
                'pic_pref'                  => '東京都',
                'pic_city'                  => '渋谷区',
                'pic_address'               => '千駄ヶ谷',
                'pic_building'              => 'リンクスクエア新宿14F',
                'corp_delivery_pref'        => '東京都' . $i,
                'corp_delivery_city'        => '渋谷区' . $i,
                'corp_delivery_address'     => '千駄ヶ谷5-27-5' . $i,
                'corp_delivery_building'    => 'リンクスクエア新宿14F',
            ]);
        };
    }
}
