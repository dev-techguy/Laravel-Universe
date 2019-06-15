<?php

namespace App;

use App\Uuids\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model {
    use Uuids;

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
        'program_id',
        'unit',
        'semesterOne',
        'semesterTwo',
    ];

    /**
     * Get the program here
     * @return BelongsTo
     */
    public function program() {
        return $this->belongsTo(Program::class);
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
}
