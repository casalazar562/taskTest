<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    const PENDING='pending';
    const IN_PROGRESS='in_progress';
    const COMPLETED='completed';

    protected $fillable = ['title','description', 'status', 'due_date'];

   

    protected $primaryKey = 'id';

    public $incrementing = true;

    
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    
    public function scopeById(Builder $query, string $value): Builder
    {
        return $query->where('id', $value);
    }
}
