<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\LanguageFactory;

class Language extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'language';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'apply_on_type',
        'message_id_to_call',
        'en',
        'bn',
        'cn',
        'th',
        'vn',
        'kh',
        'remarks',
    ];

    // protected static function newFactory(): LanguageFactory
    // {
    //     // return LanguageFactory::new();
    // }
}
