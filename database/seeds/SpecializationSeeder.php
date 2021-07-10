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

        $ar = ['ممثل','حارث','مصمم','سائق'];
        $en = ['Actor','Security','Designer','Driver'];

        for ($i = 1 ; $i <= 3 ; $i++) {
            $specialization = new Specialization;
            $specialization->name_en = $en[$i];
            $specialization->name_ar = $ar[$i];
            $specialization->save();
        }
    }
}
