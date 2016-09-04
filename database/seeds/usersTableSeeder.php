<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class usersTableSeeder extends Seeder {

	public function run()
	{
			DB::table('users')->delete();

			DB::table('users')->insert([
				'id' => 1,
				'name' => 'test user1',
				'phone' => 375293107600,
				'debt' => 7500,
				'textTalk' => "text text\ntext text",
				'audioTalk' => "003.mp3, 004.mp3",
				'slug' =>'NaRVV2l',
				'status' => 0,
				'created_at' => new DateTime,
				'updated_at' => new DateTime
			]);
		
	}

}
