<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = ['section_id', 'student_name'];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
