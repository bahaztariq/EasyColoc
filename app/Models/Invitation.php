<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    /** @use HasFactory<\Database\Factories\InvitationFactory> */
    use HasFactory;

    protected $fillable = [
        'colocation_id',
        'email',
        'token',
        'status',
        'sent_at',
        'responded_at',
        'expired_at',
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function isExpired()
    {
        return $this->expired_at && $this->expired_at->isPast();
    }
    public function status(){
        return $this->status;
    }
}
