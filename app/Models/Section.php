<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name', 
        'parent_id', 
        'section', 
        'category_image', 
        'category_discount', 
        'category_url', 
        'description', 
        'meta_description', 
        'meta_title', 
        'meta_keywords', 
        'status', 
        'updated_at', 
        'created_at'
    ];
}
