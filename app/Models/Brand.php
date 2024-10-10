<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = ['name', 'logoUrl'];

    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }

    public function analyses()
    {
        return $this->hasMany(Analysis::class);
    }
}
