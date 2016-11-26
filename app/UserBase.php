<?php
/**
 * Created by PhpStorm.
 * User: richjones
 * Date: 9/11/16
 * Time: 12:46 PM
 */

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class UserBase
 *
 * @package App
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @mixin \Eloquent
 */
class UserBase extends Authenticatable
{
    use Notifiable;

}