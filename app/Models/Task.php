<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    //define quais campos vao ser preenchidos
    protected $fillable = [
        'title',
        'description',
        'status',
        'position'
    ];

    //uma task pertence a um usuario, inverso de um relacionamento hasMany
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
