<?php

namespace App\Console\Commands;

use App\Models\City;
use Illuminate\Console\Command;
use App\Models\State;
use Illuminate\Support\Facades\Http;

class RegisterCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RegisterCities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $states = State::all();

        foreach ($states as $state) {

            $url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/'.$state->abbreviation.'/distritos';

            $response = Http::get($url);

            $cities = json_decode($response->body());

            foreach ($cities as $city) {
                City::updateOrCreate(
                    [
                    'name' => $city->nome,
                    'state_id' => $state->id,
                    ],
                    [
                    'name' => $city->nome,
                    'state_id' => $state->id,
                    ]
                );
            }

        }
        return dump('Termino do processo');
    }
}
