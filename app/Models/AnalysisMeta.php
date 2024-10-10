<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalysisMeta extends Model
{
    use HasFactory;

    protected $table = "analysis_metas";

    protected $fillable = ['analysis_id', 'category_id', 'upload_id'];

    public function analysis()
    {
        return $this->belongsTo(Analysis::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
