<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $table = 'todos';
    protected $fillable = [
        'name',
        'description',
        'file',
        'completed',
        'user_id',
        'file_extension',
        'remember_at',
        'cost',
    ];

    protected $append = ['cost_formated', 'remember_at_formated'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // accessors and mutators
    protected function rememberAtFormated(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => dateFormat($attributes['remember_at']),
        );
    }

    protected function costFormated(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => numberFormat($attributes['cost'] / 100),
        );
    }
}
