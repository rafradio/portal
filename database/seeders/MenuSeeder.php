<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
              
        Menu::create([
            'title' => 'Общие вопросы', 
            'parent_id' => 4,
            'route_name' => 'obzh', 
            'url' => '/obzh', 
            'permission_name' => 'obzh', 
        ]);
        
        Menu::create([
            'title' => 'Продукты', 
            'parent_id' => 4,
            'route_name' => 'producty', 
            'url' => '/identifikacia', 
            'permission_name' => 'identifikacia', 
        ]);
        
        Menu::create([
            'title' => 'Иные Кассовые операции', 
            'parent_id' => 4,
            'route_name' => 'inye', 
            'url' => '/inye', 
            'permission_name' => 'inye', 
        ]);
        
        Menu::create([
            'title' => 'Карты', 
            'parent_id' => 5,
            'route_name' => 'karty', 
            'url' => '/karty', 
            'permission_name' => 'karty', 
        ]);
    }
}
