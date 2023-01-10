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


class CustomerPeople extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $table = 'customer_peoples';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'people_id',
        'people_role_id',
    ];
    
    protected $dates = ['deleted_at'];

    public function hasPeople()
    {
        return $this->hasOne(People::class,'id','people_id');
    }
    public function hasCustomer()
    {
        return $this->hasOne(Customer::class,'id','customer_id');
    }
    public function hasPeopleRole()
    {
        return $this->hasOne(PeopleRole::class,'id','people_role_id');
    }
}
