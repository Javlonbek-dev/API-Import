<?php

namespace App\Console\Commands;

use App\Models\Currencies;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class Currency extends Command
{

    protected $signature = 'currency:fetch';

    protected $description = 'Fetch currency data from openexchangerates.org API';

    public function handle()
    {
        $response = Http::get('https://openexchangerates.org/api/currencies.json?prettyprint=false&show_alternative=false&show_inactive=false&app_id=YOUR_APP_ID');

        if ($response->successful()) {
            $currenciesData = $response->json();

            foreach ($currenciesData as $country => $currencyCode) {
                Currencies::create(
                    ['country' => $country],
                    ['currency_code' => $currencyCode]
                );
            }

            $this->info('Currency data fetched and stored successfully.');
        } else {
            $this->error('Failed to fetch currency data.');
        }
    }
}
