<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasFactoryScope;

class Lines extends Model
{
    use HasFactoryScope;
    protected $fillable = [
        "name",
        "description",
        "factory_id"
    ];

    public function issues()
    {
        return $this->hasMany(Issues::class, "line_id");
    }

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }
}
