<?php

namespace Modules\IcsEns\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\IcsEns\Database\Factories\CustomsFilingEqDetailsFactory;

class CustomsFilingEqDetails extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'customs_filing_eq_details';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'soft_cust_id',
        'partition_id',
        'business_unit',
        'bkg_no',
        'hbl_no',
        'ultimate_hbl_no',
        'mbl_no',
        'container_no',
        'size_iso',
        'seal_no',
        'pkg_type',
        'pkg_qty',
        'weight_kg',
        'cbm',
        'hs_code',
        'un_code_dg',
        'cargo_marks',
        'cargo_description',
        'version',
        'status',
        'entry_by',
        'entry_date',
        'update_by',
        'update_date',
        'delete_by',
        'delete_date',
    ];

    public $timestamps = false;

    // protected static function newFactory(): CustomsFilingEqDetailsFactory
    // {
    //     // return CustomsFilingEqDetailsFactory::new();
    // }
}
