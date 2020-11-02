<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            [ 
                'id'=> 1,
                'parent_id'=> 0,
                'section_id'=>1,
                'category_name'=> 'Mens Tops',
                'category_image'=> '',
                'category_discount'=> 0.00,
                'description'=> '',
                'url'=> 'mens-tops',
                'meta_title'=> '',
                'meta_description'=> '',
                'meta_keywords'=> '',
                'status'=> 1
            ], 
            [ 
                'id'=> 2,
                'parent_id'=> 1,
                'section_id'=> 1,
                'category_name'=> 'Mens Tops (Casual)',
                'category_image'=> '',
                'category_discount'=> 0.00,
                'description'=> '',
                'url'=> 'mens-tops-casual',
                'meta_title'=> '',
                'meta_description'=> '',
                'meta_keywords'=> '',
                'status'=> 1
            ], 
            [ 
                'id'=> 3,
                'parent_id'=> 0,
                'section_id'=> 1,
                'category_name'=> 'Mens Bottoms',
                'category_image'=> '',
                'category_discount'=> 0.00,
                'description'=> '',
                'url'=> 'mens-bottoms',
                'meta_title'=> '',
                'meta_description'=> '',
                'meta_keywords'=> '',
                'status'=> 1
            ], 
            [ 
                'id'=> 4,
                'parent_id'=> 0,
                'section_id'=> 1,
                'category_name'=> 'Mens Headwear',
                'category_image'=> '',
                'category_discount'=> 0.00,
                'description'=> '',
                'url'=> 'mens-headwear',
                'meta_title'=> '',
                'meta_description'=> '',
                'meta_keywords'=> '',
                'status'=> 1
            ], 
        ];
        Category::insert($categoryRecords);

    }
}
