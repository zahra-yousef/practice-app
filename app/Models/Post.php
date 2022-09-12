<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = ['user-id','title','description','image','status',];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
