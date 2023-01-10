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

class People extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $table = 'peoples';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prefix',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'nickname',
        'maiden_name',
        'date_of_birth',
    ];

    protected $dates = ['deleted_at'];

    protected $appends=['full_name'];

    public function getFullNameAttribute()
    {
        $prefix='';
        $suffix='';
        $first_name=$this->first_name;
        $middle_name=$this->middle_name;
        $last_name=$this->last_name;
        if($this->prefix!='' && $this->prefix!=null)
        {
            $prefix=$this->prefix;
        }
        if($this->suffix!='' && $this->suffix!=null)
        {
            $suffix=$this->suffix;
        }
        return $prefix.' '.$first_name.' '.$middle_name.' '.$last_name.' '.$suffix;
    }
    public function setDateOfBirthAttribute($value)
    {
        
        $date = $value;
        $d =date('Y-m-d', strtotime($date));
        $this->attributes['date_of_birth']=$d;
    }
    public function getDateOfBirthAttribute($value)
    {
        if($value!='' && $value!=null)
        {
            $date = $value;
            $d =date('d-m-Y', strtotime($date));
            return $d;
        }
        return $value;
    }

    public function hasManyPeopleAddress()
    {
        return $this->hasMany(PeopleAddress::class);
    }

}
