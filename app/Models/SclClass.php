<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SclClass extends Model
{
    protected $fillable = ['shift_id', 'class_name'];

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }
}
