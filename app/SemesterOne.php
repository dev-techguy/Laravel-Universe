<?php

namespace App;

use App\Uuids\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SemesterOne extends Model {
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
        'unit_id',
        'user_id',
        'catOne',
        'catTwo',
        'mainExam',
        'average',
    ];

    /**
     * Get the unit here
     * @return BelongsTo
     */
    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Get the user here
     * @return BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
