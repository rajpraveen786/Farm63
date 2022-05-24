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
        $this->call(AdminCred::class);
        $this->call(CMS::class);
        $this->call(SEODB::class);
        $this->call(Settings::class);
    }
}
