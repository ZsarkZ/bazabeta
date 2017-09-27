<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Team;
use App\Sport;
use App\Country;

class ImportTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:teams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Teams Table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Import start');

        $filePath = storage_path('app/import/json_teams.txt');
        if (!file_exists($filePath)) { $this->info('File json_countries.txt not exist'); exit; }
        Team::truncate();
        $teamList = json_decode(file_get_contents($filePath), true);
        foreach ($teamList as $key => $team) {
            $sport = Sport::where('name', 'Футбол')->first();
            $country = Country::where('name', $team['Страна'])->first();

            if ($key == 925) { continue; }

            $teamModel = new Team();
            $teamModel->sport()->associate($sport);
            $teamModel->country()->associate($country);

            $teamModel->name = isset($team['Комада']) ? $team['Комада'] : '';
            $teamModel->trainer = isset($team['Тренер']) ? $team['Тренер'] : '';
            $teamModel->foundation = isset($team['Год основания']) ? $team['Год основания'] : '';
            $teamModel->website = isset($team['Официальный сайт']) ? $team['Официальный сайт'] : '';
            $teamModel->stadium = isset($team['Стадион']) ? $team['Стадион'] : '';
            $teamModel->keywords = $team['keywords'];

            $teamModel->save();
        }

        $this->info('Import end');
    }
}
