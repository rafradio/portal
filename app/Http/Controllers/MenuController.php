<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\Menu;
use App\Policies\MenunewPolicy;

class MenuController extends Controller
{   
    public function warehouseData(Request $request, Response $response)
    {
//        $user = User::factory()-create();
//        $user = User::firstOrCreate(
//            ['name' => "test",'email' => "test5", 'password' => "test"]
//        );
        
        $user = User::find(2);
        Auth::shouldUse($user);
        $test = 'test2';

//        dd(Gate::allows('testcheck2', null));
        
        if (! Gate::forUser($user)->allows('testcheck2', $test)) {
            try {
                throw new AuthorizationException('У вас нет разрешения на изменение статуса прихода.');
            } catch (AuthorizationException $e) {
                dd($e->getMessage());
            }
        }
        
        $htmlContent = '<h1>Hello laravel controller</h1>';
        $menuItems = Menu::whereNull('parent_id')
                            ->orderBy('order')
                            ->with('children') 
                            ->get()
                            ->toArray();
        
        $menuItems1 = Menu::whereNull('parent_id')
                ->orderBy('order')
                ->with('allChildrenRecursive')
                ->get()
                ->toArray();

        $newRes = $this->buildTree($menuItems1, []);
        dd($newRes);
        
        return response($htmlContent, 200)->header('Content-Type', 'text/html');
    }
    
    public function buildTree($categories, $arr) {
        foreach ($categories as $cat) {
            $arr[] = [
                'id' => $cat['id'], 
                "title" => $cat['title'],
                'children'=> count($cat['all_children_recursive']) >0 ? $this->buildTree($cat['all_children_recursive'], $arr) : []
                ];
        };
        return $arr;
    }
    
}
