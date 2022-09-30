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
class PeoplePhone extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'people_phones';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'people_id',
        'phone_id',
        'phone_type_id',
    ];
    protected $appends = [
        'phone_type_name',
    ];

    public function hasPhone()
    {
        return $this->hasOne(Phone::class,'id','phone_id');
    }
    

    public function getPhoneTypeNameAttribute($id)
    {
        $phone_type=PhoneType::where('id',$this->phone_type_id)->first();
        if($phone_type!=null && !empty($phone_type))
        {
            return $phone_type->name;
        }
        else
        {
            return '-';
        }
    }
}
