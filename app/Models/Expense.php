<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'colocation_id',
        'payerid',
        'category_id',
        'amount',
        'expense_date',
    ];
    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'payerid');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
