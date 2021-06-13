<?php

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 2;
        $events = [
            [
                'id' => $i++,
                'event_organizer_id' => 1,
                'city_id' => 2,
                'title' => 'Event 1',
                'start_date' => "2021/06/".rand(01,30),
                'end_date' => "2021/06/".rand(01,30),
                'address' => 'test',
                'longitude' => 31.123122,
                'latitude' => 30.123122,
                'description' => 'ssss',
                'conditions' => 'qqq',
                'start_attendance' => rand(10,23).":".rand(10,59).":00",
                'end_attendance' => rand(10,23).":".rand(10,59).":00",
            ],
            [
                'id' => $i++,
                'event_organizer_id' => 1,
                'city_id' => 3,
                'title' => 'Event 2',
                'start_date' => "2021/06/".rand(01,30),
                'end_date' => "2021/06/".rand(01,30),
                'address' => 'test',
                'longitude' => 31.123122,
                'latitude' => 30.123122,
                'description' => 'ssss',
                'conditions' => 'qqq',
                'start_attendance' => rand(10,23).":".rand(10,59).":00",
                'end_attendance' => rand(10,23).":".rand(10,59).":00",
            ],
            [
                'id' => $i++,
                'event_organizer_id' => 2,
                'city_id' => 4,
                'title' => 'Event 3',
                'start_date' => "2021/06/".rand(01,30),
                'end_date' => "2021/06/".rand(01,30),
                'address' => 'test',
                'longitude' => 31.123122,
                'latitude' => 30.123122,
                'description' => 'ssss',
                'conditions' => 'qqq',
                'start_attendance' => rand(10,23).":".rand(10,59).":00",
                'end_attendance' => rand(10,23).":".rand(10,59).":00",
            ]
        ];
        Event::Insert($events);
    }
}
