<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\FilingContractRateFactory;

class FilingContractRate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'filing_contract_rate';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'soft_cust_id',
        'billing_id',
        'partition_id',
        'billng_cycle',
        'invoice_per_cycly_or_mbl',
        'filing_type',
        'business_unit',
        'business_unit_full',
        'business_unit_address',
        'login_id_for_external_filer',
        'email_addresses',
        'email_cc',
        'user_eori_scac',
        'user_scac_eori_full',
        'applicable_rates_hbl',
        'inv_currency',
        'inv_roe',
        'status',
        'contract_for',
        'contact_appval_status',
    ];

    // protected static function newFactory(): FilingContractRateFactory
    // {
    //     // return FilingContractRateFactory::new();
    // }
}
