<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    protected $fillable = [
        'day_id',
        'time_slot_id',
        'subject_id',
    ];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class);
    }

     public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
