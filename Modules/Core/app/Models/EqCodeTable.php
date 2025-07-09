<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\EqCodeTableFactory;

class EqCodeTable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'eq_code_table';
    protected $primaryKey = 'rowId';
    protected $fillable = [
        'soft_cust_id',
        'partition_id',
        'eq_code',
        'eq_iso_code',
        'eq_iso_code_cargo_smart',
        'eq_size_descartes',
        'iso_code_cargowise',
        'eq_iso_code_gtnexus',
        'eq_iso_code_jctrans',
        'eq_size_display',
        'eq_teus',
        'tare_weight',
        'max_cargo_weight',
        'max_cargo_cbm',
        'eq_dimention',
        'regular',
        'remarks',
        'entryBy',
        'entryDate',      
        
    ];

    // protected static function newFactory(): EqCodeTableFactory
    // {
    //     // return EqCodeTableFactory::new();
    // }
}
