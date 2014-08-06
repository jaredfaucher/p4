<?php
 
class UserTableSeeder extends Seeder {
 
	public function run()
    {
  		$user = User::create(array(
  			'username' => 'mattpelaggi',
  			'email' => 'bikeswap1@gmail.com',
  			'zip' => '02145',
  			'password' => Hash::make('password'));
  		
  		$user = User::create(array(
  			'username' => 'HNFXD',
  			'email' => 'bikeswap2@gmail.com',
  			'zip' => '02458',
  			'password' => Hash::make('password'));
  		
  		$user = User::create(array(
  			'username' => 'JaredFaucher',
  			'email' => 'jared.faucher@gmail.com',
  			'zip' => '02145',
  			'password' => Hash::make('password'));		
  	}
 
}