<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Auth\Database\Factories\ProfileFactory;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'contact',
        'other_contact',
        'address',
        'logo',
        'fav_icon',
        'fb_link',
        'whatsapp_link',
        'twiter_link',
        'instra_link',
        'youTube_link',
        'telegram_link',
        'viber_link',
        'botim_link',
        'location',
        'message',
        'copyright',
    ];

    // protected static function newFactory(): ProfileFactory
    // {
    //     // return ProfileFactory::new();
    // }
}
