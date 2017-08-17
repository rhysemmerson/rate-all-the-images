<?php

/**
 * imgly
 *
 * User: rhys
 * Date: 16/8/17
 * Time: 12:20 PM
 */
class UsersTableSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Jon',
            'email' => 'jon@got.com',
            'password' => bcrypt('secret'),
            'created_at' => date("Y-m-d H:i:s", time()),
            'updated_at' => date("Y-m-d H:i:s", time())
        ]);

        DB::table('users')->insert([
            'name' => 'Rhys',
            'email' => 'rhys@mail.com',
            'password' => bcrypt('secret'),
            'created_at' => date("Y-m-d H:i:s", time()),
            'updated_at' => date("Y-m-d H:i:s", time())
        ]);
    }
}