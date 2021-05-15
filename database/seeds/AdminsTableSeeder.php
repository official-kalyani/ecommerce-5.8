<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
        	['id' => '1','name' => 'admin','type' => 'admin','mobile' => '7381643308','email' => 'klnpriyadarsini@gmail.com','password' => '$2y$10$RyLeC5YovDlBvDUNCDuhBOkKXM7shSp4gztLSz.sLWQkM2K8ujVr.','image' => '','status' => '1'
        	],
        	['id' => '2','name' => 'john','type' => 'subadmin','mobile' => '7381643308','email' => 'john@gmail.com','password' => '123','image' => '','status' => '1'
        	],
        	['id' => '3','name' => 'tiki','type' => 'subadmin','mobile' => '7381643308','email' => 'tiki@gmail.com','password' => '123','image' => '','status' => '1'
        	],
        	['id' => '4','name' => 'guli','type' => 'subadmin','mobile' => '7381643308','email' => 'guli@gmail.com','password' => '123','image' => '','status' => '1'
        	],
        ];
        DB::table('admins')->insert($adminRecords);
        // foreach ($adminRecords as $key => $value) {
        // 	\App\Admin::create($value);
        // }
    }
}
