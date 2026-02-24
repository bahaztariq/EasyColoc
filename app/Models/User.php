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
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Colocations owned by this user.
     */
    public function ownedColocations()
    {
        return $this->hasMany(Colocation::class, 'owner_id');
    }

    /**
     * Colocations this user is a member of (via memberships pivot).
     */
    public function colocations()
    {
        return $this->belongsToMany(Colocation::class, 'memberships')
                    ->withPivot('role', 'joined_at', 'left_at')
                    ->withTimestamps();
    }

    /**
     * Membership records for this user.
     */
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    /**
     * Expenses paid by this user.
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'payerid');
    }

    /**
     * Payments made by this user.
     */
    public function paidPayments()
    {
        return $this->hasMany(Payment::class, 'payer_id');
    }

    /**
     * Payments received by this user.
     */
    public function receivedPayments()
    {
        return $this->hasMany(Payment::class, 'payee_id');
    }
}
