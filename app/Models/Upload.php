<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $table = "uploads";

    protected $fillable = ['path', 'name', 'extension', 'size', 'brand_id', 'category_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function analysisMetas()
    {
        return $this->hasMany(AnalysisMeta::class);
    }
}
