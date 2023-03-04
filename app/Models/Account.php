<?php

namespace App\Models;

use App\Enums\genre;
use App\Enums\notifications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'person',
        'genre',
        'avatar',
        'apartament_id',
        'user_id',
        'notifications',
        'birthday',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'notifications' => notifications::class,
        'genre' => genre::class
    ];

    public function user(): HasOne
    {
        return $this->hasOne(user::class, 'id', 'user_id');
    }
}
