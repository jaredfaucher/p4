<?php
 
class ImageTableSeeder extends Seeder {
 
	public function run()
    {
  		$image = Image::create(array(
  			'user_id' => '1',
  			'filename' => 'surly-steamroller-19004_4.jpg',
  			'size' => '192390',
  			'profile' => true,
            'title' => 'Surly Steamroller',
            'description' => "mattpelaggi's Surly Steamroller",
            'imgurId' => 'iT5dbRM',
            'url' => 'http://imgur.com/iT5dbRM'));
        $image = Image::create(array(
            'user_id' => '2',
            'filename' => 'planet-x-pro-carbon-hhsb-13420_18.jpg',
            'size' => '194071',
            'profile' => true,
            'title' => 'Planet X Pro Carbon HHSB',
            'description' => "HNFXD's Planet X Pro Carbon HHSB",
            'imgurId' => 'd65aHcp',
            'url' => 'http://imgur.com/d65aHcp'));
        $image = Image::create(array(
            'user_id' => '2',
            'filename' => 'dolan-pre-cursa-blue-18115_7.jpg',
            'size' => '206464',
            'profile' => false,
            'title' => 'Dolan Pre Cursa Blue',
            'description' => "HNFXD'S Dolan Pre Cursa Blue",
            'imgurId' => 'RsmoKyq',
            'url' => 'http://imgur.com/RsmoKyq'));
        $image = Image::create(array(
            'user_id' => '3',
            'filename' => 'ktts_raw_3q-21.jpg',
            'size' => '476716',
            'profile' => true,
            'title' => 'Mercier Kilo Stripper',
            'description' => "JaredFaucher's Mercier Kilo Stripper",
            'imgurId' => 'RzR0P8F',
            'url' => 'http://imgur.com/RzR0P8F'));
  	}
 
}