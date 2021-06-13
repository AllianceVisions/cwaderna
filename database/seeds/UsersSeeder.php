<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\EventOrganizer;
use App\Models\ProviderMan;
use App\Models\Cader;
use App\Models\PreviousExperience;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'first_name'     => 'Jungle',
                'last_name'      => 'Pro',
                'phone'          => '010',
                'gender'         => 'male',
                'nationality'    => 'Egyptian',
                'national_id'    => '220111643',
                'city_id'        => 1,
                'user_type'      => 'staff',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'approved'       => 1,
            ],
            [
                'id'             => 2,
                'first_name'     => 'Jumnji',
                'last_name'      => 'new',
                'phone'          => '011',
                'gender'         => 'female',
                'nationality'    => 'Egyptian',
                'national_id'    => '22011112341643',
                'city_id'        => 2,
                'user_type'      => 'cader',
                'email'          => 'cader@cader.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'approved'       => 1,
            ],
            [
                'id'             => 3,
                'first_name'     => 'Shoot',
                'last_name'      => 'ZzZ',
                'phone'          => '010',
                'gender'         => 'male',
                'nationality'    => 'Egyptian',
                'national_id'    => '2201123421643',
                'city_id'        => 3,
                'user_type'      => 'events_organizer',
                'email'          => 'organizer@organizer.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'approved'       => 1,
            ],
            [
                'id'             => 4,
                'first_name'     => 'MKV',
                'last_name'      => 'Bee',
                'phone'          => '010',
                'gender'         => 'male',
                'nationality'    => 'Egyptian',
                'national_id'    => '220111643',
                'city_id'        => 4,
                'user_type'      => 'provider_man',
                'email'          => 'provider@provider.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'approved'       => 1,
            ],
            [
                'id'             => 5,
                'first_name'     => 'LOL',
                'last_name'      => 'Here',
                'phone'          => '010',
                'gender'         => 'male',
                'nationality'    => 'Egyptian',
                'national_id'    => '2201123421643',
                'city_id'        => 5,
                'user_type'      => 'staff',
                'email'          => 'staff@staff.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'approved'       => 1,
            ],
            [
                'id'             => 6,
                'first_name'     => 'Shoot2',
                'last_name'      => 'ZzZ2',
                'phone'          => '010',
                'gender'         => 'male',
                'nationality'    => 'Egyptian',
                'national_id'    => '2201123421643',
                'city_id'        => 6,
                'user_type'      => 'events_organizer',
                'email'          => 'organizer2@organizer2.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'approved'       => 1,
            ],
        ];

        User::insert($users);

        Cader::create([
            'user_id' => 2,
            'specialization' => 'test1',
            'description' => 'test2',
        ]);

        PreviousExperience::create([
            'user_id' => 2,
            'company_name' => 'Marketing Company',
            'start_date' => rand(01,15)."/06/2021",
            'end_date' => rand(15,30)."/06/2021",
            'job_type' => 'Developer',
        ]);

        EventOrganizer::insert([
            'id' => 1,
            'user_id' => 3,
            'company_name' => 'M Q',
        ]);
        EventOrganizer::insert([
            'id' => 2,
            'user_id' => 6,
            'company_name' => 'W Z',
        ]);

        ProviderMan::create(['user_id' => 4]);
    }
}

