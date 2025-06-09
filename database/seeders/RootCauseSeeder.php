<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RootCauseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $descriptions = [
            'Operator did not follow standard operating procedure (SOP).',
            'Incorrect machine calibration led to dimensional errors.',
            'Material batch received with substandard quality.',
            'Lack of proper maintenance on equipment caused failure.',
            'Inadequate training of new staff on the assembly line.',
            'Human error in measurement process during inspection.',
            'Machine sensor malfunction caused wrong readings.',
            'Inconsistent supply voltage affected process accuracy.',
            'Tool wear not detected in time, causing defects.',
            'Wrong raw material used due to label misidentification.',
        ];

        $category = [
            "machine",
            "man",
            "material",
            "method",
            "environment",
        ];

        $now = Carbon::now();

        foreach (range(1, 10) as $i) {
            DB::table('root_causes')->insert([
                'issue_id' => rand(6,7), // assuming 20 sample issues exist
                'category' => $category[rand(0,4)],
                'description' => $descriptions[array_rand($descriptions)],
                'supporting_files' => null,
                'created_by' => rand(1, 7),
                'created_at' => $now->subDays(rand(1, 30)),
                'updated_at' => $now,
            ]);
        }
    }
}
