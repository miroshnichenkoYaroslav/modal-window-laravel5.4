<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FederalDistrictsTableSeeder::class);

        $this->call(RegionsTableSeeder::class);

        $this->call(DiagnosticTypesTableSeeder::class);

        $this->call(DiagnosticSubjectsTableSeeder::class);

        $this->call(DiagnosticFilesTableSeeder::class);

        $this->call(UsersTableSeeder::class);
    }
}
