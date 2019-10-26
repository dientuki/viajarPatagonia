<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            RegionsTableSeeder::class,
            DestinationsTableSeeder::class,
            CurrenciesTableSeeder::class,
            LanguagesTableSeeder::class,
            CruiseshipsTypesTableSeeder::class,
            CruiseshipsTypesTranslationSeeder::class,
            CruiseshipsTableSeeder::class,
            CruiseshipsTranslationSeeder::class,
            CruiseshipsPricesSeeder::class,

            ExcursionsTypesTableSeeder::class,
            ExcursionsTypesTranslationSeeder::class,
            ExcursionsTableSeeder::class,
            ExcursionsTranslationSeeder::class,
            ExcursionsPricesSeeder::class,
        ]);
    }
}
