<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MatchesSeeder extends Seeder
{
    private string $dataPath;

    /**
     * @param string $dataPath
     */
    public function __construct()
    {
        $this->dataPath = database_path() . '/source_data/icc_mens_t20_world_cup_json';
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $disk = Storage::build([
            'driver' => 'local',
            'root' => $this->dataPath,
        ]);
        $files = $disk->files();

        echo "Found " . count($files) . " matches\n";

        foreach($files as $file) {
            $document = file_get_contents($this->dataPath . '/' . $file);
            $data = json_decode($document, true, JSON_THROW_ON_ERROR);
            DB::table('matches')->insert([$data]);
        }
    }
}
