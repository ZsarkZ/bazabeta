<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Team;
use App\Sport;
use App\Country;
use App\Game;
use App\Tournament;
use DB;

class ImportGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:games';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import games';

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

        $filePath = storage_path('app/import/country_tournament_game_list.txt');
        if (!file_exists($filePath)) { $this->info('File country_tournament_game_list.txt not exist'); exit; }
        Game::truncate();
        $countryTournamentGameList = json_decode(file_get_contents($filePath), true);
        $sport = Sport::where('name', 'Футбол')->first();
        foreach ($countryTournamentGameList as $key => $ctg) {

            $country = Country::where('name', $ctg['country'])->first();
            $tournament = Tournament::where('name', $ctg['tournament'])->first();
            if (empty($tournament)) {
                $tournament = new Tournament();
                $tournament->sport()->associate($sport);
                $tournament->country()->associate($country);

                $tournament->name = $ctg['tournament'];
                $tournament->keywords = $ctg['tournament'];

                $tournament->save();
            }
            if (isset($ctg['games'])) {
                foreach ($ctg['games'] as $year => $games) {
                    foreach ($games as $key => $game) {
                        $gameModel = new Game();
                        $gameModel->sport()->associate($sport);
                        $gameModel->country()->associate($country);
                        $gameModel->tournament()->associate($tournament);

                        $member_oneModel = Team::where('name', $game['member_one'])->first();
                        $member_twoModel = Team::where('name', $game['member_two'])->first();
                        if (empty($member_oneModel) || empty($member_twoModel)) { $this->info($game['member_one'].'vs'.$game['member_two']); continue; }
                        $gameModel->member_one = $member_oneModel->id;
                        $gameModel->member_two = $member_twoModel->id;

                        $gameModel->score_one = $game['score_one'];
                        $gameModel->score_two = $game['score_two'];

                        $gameModel->date = date("Y-m-d H:i:s",strtotime($game['date']));
                        $gameModel->save();
                    }
                }
            }

        }

        $this->info('Import end');
    }
}
