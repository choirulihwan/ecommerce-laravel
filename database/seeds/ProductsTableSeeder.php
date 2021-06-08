<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Product::class, 30)->create();
        /*
        $p1 = [
        	'name'			=> 'Membumikan Alquran', 
        	'image'		=> 'uploads/products/book.png', 
        	'price'		=> 50000, 
        	'description'	=> 'Membumikan Alquran'
        ];

        $p2 = [
        	'name'			=> 'The world is Flat', 
        	'image'		=> 'uploads/products/book.png', 
        	'price'		=> 100000, 
        	'description'	=> 'The world is Flat'
        ];

        App\Product::create($p1);
        App\Product::create($p2);
        */


    }
}
