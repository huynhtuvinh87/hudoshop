<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'option' => 'title',
            'option_name' => 'Title',
            'value' => 'Laravel CMS'
        ]);
        DB::table('settings')->insert([
            'option' => 'logo',
            'option_name' => 'Logo',
            'value' => 'Laravel CMS'
        ]);
        DB::table('settings')->insert([
            'option' => 'email',
            'option_name' => 'Email',
            'value' => 'Laravel CMS'
        ]);
        DB::table('settings')->insert([
            'option' => 'keyword',
            'option_name' => 'Keyword',
            'value' => 'Laravel CMS'
        ]);
        DB::table('settings')->insert([
            'option' => 'description',
            'option_name' => 'Description',
            'value' => 'Laravel CMS'
        ]);
        DB::table('settings')->insert([
            'option' => 'google-analytics',
            'option_name' => 'Google Analytics',
            'value' => 'Laravel CMS'
        ]);
    }
}
