<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function getUser($login_id)
    {
        return self::where('login_id', $login_id)->first();
    }

    public static function makeUser(array $params)
    {
        $login_id = $params['login_id'];
        $password = $params['password'] ?? null;
        $role = $params['role'] ?? 0;

        return self::create([
            'login_id' => $login_id,
            'password' => $password,
            'role' => $role,
        ]);
    }

    public function ticketLog()
    {
        return $this->hasMany(TicketLog::class, 'user_id', 'id');
    }
}
