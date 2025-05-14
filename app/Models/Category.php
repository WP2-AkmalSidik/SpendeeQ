<?php

namespace App\Models;

use App\Models\User;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'icon',
        'color',
    ];

    /**
     * Get the user that owns the category.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the expenses for the category.
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Scope a query to get global and user-specific categories.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where(function($query) use ($userId) {
            $query->whereNull('user_id') // Global categories
                  ->orWhere('user_id', $userId); // User-specific categories
        });
    }
}