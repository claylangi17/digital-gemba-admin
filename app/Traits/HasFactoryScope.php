<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait HasFactoryScope
{
    protected static function bootHasFactoryScope()
    {
        static::addGlobalScope('factory', function (Builder $builder) {
            if (Auth::check()) {
                if (Auth::user()->factory_id) {
                    $builder->where('factory_id', Auth::user()->factory_id);
                } elseif (session('viewing_factory_id')) {
                    // If user has no factory_id (Super Admin) but has selected one in session
                    $builder->where('factory_id', session('viewing_factory_id'));
                }
            }
        });

        static::creating(function ($model) {
            if (Auth::check()) {
                if (Auth::user()->factory_id) {
                    $model->factory_id = Auth::user()->factory_id;
                } elseif (session('viewing_factory_id')) {
                    $model->factory_id = session('viewing_factory_id');
                }
            }
        });
    }
}
