<?php

use App\Image;
use App\User;
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
         $this->call(UsersTableSeeder::class);
         $this->call(ImageTableSeeder::class);

         $user = User::all()->first();

         Image::all()
             ->take(20)
             ->each(function($image) use($user) {
                 factory(\App\Rating::class)
                     ->create([
                         'image_id' => $image->id,
                         'user_id' => $user->id
                     ]);
             });
    }
}
