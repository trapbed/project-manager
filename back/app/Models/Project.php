<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'title','description','user_id','started_at', 'finished_at', 'status', 'squad'];

    public function task(){
        return $this->hasMany(Task::class);
    }

    public function report(){
        return $this->hasMany(Report::class);
    }
}
