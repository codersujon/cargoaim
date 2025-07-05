<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Auth\Database\Factories\LoginPageSliderFactory;

class LoginPageSlider extends Model
{
    use HasFactory;
   
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    // protected static function newFactory(): LoginPageSliderFactory
    // {
    //     // return LoginPageSliderFactory::new();
    // }
}
