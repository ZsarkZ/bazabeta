<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Country;

class ImportCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Countries Table';

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

        $filePath = storage_path('app/import/json_countries.txt');
        if (!file_exists($filePath)) { $this->info('File json_countries.txt not exist'); exit; }
        Country::truncate();
        $countryList = json_decode(file_get_contents($filePath), true);
        foreach ($countryList as $key => $country) {
            Country::create($country)->save();
        }

        $this->info('Import end');
    }
}
