<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(4)->create();
        \App\Models\Note::factory(10)->create();
        \App\Models\ShoppingList::factory(4)->create();
        \App\Models\TaskList::factory(4)->create();
        \App\Models\Item::factory(12)->create();
        \App\Models\Task::factory(12)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
