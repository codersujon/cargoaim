<?php

namespace Modules\Customsfiling\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Customsfiling\Database\Factories\FilingUnsupportedFactsFactory;

class FilingUnsupportedFacts extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'filing_unsupported_facts';
    protected $primaryKey = 'row_id';
    protected $fillable = [
        'filing_type',
        'type',
        'value',
        'suggested_value',
        'status',
    ];

    // protected static function newFactory(): FilingUnsupportedFactsFactory
    // {
    //     // return FilingUnsupportedFactsFactory::new();
    // }
}
