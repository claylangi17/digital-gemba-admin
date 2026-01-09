<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasFactoryScope;

class GenbaSessions extends Model
{
    use HasFactoryScope;
    protected $fillable = [
        'name',
        'whiteboard_id',
        'status',
        'created_by',
        'factory_id',
        'start_time'
    ];

    protected $casts = [
        'start_time' => 'datetime'
    ];

    public function issues()
    {
        return $this->hasMany(Issues::class, "session_id");
    }

    public function reports()
    {
        return $this->hasMany(GenbaReports::class, "session_id");
    }

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }
}
