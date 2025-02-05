<?php

namespace Database\Seeders;

use App\Models\WeatherModel;
use Illuminate\Database\Seeder;

class UserWeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = $this->command->getOutput()->ask('Unesite ime grada: ');
        if ($city === null) {
            $this->command->getOutput()->error("Niste unijeli ime grada!");
        }

        $temperature = $this->command->getOutput()->ask('Unesite temperaturu: ');
        if ($temperature === null) {
            $this->command->getOutput()->error("Niste unijeli ime grada!");
        }


        $userWeather = WeatherModel::where(['city' => $city])->first();
        if ($userWeather instanceof WeatherModel) {
            $this->command->getOutput()->error('Grad sa ovim imenom vec postoji!');
            return;
        }

        WeatherModel::create([
            'city' => $city,
            'temperature' => $temperature,
        ]);

        $this->command->getOutput()->info("Uspesno ste uneli grad $city sa temperaturom $temperature");
    }
}
