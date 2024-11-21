<?php

namespace Database\Seeders;

use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourcesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        /**Catgories */
        $resource = Resource::create(['name' => 'Categorias']);

        $resource->permissions()->create([
            'name' => 'Listar',
            'slug' => 'categories.index'
        ]);

        $resource->permissions()->create([
            'name' => 'Ver',
            'slug' => 'categories.show'
        ]);

        $resource->permissions()->create([
            'name' => 'Criar',
            'slug' => 'categories.store'
        ]);

        $resource->permissions()->create([
            'name' => 'Editar',
            'slug' => 'categories.update'
        ]);

        $resource->permissions()->create([
            'name' => 'Excluir',
            'slug' => 'categories.destroy'
        ]);


        /**Roles */
        $resource = Resource::create(['name' => 'Papéis']);

        $resource->permissions()->create([
            'name' => 'Listar',
            'slug' => 'roles.index'
        ]);

        $resource->permissions()->create([
            'name' => 'Ver',
            'slug' => 'roles.show'
        ]);

        $resource->permissions()->create([
            'name' => 'Criar',
            'slug' => 'roles.store'
        ]);

        $resource->permissions()->create([
            'name' => 'Editar',
            'slug' => 'roles.update'
        ]);

        $resource->permissions()->create([
            'name' => 'Excluir',
            'slug' => 'roles.destroy'
        ]);

        $resource->permissions()->create([
            'name' => 'Permissões',
            'slug' => 'roles.permissions'
        ]);

        /**Users */
        $resource = Resource::create(['name' => 'Usuários']);

        $resource->permissions()->create([
            'name' => 'Listar',
            'slug' => 'users.index'
        ]);

        $resource->permissions()->create([
            'name' => 'Ver',
            'slug' => 'users.show'
        ]);

        $resource->permissions()->create([
            'name' => 'Criar',
            'slug' => 'users.store'
        ]);

        $resource->permissions()->create([
            'name' => 'Editar',
            'slug' => 'users.update'
        ]);

        $resource->permissions()->create([
            'name' => 'Excluir',
            'slug' => 'users.destroy'
        ]);
    }
}
