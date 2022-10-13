<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Auth, DB; 
use Carbon\Carbon;
class VendorPeople extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'vendor_peoples';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vendor_id',
        'people_id',
        'people_role_id',
    ];

    public function hasPeople()
    {
        return $this->hasOne(People::class,'id','people_id');
    }
    public function hasVendor()
    {
        return $this->hasOne(Vendor::class,'id','vendor_id');
    }
    public function hasPeopleRole()
    {
        return $this->hasOne(PeopleRole::class,'id','people_role_id');
    }
}
