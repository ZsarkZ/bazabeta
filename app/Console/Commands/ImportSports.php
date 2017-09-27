<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Sport;

class ImportSports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:sports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Sports Table';

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

        $sportList = ['Футбол', 'Хоккей', 'Баскетбол', 'Теннис', 'Волейбол', 'Бокс', 'UFC'];
        Sport::truncate();
        foreach ($sportList as $key => $sport) {
            $tmpData = [
                'name'=> $sport
            ];
            Sport::create($tmpData)->save();
        }

        $this->info('Import end');
    }
}
