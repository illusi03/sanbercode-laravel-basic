<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
  protected $guarded = [
    "id", "created_at", "updated_at",
  ];
  function user() {
    return $this->belongsTo(User::class);
  }
  function comments() {
    return $this->hasMany(Comment::class);
  }
  function likes() {
    return $this->hasMany(PostLike::class);
  }
}
