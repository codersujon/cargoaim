<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\PkgCodeTableFactory;

class PkgCodeTable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'pkg_code_table';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'soft_cust_id',
        'partition_id',
        'highly_available',
        'pkg_code',
        'pkg_code_three_digit',
        'pkg_description',
        'show_e_bkg_list',
        'entry_by',
        'status',
        'entry_date',     
        
    ];

    // protected static function newFactory(): PkgCodeTableFactory
    // {
    //     // return PkgCodeTableFactory::new();
    // }
}
