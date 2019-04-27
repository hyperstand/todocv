<?php

use App\todo;
use App\todocontent;
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
        $this->command->info("5 content each ");

        //https://www.neontsunami.com/posts/building-relations-with-laravel-model-factories
        factory(todo::class, $count)->create()->each(function($todo_title) {
            // factory(App\todo::class)->make();
            $todo_title->mytodo()->saveMany(
                factory(todocontent::class, 5)->make()
            );
        });
        $this->command->info("Todo Created");
    }

    // source
    
    // https://scotch.io/@wisdomanthoni/make-your-laravel-seeder-using-model-factories
    // https://laravel-news.com/learn-to-use-model-factories-in-laravel-5-1 
}
