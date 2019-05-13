<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'users';

    const STATUS_VERIFY_WAIT = 'Ожидает';
    const STATUS_VERIFY_ACTIVE = 'Активен';

    const USER_ROLE_USER = 'user';
    const USER_ROLE_ADMIN = 'admin';
    const USER_ROLE_MODERATOR = 'moderator';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'email_verified_at', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @return bool
     */
    public function isVerified()
    {
        return $this->hasVerifiedEmail();
    }

    /**
     * return status Wait or Active
     *
     * @return string
     */
    public function getStatusVerify()
    {
        if ($this->isVerified()) {
            return self::STATUS_VERIFY_ACTIVE;
        }

        return self::STATUS_VERIFY_WAIT;
    }

    public function isWait(): bool
    {
       return $this->status === self::STATUS_VERIFY_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_VERIFY_ACTIVE;
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_VERIFY_ACTIVE => self::STATUS_VERIFY_ACTIVE,
            self::STATUS_VERIFY_WAIT => self::STATUS_VERIFY_WAIT
        ];
    }

    public static function getRoles()
    {
        return [
            self::USER_ROLE_USER => self::USER_ROLE_USER,
            self::USER_ROLE_ADMIN => self::USER_ROLE_ADMIN,
            self::USER_ROLE_MODERATOR => self::USER_ROLE_MODERATOR,
        ];
    }

    public function isAdmin()
    {
        return $this->role === self::USER_ROLE_ADMIN ? true : false ;
    }

    public function isUser()
    {
        return $this->role === self::USER_ROLE_USER ? true : false ;
    }

    public function isModerator()
    {
        return $this->role === self::USER_ROLE_MODERATOR ? true : false ;
    }

    public function newUser(string $name, string $email, string $password, string $role = self::USER_ROLE_USER, string $status = self::STATUS_VERIFY_WAIT)
    {
        $user = new User;

        $user->name = $name;
        $user->email = $email;
        $user->email_verified_at = now();
        $user->password = Hash::make($password);
        $user->role = $role;
        $user->status = $status;

        $user->save();

    }

}
