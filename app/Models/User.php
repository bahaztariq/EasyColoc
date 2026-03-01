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
        'colocation_id',
        'is_admin',
        'status',
        'banned_at',
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
     * The colocations this user belongs to.
     */
    public function colocations()
    {
        return $this->belongsToMany(Colocation::class, 'memberships')->withPivot('role')->withTimestamps();
    }

    /**
     * Helper to get the first colocation (preserving existing logic for single dashboard)
     */
    public function getColocationAttribute()
    {
        return $this->colocations()->wherePivotNull('left_at')->first();
    }

    public function getColocationIdAttribute()
    {
        return $this->colocation?->id;
    }

    public function isCurrentMember(){
        return $this->colocations()->wherePivotNull('left_at')->exists();
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


    public function isCreditor() : bool
    {
        return $this->receivedPayments()->where('status', 'pending')->sum('amount') > $this->paidPayments()->where('status', 'pending')->sum('amount');
    }

    public function isDebtor() : bool
    {
        return $this->paidPayments()->where('status', 'pending')->sum('amount') > $this->receivedPayments()->where('status', 'pending')->sum('amount');
    }
}
