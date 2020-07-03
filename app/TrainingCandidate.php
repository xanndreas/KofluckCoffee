<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingCandidate extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'training_candidates';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'full_name',
        'whatsapp',
        'training_class_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function training_class()
    {
        return $this->belongsTo(TrainingClass::class, 'training_class_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}