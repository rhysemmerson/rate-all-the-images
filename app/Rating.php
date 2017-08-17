<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function image() {
        return $this->belongsTo(Image::class);
    }
}
