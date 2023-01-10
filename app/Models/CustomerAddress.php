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
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerAddress extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $table = 'customer_addresses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'address_id',
        'address_type_id',
    ];

    protected $dates = ['deleted_at'];
    
    protected $appends = [
        'address_type_name',
    ];

    public function hasAddress()
    {
        return $this->hasOne(Address::class,'id','address_id');
    }
    

    public function getAddressTypeNameAttribute($id)
    {
        $address_type=AddressType::where('id',$this->address_type_id)->first();
        if($address_type!=null && !empty($address_type))
        {
            return $address_type->name;
        }
        else
        {
            return '-';
        }
    }
}
