<?php

namespace Database\Seeders;

use App\Models\Tema;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Tema::create(['title'=> "Vektori un kustība"]);
        Tema::create(['title'=> "Līnijas vienādojums"]);
        Tema::create(['title'=> "Kombinatorika un varbūtība I"]);
        Tema::create(['title'=> "Statistika I"]);
        Tema::create(['title'=> "Daļveida funkcija un algebriskas daļas"]);
        Tema::create(['title'=> "Daļveida vienādojumi un nevienādības"]);
        Tema::create(['title'=> "Sinusa un kosinusa funkcijas"]);
        Tema::create(['title'=> "Trigonometriskās izteiksmes un vienādojumi"]);
        Tema::create(['title'=> "Pakāpe ar racionālu kāpinātāju, ģeometriskā progresija"]);
        Tema::create(['title'=> "Eksponentfunkcija"]);
        Tema::create(['title'=> "Taisnes un plaknes telpā. Daudzskaldņi"]);
        Tema::create(['title'=> "Rotācijas ķermeņi"]);
    }
}
