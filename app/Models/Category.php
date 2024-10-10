<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = ['name', 'options'];

    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }

    public function analysisMetas()
    {
        return $this->hasMany(AnalysisMeta::class);
    }
}
