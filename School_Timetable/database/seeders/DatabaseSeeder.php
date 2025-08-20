<?php

namespace Database\Seeders;

use App\Models\Day;
use App\Models\TimeSlot;
use App\Models\Subject;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
          $days = ['Monday','Tuesday','Wednesday','Thursday','Friday'];
          foreach ($days as $d) 
            {
              Day::create(['name' => $d]);
            }

            $slots = [
            ['slot' => '9:00-09:20','order'=>1],
            ['slot' => '9:25-10:05','order'=>2],
            ['slot' => '10:05-10:45','order'=>3],
            ['slot' => '10:45-11:10','order'=>4],
            ['slot' => '11:10-11:50','order'=>5],
            ['slot' => '11:50-12:30','order'=>6],
            ['slot' => '12:30-01:10','order'=>7],
            ['slot' => '01:10-01:50','order'=>8],
            ['slot' => '01:50-02:30','order'=>9],
            ['slot' => '02:30-02:35','order'=>10],
            ['slot' => '2:35-3:15','order'=>11],
            ];
            foreach ($slots as $s) 
                {
                    TimeSlot::create($s);
                }

        $subjects = ['English','Mathematics','Hindi','Malayalam','General Science','Social Science','Computer Science','Music','Drawing','Physical Training','Yoga','Karate','Grammar','Creative English','PS/GK'];
        foreach ($subjects as $sub)
            {
              Subject::create(['name'=>$sub]);
            }
}
    
}
