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

        for ($i = 1 ; $i <= 50 ; $i++) {
            $skill = new Skill;
            $skill->name_en = $faker->jobTitle;
            $skill->name_ar = $faker->jobTitle;
            $skill->save();
        }
    }
}
