<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends Model
{
    protected $fillable = ['class_id', 'section_name'];

    public function class(): BelongsTo
    {
        return $this->belongsTo(SclClass::class);
    }
}
