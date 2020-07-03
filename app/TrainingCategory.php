<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingCategory extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'training_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'outlet_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function trainingCategoryTrainingClasses()
    {
        return $this->hasMany(TrainingClass::class, 'training_category_id', 'id');
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
}