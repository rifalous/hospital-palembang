<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = new App\Currency;
        $currency->name = 'US Dollar';
        $currency->alias = 'usd';
        $currency->code = 840;
        $currency->symbol = '$';
        $currency->convertion = 1;
        $currency->thousand_separator = ',';
        $currency->decimal_separator = '.';
        $currency->save();
    }
}
