<?php

use Illuminate\Database\Seeder;

class EstoquesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Estoque::class,10)->create();
    }
}
