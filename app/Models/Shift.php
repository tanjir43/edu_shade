<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shift extends Model
{
    protected $fillable = ['version_id', 'shift_name'];

    public function version(): BelongsTo
    {
        return $this->belongsTo(Version::class);
    }
}


