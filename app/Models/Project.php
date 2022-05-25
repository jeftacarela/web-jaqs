<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'projectname',
        // 'project_type',
        // 'website_url',
        // 'staging_url',
        // 'status',
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

    public function video()
    {
        return $this->hasMany(Video::class);
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    // public function option()
    // {
    //     return $this->hasMany(Option::class);
    // }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
