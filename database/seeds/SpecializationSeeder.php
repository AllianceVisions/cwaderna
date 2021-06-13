<?php

use Illuminate\Database\Seeder;
use App\Models\Specialization;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create(); 

        for ($i = 1 ; $i <= 50 ; $i++) {
            $specialization = new Specialization;
            $specialization->name_en = $faker->jobTitle;
            $specialization->name_ar = $faker->jobTitle;
            $specialization->save();
        }
    }
}
