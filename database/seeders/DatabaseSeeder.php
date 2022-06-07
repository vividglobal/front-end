<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // AdminSeeder::class,
            // CompanyBrandSeeder::class,
            // ViolationTypeSeeder::class,
            // ViolationCodeSeeder::class,
            // CompanyBrandSeeder::class,
            // CountrySeeder::class,
            // ArticleSeeder::class,
        ]);
    }
}
