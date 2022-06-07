<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('countries')->delete();
        $data = $this->data();
        foreach ($data as $key => $value) {
            DB::collection('countries')->insert($value);
        }
    }

    public function data() {
        return [
            ['name' => 'Philippines', 'list_url' => [
                'https://www.philips.com.ph/c-m-mo/philips-avent',
                'https://www.instagram.com/philipsaventph/',
                'https://comotomo.ph/',
                'https://www.instagram.com/comotomo.ph/',
                'https://www.facebook.com/comotomo.ph'
            ]],
            ['name' => 'Singapore', 'list_url' => [
                'https://www.karihome.com.sg/en-SG/home/index',
                'https://www.facebook.com/karihomesg/',
                'https://www.instagram.com/karihomesingapore/?utm_medium=copy_link',
                'https://www.babyandme.nestle.com.sg/',
                'https://www.facebook.com/nestlebabyandmesg',
                'https://www.instagram.com/nangrowingupmilk/',
                'https://www.clubillume.com.sg/',
                'https://www.facebook.com/Clubillume',
                'https://www.instagram.com/clubillumesg/',
                'https://www.wyethnutrition.com.sg/',
                'https://www.facebook.com/WyethNutritionSG',
                'https://abbottfamily.com.sg/products/range/similac',
                'https://shop.enfagrow.com.sg/',
                'https://www.facebook.com/enfagrowsingapore',
                'https://www.instagram.com/enfagrowsingapore/',
                'https://www.aptaadvantage.com.sg/',
                'https://www.facebook.com/AptamilSingapore/',
                'https://www.instagram.com/aptaadvantagesg/',
                'https://www.nuk.sg/',
                'https://www.instagram.com/nuksingapore/'
            ]],
            ['name' => 'Hong Kong', 'list_url' => [
                'https://www.nestle.com.hk/en/brands/baby',
                'https://www.tommeetippee.com.hk/'
            ]],
            ['name' => 'Malaysia', 'list_url' => [
                'https://www.frisogold.com.my/',
                'https://www.facebook.com/FrisoGoldMY',
                'https://www.instagram.com/frisogoldmy/',
                'https://www.startwell.nestle.com.my/',
                'https://www.mamil.com.my/en/',
                'https://www.facebook.com/DumexMamil/?ref=br_rs',
                'https://abbottnutrition.com.my/',
                'https://www.enfagrow.com.my/',
                'https://www.facebook.com/enfagrowmalaysia',
                'https://www.instagram.com/enfagrowmy/',
                'https://mymambaby.com/',
                'https://www.instagram.com/mymambaby/',
                'https://www.wyethnutrition.com.my/brands/wn/growing-milk/gold-progress',
                'https://www.facebook.com/TommeeTippeeMY',
                'https://www.facebook.com/nuk.my/'
            ]],
            ['name' => 'Australia', 'list_url' => [
                'www.a2nutrition.com.au',
                'https://www.facebook.com/a2PlatinumToddler/',
                'https://bellamysorganic.com.au/',
                'https://www.facebook.com/bellamysorganic/?ref=page_internal',
                'https://www.instagram.com/bellamysorganic/',
                'www.nestlebabyandme.com.au',
                'https://www.bellamysorganicinstitute.com.au/',
                'https://www.facebook.com/NestleBabyandMeAU',
                'https://www.medela.com.au/',
                'https://natureonedairy.com/',
                'https://www.facebook.com/natureonedairy',
                'https://www.instagram.com/natureonedairyaustralia/',
                'https://www.facebook.com/pigeonbabyau/photos/?ref=page_internal',
                'https://www.instagram.com/pigeonbabyau/'
            ]],
            ['name' => 'Nigeria', 'list_url' => [
                'https://www.konga.com/category/baby-kids-toys-8',
                'https://www.facebook.com/fortilacnigeria/',
                'https://www.instagram.com/fortilacnigeria/',
                'https://www.philips.ng/c-m-mo/baby-bottles-nipples',
                'https://www.facebook.com/PigeonNigeria/',
                'https://www.instagram.com/pigeon_nigeria/?hl=en'
            ]],
            ['name' => 'US', 'list_url' => [
                'https://www.gerber.com',
                'https://www.instagram.com/gerber/',
                'https://www.facebook.com/Gerber/',
                'https://www.similac.com',
                'https://www.instagram.com/similac_us/',
                'https://www.facebook.com/Similac/',
                'https://www.enfamil.com/',
                'https://www.instagram.com/enfamil/',
                'https://www.facebook.com/Enfamil/'
            ]],
            ['name' => 'UK', 'list_url' => [
                'https://www.heinzbaby.co.uk/',
                'https://www.aptaclub.co.uk/',
                'https://www.facebook.com/aptaclubuk',
                'https://www.instagram.com/aptaclubuk/',
                'https://www.facebook.com/MyAbbottCares/'
            ]],
            ['name' => 'New Zealand', 'list_url' => [
                'https://www.anmum.com/nz'
            ]],
            ['name' => 'Country not specific', 'list_url' => [
                'https://www.facebook.com/frieslandcampinainstitute',
                'https://www.nestlenutrition-institute.org/',
                'https://www.facebook.com/NestleNutritionInstitute/'
            ]]
        ];
    }
}
