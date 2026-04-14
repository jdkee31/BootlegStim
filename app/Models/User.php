<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'wallet_balance',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ---- Library: games the user owns ----
    public function games()
    {
        return $this->belongsToMany(Game::class, 'user_games')
                    ->withPivot(['hours_played', 'is_installed', 'last_played', 'purchased_at'])
                    ->withTimestamps();
    }

    // ---- Orders placed by the user ----
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    // ---- Cart items (if you use a CartItem model) ----
    public function cartItems()
    {
        return $this->hasMany(\App\Models\CartItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Also add this to the $fillable array in User:
    |--------------------------------------------------------------------------
    | 'wallet_balance',
    */
}
