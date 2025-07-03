<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Auth\Database\Factories\UserAccessFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserAccess extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $primaryKey = 'rowId'; // Custom Primary Key
    protected $table = 'user_access_table'; // Custom Table Name
    public $timestamps = false;             


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'rowId',
        'userId',
        'userPassword',
        'user_language'
    ];

    // protected static function newFactory(): UserAccessFactory
    // {
    //     // return UserAccessFactory::new();
    // }

    public function getAuthPassword()
    {
        return $this->userPassword;
    }

    public function username()
    {
        return 'userId';
    }
}
