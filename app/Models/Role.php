<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'roles';

    protected $fillable = [
        'id',
        'name',
    ];

    public function RoleAbilities():HasMany
    {
        return $this->hasMany(RoleAbility::class);
    }
    // public function roleAbilities():BelongsToMany
    // {

    //     return $this->belongsToMany(RoleAbility::class);
    // }
    public function  users():HasMany
    {
        return $this->hasMany(User::class);
    }
    public function abilities():BelongsToMany
    {
        return $this->belongsToMany(Ability::class, 'role_abilities');
    }
}
