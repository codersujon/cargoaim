<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\CustomerAddressFactory;

class CustomerAddress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'customer_address';
    protected $primaryKey = 'rowId';
    protected $fillable = [
        'soft_cust_id',
        'partition_id',
        'customerCode',
        'customer_full_name',
        'customerAddressType',
        'customerAddress',
        'customerAddressPhone',
        'customerAddressFax',
        'customerAddressEmail',
        'customer_address_bin_number',
        'customerAddressCountry',
        'address_city',
        'address_state',
        'address_zip',
        'customerAddressStatus',
        'bill_address',
        'bl_address',
        'factory_address',
        'general_address',
        'office_address',
        'warehouse_address',
        'ams_address',
        'an_address',
        'entryBy',
        'entryDate',
        'update_by',
        'update_date',
        'delete_by',
        'delete_date',
        
    ];

    // protected static function newFactory(): CustomerAddressFactory
    // {
    //     // return CustomerAddressFactory::new();
    // }
}
