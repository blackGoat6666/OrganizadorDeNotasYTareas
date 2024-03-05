<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;
    protected $table = 'tasklists';

    protected $fillable = [ 'user_id'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
