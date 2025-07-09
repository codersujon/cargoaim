<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\CustomsFilingScacEoriCodedFactory;

class CustomsFilingScacEoriCoded extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'customs_filing_scac_eori_coded';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'soft_cust_id',
        'partition_id',
        'business_unit',
        'scac_code',
        'eori_code',
        'scac_eori_full',
        'code_owner_type',
        'carrier_code_jc_trans',
        'carrier_name_jc_trans',
        'scac_owner_agent_code',
        'scac_eori_owner_city',
        'scac_eori_owner_country',
        'scac_eori_owner_post_code',
        'scac_eori_owner_address',
        'scac_eori_owner_phone',
        'scac_eori_owner_email',
        'edi_company',
        'edi_file_name',
        'edi_file_folder',
        'status',
        'entry_by',
        'entry_date',
        'update_by',
        'update_date',
        'delete_by',
        'delete_date',
    ];

    // protected static function newFactory(): CustomsFilingScacEoriCodedFactory
    // {
    //     // return CustomsFilingScacEoriCodedFactory::new();
    // }
}
