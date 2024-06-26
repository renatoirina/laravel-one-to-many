<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'slug', 'type_id'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
