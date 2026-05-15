<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

    //     $this->call([
    //     MarcaSeeder::class,
    //     ModeloSeeder::class,
    //     ColorSeeder::class,
    // ]);

    $roleAdmin = Role::firstOrCreate(['name'=> 'admin']);
    // $roleVendedor = Role::firstOrCreate(['name'=> 'vendedor']);

    Permission::firstOrCreate(['name'=>'vehiculos.index'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'vehiculos.create'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'vehiculos.store'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'vehiculos.show'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'vehiculos.edit'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'vehiculos.update'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'vehiculos.destroy'])->syncRoles([$roleAdmin]);

    Permission::firstOrCreate(['name'=>'vendedores.index'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'vendedores.create'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'vendedores.store'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'vendedores.show'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'vendedores.edit'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'vendedores.update'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'vendedores.destroy'])->syncRoles([$roleAdmin]);
    
    Permission::firstOrCreate(['name'=>'clientes.index'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'clientes.create'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'clientes.store'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'clientes.show'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'clientes.edit'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'clientes.update'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'clientes.destroy'])->syncRoles([$roleAdmin]);
 
    Permission::firstOrCreate(['name'=>'financiamientos.index'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'financiamientos.create'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'financiamientos.store'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'financiamientos.show'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'financiamientos.edit'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'financiamientos.update'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'financiamientos.destroy'])->syncRoles([$roleAdmin]);
    
    Permission::firstOrCreate(['name'=>'ventas.index'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'ventas.create'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'ventas.store'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'ventas.show'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'ventas.edit'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'ventas.update'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'ventas.destroy'])->syncRoles([$roleAdmin]);

    Permission::firstOrCreate(['name'=>'marcas.index'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'marcas.create'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'marcas.store'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'marcas.show'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'marcas.edit'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'marcas.update'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'marcas.destroy'])->syncRoles([$roleAdmin]);

    Permission::firstOrCreate(['name'=>'modelos.index'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'modelos.create'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'modelos.store'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'modelos.show'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'modelos.edit'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'modelos.update'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'modelos.destroy'])->syncRoles([$roleAdmin]);
  
    Permission::firstOrCreate(['name'=>'pagos.index'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'pagos.create'])->syncRoles([$roleAdmin]);
    Permission::firstOrCreate(['name'=>'pagos.store'])->syncRoles([$roleAdmin]);

        // User::firstOrCreate([
        //      'nombre' => 'admin',
        //      'email' => 'admin@example.com',
        //      'password' => 'admin',
        //      'activo' => true,
        //  ])->assignRole('admin');
         
    }
}
