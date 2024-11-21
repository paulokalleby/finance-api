<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class ExpenseCategoriesSeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Alimentação']);
        Category::create(['name' => 'Moradia']);
        Category::create(['name' => 'Transporte']);
        Category::create(['name' => 'Saúde']);
        Category::create(['name' => 'Educação']);
        Category::create(['name' => 'Lazer']);
        Category::create(['name' => 'Compras']);
        Category::create(['name' => 'Dívidas e Poupança']);
        Category::create(['name' => 'Outros']);
    }
}
