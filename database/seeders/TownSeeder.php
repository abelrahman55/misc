<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Town;
use App\Models\Countries;
use Illuminate\Support\Facades\DB;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to avoid issues during truncation (optional)
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Town::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Find Egypt ID
        $egypt = Countries::where('name->en', 'Egypt')->orWhere('name->ar', 'مصر')->first();

        if ($egypt) {
            $egyptTowns = [
                ['ar' => 'القاهرة', 'en' => 'Cairo'],
                ['ar' => 'الجيزة', 'en' => 'Giza'],
                ['ar' => 'الإسكندرية', 'en' => 'Alexandria'],
                ['ar' => 'الدقهلية', 'en' => 'Dakahlia'],
                ['ar' => 'البحر الأحمر', 'en' => 'Red Sea'],
                ['ar' => 'البحيرة', 'en' => 'Beheira'],
                ['ar' => 'الفيوم', 'en' => 'Fayoum'],
                ['ar' => 'الغربية', 'en' => 'Gharbia'],
                ['ar' => 'الإسماعيلية', 'en' => 'Ismailia'],
                ['ar' => 'المنوفية', 'en' => 'Monufia'],
                ['ar' => 'المنيا', 'en' => 'Minya'],
                ['ar' => 'القليوبية', 'en' => 'Qalyubia'],
                ['ar' => 'الوادي الجديد', 'en' => 'New Valley'],
                ['ar' => 'الشرقية', 'en' => 'Sharqia'],
                ['ar' => 'السويس', 'en' => 'Suez'],
                ['ar' => 'أسوان', 'en' => 'Aswan'],
                ['ar' => 'أسيوط', 'en' => 'Assiut'],
                ['ar' => 'بني سويف', 'en' => 'Beni Suef'],
                ['ar' => 'بورسعيد', 'en' => 'Port Said'],
                ['ar' => 'دمياط', 'en' => 'Damietta'],
                ['ar' => 'جنوب سيناء', 'en' => 'South Sinai'],
                ['ar' => 'كفر الشيخ', 'en' => 'Kafr El Sheikh'],
                ['ar' => 'مطروح', 'en' => 'Matrouh'],
                ['ar' => 'الأقصر', 'en' => 'Luxor'],
                ['ar' => 'قنا', 'en' => 'Qena'],
                ['ar' => 'شمال سيناء', 'en' => 'North Sinai'],
                ['ar' => 'سوهاج', 'en' => 'Sohag'],
            ];

            foreach ($egyptTowns as $town) {
                Town::firstOrCreate(
                    [
                        'name->en' => $town['en'],
                        'country_id' => $egypt->id
                    ],
                    [
                        'name' => $town
                    ]
                );
            }
            $this->command->info('Egypt towns seeded successfully.');
        } else {
            $this->command->error('Egypt country not found! Please seed countries first.');
        }

        // Find Qatar ID
        $qatar = Countries::where('name->en', 'Qatar')->orWhere('name->ar', 'قطر')->first();

        if ($qatar) {
            $qatarTowns = [
                ['ar' => 'الدوحة', 'en' => 'Doha'],
                ['ar' => 'الريان', 'en' => 'Al Rayyan'],
                ['ar' => 'الوكرة', 'en' => 'Al Wakrah'],
                ['ar' => 'أم صلال', 'en' => 'Umm Salal'],
                ['ar' => 'الخور والذخيرة', 'en' => 'Al Khor'],
                ['ar' => 'الشيحانية', 'en' => 'Al-Shahaniya'],
                ['ar' => 'الظعاين', 'en' => 'Al Daayen'],
                ['ar' => 'الشمال', 'en' => 'Al Shamal'],
            ];

            foreach ($qatarTowns as $town) {
                Town::firstOrCreate(
                    [
                        'name->en' => $town['en'],
                        'country_id' => $qatar->id
                    ],
                    [
                        'name' => $town
                    ]
                );
            }
            $this->command->info('Qatar towns seeded successfully.');
        } else {
            $this->command->error('Qatar country not found! Please seed countries first.');
        }
    }
}
