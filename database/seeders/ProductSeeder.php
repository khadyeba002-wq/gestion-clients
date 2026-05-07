<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Parfum Floral',
                'description' => 'Parfum premium avec notes florales délicates',
                'price' => 45.99,
                'stock' => 50,
                'image' => '/image/p1.png',
                'is_active' => true,
                'category_id' => 1, // Parfum
            ],
            [
                'name' => 'Fond de teint Pro',
                'description' => 'Fond de teint longue tenue pour maquillage professionnel',
                'price' => 29.99,
                'stock' => 100,
                'image' => '/image/p2.png',
                'is_active' => true,
                'category_id' => 2, // Maquillage
            ],
            [
                'name' => 'Crème hydratante',
                'description' => 'Crème de soin hydratante intense pour tous les types de peau',
                'price' => 34.99,
                'stock' => 75,
                'image' => '/image/p3.png',
                'is_active' => true,
                'category_id' => 3, // Soin
            ],
            [
                'name' => 'Miroir de poche',
                'description' => 'Miroir compact avec finition dorée élégante',
                'price' => 12.99,
                'stock' => 150,
                'image' => '/image/p4.png',
                'is_active' => true,
                'category_id' => 4, // Accessoire
            ],
            [
                'name' => 'Perruque blonde',
                'description' => 'Perruque synthétique blonde ondulée premium',
                'price' => 89.99,
                'stock' => 30,
                'image' => '/image/p5.png',
                'is_active' => true,
                'category_id' => 5, // Perruques
            ],
            [
                'name' => 'Escarpins noirs',
                'description' => 'Chaussures élégantes noires pour tous les styles',
                'price' => 79.99,
                'stock' => 40,
                'image' => '/image/p6.png',
                'is_active' => true,
                'category_id' => 6, // Chaussures
            ],
            [
                'name' => 'Robe de soirée',
                'description' => 'Robe élégante de soirée en tissu premium',
                'price' => 119.99,
                'stock' => 25,
                'image' => '/image/p7.png',
                'is_active' => true,
                'category_id' => 7, // Vêtements
            ],
            [
                'name' => 'Mascara volumisant',
                'description' => 'Mascara haute définition avec effet volumisant',
                'price' => 19.99,
                'stock' => 200,
                'image' => '/image/p8.png',
                'is_active' => true,
                'category_id' => 2, // Maquillage
            ],
            [
                'name' => 'Sérum anti-âge',
                'description' => 'Sérum concentré pour rajeunir et lifter la peau',
                'price' => 55.99,
                'stock' => 60,
                'image' => '/image/p9.png',
                'is_active' => true,
                'category_id' => 3, // Soin
            ],
            [
                'name' => 'Collier doré',
                'description' => 'Collier acier inoxydable plaqué or 24k',
                'price' => 24.99,
                'stock' => 80,
                'image' => '/image/p10.png',
                'is_active' => true,
                'category_id' => 4, // Accessoire
            ],
            [
                'name' => 'Perruque châtain',
                'description' => 'Perruque lisse châtain premium premium',
                'price' => 79.99,
                'stock' => 35,
                'image' => '/image/p11.png',
                'is_active' => true,
                'category_id' => 5, // Perruques
            ],
            [
                'name' => 'Sandales d\'été',
                'description' => 'Sandales confortables parfaites pour l\'été',
                'price' => 49.99,
                'stock' => 90,
                'image' => '/image/p12.png',
                'is_active' => true,
                'category_id' => 6, // Chaussures
            ],
            [
                'name' => 'Chemise blanche',
                'description' => 'Chemise blanche classique intemporelle',
                'price' => 39.99,
                'stock' => 110,
                'image' => '/image/p13.png',
                'is_active' => true,
                'category_id' => 7, // Vêtements
            ],
            [
                'name' => 'Rouge à lèvres mat',
                'description' => 'Rouge à lèvres premium finition mate longue tenue',
                'price' => 22.99,
                'stock' => 180,
                'image' => '/image/p14.png',
                'is_active' => true,
                'category_id' => 2, // Maquillage
            ],
            [
                'name' => 'Gel nettoyant',
                'description' => 'Gel nettoyant doux pour le visage',
                'price' => 18.99,
                'stock' => 200,
                'image' => '/image/p15.png',
                'is_active' => true,
                'category_id' => 3, // Soin
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
