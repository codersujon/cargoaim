<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\CarrierBasicFactory;

class CarrierBasic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'carrier_basic';
    protected $primaryKey = 'rowId';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'soft_cust_id',
        'partition_id',
        'carrierCode',
        'carrierCodeNick',
        'carrierScacCode',
        'carrier_gsa',
        'carrierName',
        'carrier_name_local',
        'carrier_fin_name',
        'carrier_code_jctrans',
        'carrier_name_jctrans',
        'carrierAddress',
        'carrierType',
        'carrierWeb',
        'carrierHOcountry',
        'carrierBin',
        'carrier_remarks',
        'tracking_link',
        'track_enable',
        'telex_request_letter_file_name',
        'telex_max_free_days',
        'carrierStatus',
        'entryBy',
        'entryDate',
        'approve_by',
        'approve_date',
        'delete_by',
        'delete_date',
    ];

    // protected static function newFactory(): CarrierBasicFactory
    // {
    //     // return CarrierBasicFactory::new();
    // }
}
