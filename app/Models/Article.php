<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // In app/Models/Article.php
protected $fillable = ['title', 'text', 'author'];

}
