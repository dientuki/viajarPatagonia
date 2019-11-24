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
            AvailabilityTableSeeder::class,
            AvailabilityTranslationSeeder::class,
            DurationTableSeeder::class,
            DurationTranslationSeeder::class,                   
            ExcursionsTypesTableSeeder::class,
            ExcursionsTypesTranslationSeeder::class,
            ExcursionsTableSeeder::class,
            ExcursionsTranslationSeeder::class,
            ExcursionsPricesSeeder::class,
            PackagesTableSeeder::class,
            PackagesTranslationSeeder::class,
            PackagesPricesSeeder::class,
            Package2ExcursionSeeder::class,
            Package2DestinationSeeder::class,     
            HomesliderTableSeeder::class,
            HomesliderTranslationSeeder::class,
            InquiriesTableSeeder::class          
        ]);
    }
}
