<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Produto 1',
                'description' => 'Descrição do produto 1',
                'price' => 199.99,
                'image' => 'https://via.placeholder.com/400x300?text=Produto+1'
            ],
            [
                'name' => 'Produto 2',
                'description' => 'Descrição do produto 2',
                'price' => 99.99,
                'image' => 'https://via.placeholder.com/400x300?text=Produto+2'
            ],
            [
                'name' => 'Produto 3',
                'description' => 'Descrição do produto 3',
                'price' => 299.99,
                'image' => 'https://via.placeholder.com/400x300?text=Produto+3'
            ],
            [
                'name' => 'Produto 4',
                'description' => 'Descrição do produto 4',
                'price' => 150.00,
                'image' => 'https://via.placeholder.com/400x300?text=Produto+4'
            ],
            [
                'name' => 'Produto 5',
                'description' => 'Descrição do produto 5',
                'price' => 129.90,
                'image' => 'https://via.placeholder.com/400x300?text=Produto+5'
            ],
            [
                'name' => 'Produto 6',
                'description' => 'Descrição do produto 6',
                'price' => 220.50,
                'image' => 'https://via.placeholder.com/400x300?text=Produto+6'
            ],
            [
                'name' => 'Produto 7',
                'description' => 'Descrição do produto 7',
                'price' => 110.75,
                'image' => 'https://via.placeholder.com/400x300?text=Produto+7'
            ],
            [
                'name' => 'Produto 8',
                'description' => 'Descrição do produto 8',
                'price' => 85.60,
                'image' => 'https://via.placeholder.com/400x300?text=Produto+8'
            ],
            [
                'name' => 'Produto 9',
                'description' => 'Descrição do produto 9',
                'price' => 50.00,
                'image' => 'https://via.placeholder.com/400x300?text=Produto+9'
            ],
            [
                'name' => 'Produto 10',
                'description' => 'Descrição do produto 10',
                'price' => 80.00,
                'image' => 'https://via.placeholder.com/400x300?text=Produto+10'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
