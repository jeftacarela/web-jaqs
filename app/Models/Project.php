<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'projectname',
        'status',
        'duedate',
    ];

    // protected $guarded=['id'];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    // public function information()
    // {
    //     return $this->belongsTo(InformationForm::class);
    // }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'id', 'project_id');
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'id', 'project_id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
