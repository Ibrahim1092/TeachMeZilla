<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Stage extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name' , 'Note'];
    protected $fillable = ['Name' , 'Note'];
    

}
