<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $fio
 * @property string $login
 * @property string $role
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $deleted_at
 * @property string $email
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @method static Builder|\App\User whereCreatedAt($value)
 * @method static Builder|\App\User whereDeletedAt($value)
 * @method static Builder|\App\User whereEmail($value)
 * @method static Builder|\App\User whereFirstName($value)
 * @method static Builder|\App\User whereId($value)
 * @method static Builder|\App\User whereLastName($value)
 * @method static Builder|\App\User whereLogin($value)
 * @method static Builder|\App\User whereMiddleName($value)
 * @method static Builder|\App\User wherePassword($value)
 * @method static Builder|\App\User whereRememberToken($value)
 * @method static Builder|\App\User whereRole($value)
 * @method static Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'fio',
        'password',
        'role',
        'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
