<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Tournament;
use App\Sport;
use App\Country;
use DB;

class ImportTournaments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tournaments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Tournaments Table';

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

        $filePath = storage_path('app/import/json_tournaments.txt');
        if (!file_exists($filePath)) { $this->info('File json_tournaments.txt not exist'); exit; }
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Tournament::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $tournamentList = json_decode(file_get_contents($filePath), true);

        foreach ($tournamentList as $key => $tournament) {
            $sport = Sport::where('name', 'Футбол')->first();
            $country = Country::where('name', $tournament['country'])->first();

            $tournamentModel = new Tournament();
            $tournamentModel->sport()->associate($sport);
            $tournamentModel->country()->associate($country);

            $tournamentModel->name = isset($tournament['name']) ? $tournament['name'] : '';
            $tournamentModel->keywords = $tournament['keywords'];

            $tournamentModel->save();
        }

        $this->info('Import end');
    }
}
