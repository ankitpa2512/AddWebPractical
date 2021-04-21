<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('country_reports')->insert([
	       'data' => json_encode([
	       		'ID' => 'India_001',
	       		'Country' => 'India',
	       		'Language' => 'English',
	       		'Chapters' => [
       				'#1' => [
	       				'ID' => 'India_Chapter_1',
	       				'Title' => 'Corruption',
	       				'Data' => 'Lorem ipsum text',
	       				'Sections' => [
	       					'#1' => [
			       				'ID' => 'India_Chapter_1_sec_1',
			       				'Title' => 'Government',
			       				'Data' => 'Lorem ipsum text'
		       				],
		       				'#2' => [
			       				'ID' => 'India_Chapter_1_sec_2',
			       				'Title' => 'Private',
			       				'Data' => 'Lorem ipsum text'
		       				],
	       				]
       				],
       				'#2' => [
	       				'ID' => 'India_Chapter_2',
	       				'Title' => 'Politics',
	       				'Data' => 'Lorem ipsum text',
	       				'Sections' => [
	       					'#1' => [
			       				'ID' => 'India_Chapter_2_sec_1',
			       				'Title' => 'Legal',
			       				'Data' => 'Lorem ipsum text'
		       				],
		       				'#2' => [
			       				'ID' => 'India_Chapter_2_sec_2',
			       				'Title' => 'Illegal',
			       				'Data' => 'Lorem ipsum text'
		       				],
		       				'#3' => [
			       				'ID' => 'India_Chapter_2_sec_2',
			       				'Title' => 'Nation',
			       				'Data' => 'Lorem ipsum text'
		       				],
	       				]
       				]
	       		]
	       ]),
	       'created_at' => date('Y-m-d H:i:s'),
	       'updated_at' => date('Y-m-d H:i:s')
	   ]);
    }
}
