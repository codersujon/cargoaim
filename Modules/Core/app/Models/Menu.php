<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\MenuFactory;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'icon',
        'url',
        'route',
        'params',
        'parent_id',
        'has_children',
        'order',
        'permission',
        'roles',
        'is_active',
        'is_hidden',
        'target',
        'module',
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // protected static function newFactory(): MenuFactory
    // {
    //     // return MenuFactory::new();
    // }
}
