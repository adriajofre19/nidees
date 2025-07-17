<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Category::factory()->create([
            'id' => 1,
            'name' => 'Monader RALET / QUATRE RALS',
            'slug' => 'monader-ralet-quatre-rals',
            'description' => 'Monader RALET / QUATRE RALS',
        ]);

        Category::factory()->create([
            'id' => 2,
            'name' => 'Necesser ESQUITX',
            'slug' => 'necesser-esquitx',
            'description' => 'Necesser ESQUITX',
        ]);

        Category::factory()->create([
            'id' => 3,
            'name' => 'Estoig per a llibreta DRAÇERA',
            'slug' => 'estoig-per-a-llibreta-dracera',
            'description' => 'Estoig per a llibreta DRAÇERA',
        ]);

        Product::factory()->create([
            'id' => 1,
            'name' => '4RALS #11',
            'slug' => '4rals-11',
            'ca_description' => '<p>4RALS ben sostenibles! Per tenir els les monedes, els bitllets i les targetes en un sol compartiment. Amb un ganxo a la part lateral exterior per poder-lo pensar on et vagi millor! Tancament: Cremallera Mida aprox.: 9 x 6 cm Material: Plàstics reciclats, pot contenir bosses, emballages i malles de vegetals. <strong>Els colors poden variar una mica.</strong></p>',
            'description' => '<p>4RALS bien sostenibles! Para tener las monedas, los billetes y las tarjetas en un solo compartimiento. Con un gancho en la parte lateral exterior para poderlo pensar donde te vaya mejor! Cierre: Cremallera Tamaño aproximado: 9 x 6 cm Material: Plásticos reciclados, puede contener bolsas, empaques y mallas de frutas. <strong>Los colores pueden variar un poco.</strong></p>',
            'en_description' => '<p>4RALS very sustainable! To have coins, bills and cards in a single compartment. With a hook on the outside side to hang it wherever you like! Closure: Zipper Approx. size: 9 x 6 cm Material: Recycled plastics, may contain bags, packaging and fruit nets. <strong>Colors may vary slightly.</strong></p>',
            'price' => 10,
            'category_id' => 1,
        ]);
    }
}
