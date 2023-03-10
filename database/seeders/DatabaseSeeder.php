<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $permission1 = Permission::create(['name' => 'role-index']);
        $permission2 = Permission::create(['name' => 'role-store']);
        $permission3 = Permission::create(['name' => 'role-update']);
        $permission4 = Permission::create(['name' => 'role-destroy']);
        $permission5 = Permission::create(['name' => 'permission-index']);
        $permission6 = Permission::create(['name' => 'permission-store']);
        $permission7 = Permission::create(['name' => 'permission-update']);
        $permission8 = Permission::create(['name' => 'permission-destroy']);
        $permission9 = Permission::create(['name' => 'category-index']);
        $permission10 = Permission::create(['name' => 'category-store']);
        $permission11 = Permission::create(['name' => 'category-update']);
        $permission12 = Permission::create(['name' => 'category-destroy']);
        $permission13 = Permission::create(['name' => 'product-index']);
        $permission14 = Permission::create(['name' => 'product-store']);
        $permission15 = Permission::create(['name' => 'product-update']);
        $permission16 = Permission::create(['name' => 'product-destroy']);
        $permission17 = Permission::create(['name' => 'reports-index']);
        $permission18 = Permission::create(['name' => 'pos-index']);
        $permission19 = Permission::create(['name' => 'sales-index']);
        $permission20 = Permission::create(['name' => 'order-index']);
        $permission21 = Permission::create(['name' => 'order-store']);
        $permission22 = Permission::create(['name' => 'order-update']);
        $permission23 = Permission::create(['name' => 'order-destroy']);
        $permission24 = Permission::create(['name' => 'request-index']);
        $permission25 = Permission::create(['name' => 'request-store']);
        $permission26 = Permission::create(['name' => 'request-update']);
        $permission27 = Permission::create(['name' => 'request-destroy']);
        $permission28 = Permission::create(['name' => 'user-index']);
        $permission29 = Permission::create(['name' => 'user-store']);
        $permission30 = Permission::create(['name' => 'user-update']);
        $permission31 = Permission::create(['name' => 'user-destroy']);
        $role = Role::create(['name' => 'Admin']);
        $role->syncPermissions([$permission1, $permission2, $permission3, $permission4, $permission5, $permission6, $permission7, $permission8, $permission9, $permission10, $permission11, $permission12, $permission13, $permission14, $permission15, $permission16, $permission17, $permission18, $permission19, $permission20, $permission21, $permission22, $permission23, $permission24, $permission25, $permission26, $permission27, $permission28, $permission29, $permission30, $permission31]);
        $user = User::factory()->create([
            'name' => 'Mike POnce',
            'email' => 'mike@example.com',
            'password' => bcrypt('123')
        ]);
        $user->assignRole($role);
        Category::create(
            [
                'name' => 'Útiles Escolares',
                'description' => 'descripcion utiles escolares.',
            ]
        );
        Category::create(
            [
                'name' => 'Ropa y Zapatos',
                'description' => 'descripcion ropa y zapatos.',
            ]
        );
        Category::create(
            [
                'name' => 'Artículos Electrónicos',
                'description' => 'descripcion articulos electronicos.',
            ]
        );
        Category::create(

            [
                'name' => 'Frutas y Verduras',
                'description' => 'descripcion frutas y verduras.',
            ]
        );

        Product::create(
            [
                'nombre' => 'Cuaderno a rayas 60 hojas marca Loro',
                'descripcion' => 'Cuaderno a rayas 60 hojas marca Loro',
                'cantidad' => 1000,
                'precio_anterior' => '36.00',
                'precio_sin_iva' => '31.304347826087',
                'category_id' => '1',
            ]
        );
    }
}
