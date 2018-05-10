<?php

namespace App\Console\Commands;

use App\models\OutCome;
use App\models\Place;
use Illuminate\Console\Command;

class Rents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Places Rents';

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
        $places  = Place::get();
        foreach ($places as $place)
        {
            $outcome = new OutCome();
            $outcome->outcomes_type_id = 1;
            $outcome->place_id = $place->id;
            $outcome->value = $place->price;
            $outcome->save();
        }
    }
}
