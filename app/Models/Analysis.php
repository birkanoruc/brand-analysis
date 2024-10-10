<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    use HasFactory;

    protected $table = "analysis";

    protected $fillable = ['name', 'brand_id', 'analysisDate'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function analysisMetas()
    {
        return $this->hasMany(AnalysisMeta::class);
    }
}
