<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Version extends Model
{
    protected $fillable = ['school_id', 'branch_id' ,'version_name'];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
