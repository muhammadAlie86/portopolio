<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'technologies',
        'created_by',
        'image',
    ];

    /**
     * Mendapatkan user yang membuat project ini.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}