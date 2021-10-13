<?php

namespace App\Console\Commands;

use App\Imports\CitiesImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class cities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'store cities from data CSV';

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
     * @return int
     */
    public function handle()
    {
        
        Excel::import(new CitiesImport, storage_path('app/public/cities/villes_france.csv'));
        
    
    }
    
}
