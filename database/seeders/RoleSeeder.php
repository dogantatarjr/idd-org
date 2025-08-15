<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $writerRole = Role::create(['name' => 'writer']); // Yazar Rolü
        $editArticles_Permission = Permission::create(['name' => 'edit-articles']); // Makaleleri Düzenleme İzni

        $writerRole->givePermissionTo($editArticles_Permission); // Yazar rolüne makaleleri düzenleme izni verilir.

        $user = User::where('email', 'writer1@example.com')->first();
        $user->assignRole($writerRole); // Kullanıcıya yazar rolü atanır.
    }
}
