<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
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
            [
                'id'=> 1, 
                'name'      =>  'admin', 
                'type'      =>  'admin', 
                'mobile'    =>  '980000000', 
                'email'     =>  'admin@admin.com', 
                'password'  =>  '$2y$10$Rcpvk7m299GRk7RwxkdmZuw0sj/6hY6jq4pYdtY8zcsH4J5eYwkOS',
                'image'     =>  '',
                'status'    =>  1,
            ],
        ];
        //

        foreach($adminRecords as $key => $record){
            Admin::create($record);
        }
    }
}
