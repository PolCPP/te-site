<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->call(BouncerTableSeeder::class);
        $this->call(InstitutionsTableSeeder::class);
        $this->call(ValidatorsTableSeeder::class);
        $this->call(PersonalSkillTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(AlertsTableSeeder::class);
        $this->call(StudyKeywordTableSeeder::class);
        $this->call(CompanyKeywordTableSeeder::class);
        // Make sure the input files of this Table seeder are saved
        // as utf8 before uncommenting, otherwise it will fail.
        //$this->call(CitiesTableSeeder::class);
    }
}
