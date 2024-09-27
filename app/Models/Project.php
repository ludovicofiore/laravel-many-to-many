<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function technology(){
        return $this->belongsToMany(Technology::class);
    }

    protected $fillable = [
        'title',
        'type_id',
        'description',
        'publication_date',
        'slug',
        'cover_img',
        'original_img_name'
    ];

    protected $casts = [
        'publication_date' => 'datetime:d/m/Y'
    ];
}
