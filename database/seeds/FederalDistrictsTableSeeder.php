<?php

use Illuminate\Database\Seeder;

class FederalDistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('federal_districts')->insert([
            'id'            => '3476A91C3CEFC829F8FAEDE73032DA3B',
            'name'          => 'Северо-Кавказский федеральный округ',
            'short_name'    => 'СКФО'
        ]);
        DB::table('federal_districts')->insert([
            'id'            => '46EF1E714CD24A2C9729D10B244E7B2B',
            'name'          => 'Дальневосточный федеральный округ',
            'short_name'    => 'ДВФО'
        ]);
        DB::table('federal_districts')->insert([
            'id'            => '4DA302E96A51456D8085FD6F09B0924B',
            'name'          => 'Центральный федеральный округ',
            'short_name'    => 'ЦФО'
        ]);
        DB::table('federal_districts')->insert([
            'id'            => '7EB35C3921944CB185F4912FE6EEF8DF',
            'name'          => 'Приволжский федеральный округ',
            'short_name'    => 'ПФО'
        ]);
        DB::table('federal_districts')->insert([
            'id'            => 'ABDCBFDB51CB4A2FB3ADF5CFFB4E245D',
            'name'          => 'Сибирский федеральный округ',
            'short_name'    => 'СФО'
        ]);
        DB::table('federal_districts')->insert([
            'id'            => 'B5A86EDCC3B548439E338D058613C238',
            'name'          => 'Северо-западный федеральный округ',
            'short_name'    => 'СЗФО'
        ]);
        DB::table('federal_districts')->insert([
            'id'            => 'CFDAA958656A4E6F906866A5A755C485',
            'name'          => 'Уральский федеральный округ',
            'short_name'    => 'УФО'
        ]);
        DB::table('federal_districts')->insert([
            'id'            => 'EF9A6052374E4C2EBD371E9EB35C7416',
            'name'          => 'Южный федеральный округ',
            'short_name'    => 'ЮФО'
        ]);







    }
}
