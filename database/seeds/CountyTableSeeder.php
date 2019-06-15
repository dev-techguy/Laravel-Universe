<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class CountyTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run() {
        $data = [
            'Mombasa',
            'Isiolo',
            'Murang\'a',
            'Laikipia',
            'Siaya',
            'Kwale',
            'Meru',
            'Kiambu',
            'Nakuru',
            'Kisumu',
            'Kilifi',
            'Tharaka-Nithi',
            'Turkana',
            'Narok',
            'Homa Bay',
            'Tana River',
            'Embu',
            'West Pokot',
            'Kajiado',
            'Migori',
            'Lamu',
            'Kitui',
            'Samburu',
            'Kericho',
            'Kisii',
            'Taita-Taveta',
            'Machakos',
            'Trans Nzoia',
            'Bomet',
            'Nyamira',
            'Garissa',
            'Makueni',
            'Uasin Gishu',
            'Kakamega',
            'Nairobi',
            'Wajir',
            'Nyandarua',
            'Elgeyo-Marakwet',
            'Vihiga',
            'Mandera',
            'Nyeri',
            'Nandi',
            'Bungoma',
            'Marsabit',
            'Kirinyaga',
            'Baringo',
            'Busia',
        ];

        foreach ($data as $datum) {
            $county = [
                [
                    'id' => Uuid::generate()->string,
                    'name' => $datum,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            //store
            DB::table('counties')->insert($county);
        }
    }
}
