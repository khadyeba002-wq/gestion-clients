<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Order;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Champs autorisés à l'insertion (mass assignment)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // 🔥 IMPORTANT
    ];

    /**
     * Champs cachés (sécurité)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast des champs
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Vérifie si l'utilisateur est admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Vérifie si l'utilisateur est client
     */
    public function isClient(): bool
    {
        return $this->role === 'client';
    }



public function orders()
{
    return $this->hasMany(Order::class);
}
}
