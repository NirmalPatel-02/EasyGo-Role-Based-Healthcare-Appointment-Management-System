<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'password', 'role', 'avatar', 'city', 'locality', 'dob', 'gender', 'speciality', 'experience', 'address', 'country', 'state', 'zipcode', 'language', 'education', 'bio', 'certification_name', 'certified_by', 'completion_date', 'price','longitude','latitude','status','commission_rate'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
  // Clients can have many appointments as a client
  public function clientAppointments()
  {
      return $this->hasMany(Appointment::class, 'client_id');
  }

  // Doctors can have many appointments as a doctor
  public function doctorAppointments()
  {
      return $this->hasMany(Appointment::class, 'doctor_id');
  }
  public function doctorWithdrawals()
  {
      return $this->hasMany(Withdrawal::class, 'doctor_id');
  } public function doctorWallets()
  {
      return $this->hasMany(Wallet::class, 'doctor_id');
  }

  public function slots()
  {
      return $this->hasMany(Slot::class,'doctor_id');
  }
  public function scopeNearby(Builder $query, $lat, $lng, $radius = 50)
  {
      return $query->selectRaw("*, (
          6371 * acos(
              cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) +
              sin(radians(?)) * sin(radians(latitude))
          )
      ) AS distance", [$lat, $lng, $lat])
      ->having('distance', '<', $radius) // Distance must be less than the specified radius (in kilometers)
      ->orderBy('distance');
  }
  /**
     * Define the relationship with conditions.
     */
    public function conditions()
    {
        return $this->hasMany(Condition::class, 'doctor_id');
    }

    /**
     * Define the relationship with experiences.
     */
    public function experiences()
    {
        return $this->hasMany(Experience::class, 'doctor_id');
    }

    /**
     * Define the relationship with languages.
     */
    public function languages()
    {
        return $this->hasMany(Language::class, 'doctor_id');
    }

    /**
     * Define the relationship with galleries.
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'doctor_id');
    }

     /**
     * Define the relationship with certificates.
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'doctor_id');
    }



    public function clientReviews()
    {
        return $this->hasMany(Review::class, 'client_id');
    }
  
    // Doctors can have many Reviews as a doctor
    public function doctorReviews()
    {
        return $this->hasMany(Review::class, 'doctor_id');
    }
}