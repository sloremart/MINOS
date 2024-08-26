<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommerceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commerceTypes = [
            ['name' => 'Ferretería'],
            ['name' => 'Droguería'],
            ['name' => 'Supermercado'],
            ['name' => 'Peluquería'],
            ['name' => 'Tienda'],
            ['name' => 'Restaurante'],
            ['name' => 'Cafetería'],
            ['name' => 'Panadería'],
            ['name' => 'Carnicería'],
            ['name' => 'Pescadería'],
            ['name' => 'Frutería'],
            ['name' => 'Floristería'],
            ['name' => 'Papelería'],
            ['name' => 'Librería'],
            ['name' => 'Juguetería'],
            ['name' => 'Tienda de Ropa'],
            ['name' => 'Zapatería'],
            ['name' => 'Joyería'],
            ['name' => 'Estética'],
            ['name' => 'Gimnasio'],
            ['name' => 'Taller de Reparaciones'],
            ['name' => 'Tienda de Electrónica'],
            ['name' => 'Tienda de Mascotas'],
            ['name' => 'Kiosko'],
            ['name' => 'Mercado Ambulante'],
            ['name' => 'Almacén de Electrodomésticos']
        ];

        DB::table('commerce_types')->insert($commerceTypes);
    }
}
