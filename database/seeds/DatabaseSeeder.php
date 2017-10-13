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
         factory(App\User::class,2)->create();
         $this->call('UsersTableSeeder');
         $this->call('ProductsTableSeeder');
         $this->call('EstoquesTableSeeder');
       
          
        
    }
}
