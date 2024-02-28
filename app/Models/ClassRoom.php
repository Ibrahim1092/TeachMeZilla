<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ClassRoom extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'stage_id'];
    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }
}
