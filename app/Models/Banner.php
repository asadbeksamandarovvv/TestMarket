<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'description',
        'is_active',
    ];

    public function image(): MorphOne
    {
        return $this->morphOne(Attachment::class, 'attachment');
    }

}
