<?php

namespace App;

use App\Uuids\Uuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use MV\Notification\Models\Notification;

class User extends Authenticatable {
    use Notifiable, Uuids;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'county_id',
        'name',
        'email',
        'phoneNumber',
        'registrationNumber',
        'gender',
        'program_verified',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'program_verified' => 'boolean',
    ];

    /**
     * get user notification
     * @return HasMany
     */
    public function notification() {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get the semesterOne here
     * @return HasMany
     */
    public function semester_one() {
        return $this->hasMany(SemesterOne::class);
    }

    /**
     * Get the semesterTwo here
     * @return HasMany
     */
    public function semester_two() {
        return $this->hasMany(SemesterTwo::class);
    }

    /**
     * Get User County Here
     * @return BelongsTo
     */
    public function county() {
        return $this->belongsTo(County::class);
    }
}
