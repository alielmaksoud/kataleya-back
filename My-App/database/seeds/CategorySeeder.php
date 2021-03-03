<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1, 'category_name' => 'Men','description'=>'category', ],
            ['id' => 2, 'category_name' => 'Women','description'=>'category', ],
            ['id' => 3, 'category_name' => 'UniSex','description'=>'category', ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}