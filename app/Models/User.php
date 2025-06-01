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

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'company_name',
        'address',
        'city',
        'country',
        'postcode',
        'mobile',
        'password',
        'default_shipping_address',
    ];

    protected $casts = [
        'default_shipping_address' => 'boolean',
    ];
}
