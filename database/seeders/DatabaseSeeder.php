<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Categories;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'admin'
        ]);

        $category = Categories::create([
            'name' => 'Teknologi'
        ]);

        Post::create([
            'Title' => 'Kendaraan Udara Orang Kalimantan',
            'slug' => 'kendaraan-orang-kalimantan',
            'content' => 'ini adalah kendaraan yang dipakain di...',
            'Img' => 'contoh.jpg',
            'user_id' => $admin->id,
            'category_id' => $category->id
        ]);
    }
}
