<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * Class OptionsHouseTransaction.
 *
 * @property int $id
 * @property int $transaction_id
 * @property string $close_date
 * @property string $close_time
 * @property string $trade_type
 * @property string $description
 * @property float $strike_price
 * @property string $option_type
 * @property string $option_side
 * @property int $option_quantity
 * @property string $symbol
 * @property float $price_per_unit
 * @property string $underlier_symbol
 * @property float $fee
 * @property float $commission
 * @property float $amount
 * @property string $security_type
 * @property string $expiration
 * @property string $security_description
 * @property string $position_state
 * @property string $deliverables
 * @property string $market_statistics
 * @property string $trade_journal_notes
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereTransactionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereCloseDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereCloseTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereTradeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereStrikePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereOptionType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereOptionSide($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereOptionQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereSymbol($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction wherePricePerUnit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereUnderlierSymbol($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereFee($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereCommission($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereSecurityType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereExpiration($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereSecurityDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction wherePositionState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereDeliverables($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereMarketStatistics($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereTradeJournalNotes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OptionsHouseTransaction whereUpdatedAt($value)
 */
	class OptionsHouseTransaction extends \Eloquent {}
}

namespace App{
/**
 * Class User
 *
 * @package App
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * Class UserBase
 *
 * @package App
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @mixin \Eloquent
 */
	class UserBase extends \Eloquent {}
}

