<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        // 'information_id',
        'project_id',
        'name',
        'status',
        'notes',
        'duedate',
        'work_time',
        'billing',
        'billed',
    ];
    // protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // public function information()
    // {
    //     return $this->belongsTo(InformationForm::class);
    // }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
