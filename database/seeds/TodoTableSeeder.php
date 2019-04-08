<?php

use App\todo;
use Illuminate\Database\Seeder;


class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int)$this->command->ask('How many Todo do you need ?', 10);

        $this->command->info("Creating {$count} todo.");
        factory(App\todo::class, $count)->create()->each(function($u) {
            
            // $u->save(factory(App\todo::class)->make());
            factory(App\todo::class)->make();
            //['name' =>$gen['name']]
        });
        
    }

    // source
    
    // https://scotch.io/@wisdomanthoni/make-your-laravel-seeder-using-model-factories
    // https://laravel-news.com/learn-to-use-model-factories-in-laravel-5-1 
}
