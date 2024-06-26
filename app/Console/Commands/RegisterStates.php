<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\State;
use Illuminate\Support\Facades\Artisan;

class RegisterStates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RegisterStates';

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

        $url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados';

        $response = Http::get($url);

        $states = json_decode($response->body());

        foreach ($states as $state) {
            State::updateOrCreate(
                [
                    'name' => $state->nome,
                    'abbreviation' => $state->sigla,
                    ],
                [
                    'name' => $state->nome,
                    'abbreviation' => $state->sigla,
                    ]
            );
        }

        Artisan::call('RegisterCities');

        return dump('OK');
    }
}
