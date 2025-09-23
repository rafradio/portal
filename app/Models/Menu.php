<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    protected $table = "menu";
    
    protected $fillable = [
        'parent_id', 'title', 'route_name', 'url', 'permission_name', 'order'
    ];
    
    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }
    
    public function allChildrenRecursive(): HasMany
    {
        return $this->children()->with('allChildrenRecursive');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

}
