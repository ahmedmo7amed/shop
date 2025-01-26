<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'department_id', 'start_date', 'end_date', 'status',
    ];


    public function projects()
    {
        return $this->belongsToMany(Project::class, 'employee_project')
            ->withPivot('assigned_at', 'role', 'status')
            ->withTimestamps();
    }
}
