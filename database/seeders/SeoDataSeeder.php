<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class SeoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'url' => "/",
                'seo_title' => "Стоматология в Курске",
                'seo_description' => "Стоматологическая клиника Dentalica в городе Курск. Все виды стоматологических услуг",
                'page_title' => "",
            ],
            [
                'url' => "doctors",
                'seo_title' => "Специалисты нашей клиники",
                'seo_description' => "Специалисты нашей клиники",
                'page_title' => "Специалисты нашей клиники",
            ],
            [
                'url' => "prices",
                'seo_title' => "Цены на стоматологические услуги",
                'seo_description' => "Выгодные цены на стоматологические услуги в Курске",
                'page_title' => "Цены на услуги",
            ],
            [
                'url' => "contacts",
                'seo_title' => "Контакты клиники",
                'seo_description' => "Контакты нашей клиники, свяжитесь с нами любым удобным способом",
                'page_title' => "Контакты",
            ],
            [
                'url' => "services",
                'seo_title' => "Стоматологические услуги нгашей клиники",
                'seo_description' => "Стоматологические услуги нгашей клиники",
                'page_title' => "Услуги",
            ]
        ];

        DB::table("seo_data")->insert($data);
    }
}
