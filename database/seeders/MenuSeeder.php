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
            'title' => 'Резиденты/Нерезиденты', 
            'parent_id' => 6,
            'route_name' => 'reznerez', 
            'url' => '/reznerez', 
            'permission_name' => 'reznerez', 
        ]);
        
        Menu::create([
            'title' => 'Доверенности', 
            'parent_id' => 6,
            'route_name' => 'doveren', 
            'url' => '/doveren', 
            'permission_name' => 'doveren', 
        ]);
        
        Menu::create([
            'title' => 'Биометрия', 
            'parent_id' => 6,
            'route_name' => 'byometri', 
            'url' => '/byometri', 
            'permission_name' => 'byometri', 
        ]);
    }
}
