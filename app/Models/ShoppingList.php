<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    use HasFactory;
    protected $table = 'shoppinglists';

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
