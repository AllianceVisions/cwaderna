<?php

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create(); 

        $ar = ['اللفة العربية','اللفة الأنجليزية','اللفة الفرنسية'];
        $en = ['Arabic Language','English Language','French Language'];

        for ($i = 1 ; $i <= 2 ; $i++) {
            $skill = new Skill;
            $skill->name_en = $en[$i];
            $skill->name_ar = $ar[$i];
            $skill->save();
        }
    }
}
