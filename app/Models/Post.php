<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

class Post extends Model
{
    use HasFactory, SoftDeletes, WorkflowTrait;

    public $table = 'posts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'full_text',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
