<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\LocationTableFactory;

class LocationTable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'location_table';
    protected $primaryKey = 'rowId';
    protected $fillable = [
        'locationCode',
        'locationName',
        'cityCode',
        'state_code',
        'state_full',
        'zip_code',
        'countryCode',
        'countryName',
        'ts_country',
        'country_group',
        'location_print_on_bl',
        'locationSeaAirLand',
        'asycuda_loation_code',
        'us_fmc_ams_ode',
        'asycuda_customs_code',
        'e_signature',
        'mandatory_customs_filing',
        'status',
        'entry_by',
        'entry_date',
        'update_by',
        'update_date',
    ];

    // protected static function newFactory(): LocationTableFactory
    // {
    //     // return LocationTableFactory::new();
    // }
}
