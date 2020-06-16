<?php

namespace App\Console\Commands;

use DB;
use App\Models\Property;
use Illuminate\Console\Command;

class FeedloadCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load data from csv to database';

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
        DB::transaction(function () {
            $path = storage_path(implode(DIRECTORY_SEPARATOR, ["app", "public", "property-data.csv"]));
            $csv = fopen($path, "r");
            $i = 0;
            while (($line = fgetcsv($csv, 0, ",")) !== false) {
                if ($i > 0) {
                    $property = new Property();
                    $property->name = $line[0];
                    $property->price = $line[1];
                    $property->bedrooms = $line[2];
                    $property->bathrooms = $line[3];
                    $property->storeys = $line[4];
                    $property->garages = $line[5];
                    $property->save();
                }
                $i++;
            }
            fclose($csv);
        });
        echo "Data uploaded successfully";
        return;
    }
}
