<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'assigned_to_id',
        'created_by_id',
    ];

    public CONST STATUS = [
        'pending'               => 'Pending',
        'in_progress'           => 'In Progress',
        'done'                  => 'Done',
    ];

    public function assigned_to() : BelongsTo
    {
        return $this->belongsTo(Employee::class,'assigned_to_id','id');
    }

    public function created_by() : BelongsTo
    {
        return $this->belongsTo(User::class,'created_by_id','id');
    }
}
