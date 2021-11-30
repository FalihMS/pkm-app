<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
		$this->call('PkmTypeTableSeeder');
		$this->call('RegionTableSeeder');
        $this->call('MajorTableSeeder');
	}

}

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\User::create([
            'name'	=> 'Super Admin',
            'email'	=> 'super_admin@admin.com',
            'password'	=> bcrypt('password'),
            'roles' => 1
        ]);
    }
}

class PkmTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //
        $pkmTypes =  [
            [
                'key'	=> 'PKM-GT',
                'value'	=> 'PKM Gagasan Tertulis'
            ],
            [
                'key'	=> 'PKM-KC',
                'value'	=> 'PKM Karya Cipta'
            ],
            [
                'key'	=> 'PKM-GFK',
                'value'	=> 'PKM Gagasan Futuristik Konstruktif'
            ]
          ];
          foreach($pkmTypes as $pkmType){
            \App\PkmType::create($pkmType);
          }
        
    }
}

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //
        $regions =  [
            [
                'key'	=> 'ALS',
                'value'	=> 'Alam Sutera'
            ],
            [
                'key'	=> 'BKS',
                'value'	=> 'Bekasi'
            ],
            [
                'key'	=> 'KMG',
                'value'	=> 'Kemanggisan'
            ]
          ];
          foreach($regions as $region){
            \App\Region::create($region);
          }
        
    }
}

class MajorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //
        $majors =  [
            [
                'key'	=> 'SI',
                'value'	=> 'Sistem Informasi'
            ],
            [
                'key'	=> 'SI-GC',
                'value'	=> 'Sistem Informasi Global Class'
            ],
            [
                'key'	=> 'BIT',
                'value'	=> 'Business Information Technology'
            ],
            [
                'key'	=> 'SI-M-DD',
                'value'	=> 'Sistem Informasi Manajemen (Double Degree)'
            ],
            [
                'key'	=> 'SI-AK-DD',
                'value'	=> 'Sistem Informasi Akuntansi (Double Degree)'
            ],
            [
                'key'	=> 'SI-AK',
                'value'	=> 'Sistem Informasi Akuntansi'
            ],
            [
                'key'	=> 'SI-A',
                'value'	=> 'Sistem Informasi Audit'
            ],
            [
                'key'	=> 'SI-AK-A',
                'value'	=> 'Sistem Informasi Akuntansi & Audit'
            ]
          ];
          foreach($majors as $major){
            \App\Major::create($major);
          }
        
    }
}
