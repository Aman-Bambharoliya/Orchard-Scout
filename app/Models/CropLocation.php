<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Auth, DB; 
use Illuminate\Database\Eloquent\SoftDeletes;

class CropLocation extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $table = 'crop_locations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'address_id',
        'name',
        'description',
    ];

    protected $dates = ['deleted_at'];
    
    protected $appends=['customer_name'];
    public function getCustomerNameAttribute()
    {
        if($this->customer_id!=null)
        {
            $Customer=Customer::where('id',$this->customer_id)->first();
            if($Customer!=null)
            {
                return $Customer->name;
            }
        }
        return '';
    }
    public function hasAddress()
    {
        return $this->hasOne(Address::class,'id','address_id');
    }
    public function hasCustomerAddress()
    {
        return $this->hasOne(CustomerAddress::class,'address_id','address_id');
    }
    

}
