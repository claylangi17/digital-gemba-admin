<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lines extends Model
{
    protected $fillable = [
        "name",
        "description"
    ];

    public function issues()
    {
        return $this->hasMany(Issues::class, "line_id");
    }
}
