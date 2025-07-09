<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\CountryTableFactory;

class CountryTable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'country_table';
    protected $primaryKey = 'rowId';
    protected $fillable = [
        'countryName',
        'countryCode',
        'ts_country',
        'countryPhoneCode',
        
    ];

    // protected static function newFactory(): CountryTableFactory
    // {
    //     // return CountryTableFactory::new();
    // }
}
