<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;
	 protected $fillable = [
        'title',
        'publication_year',
		'cover',
    ];
	public function authors():BelongsToMany
	{        				
		return $this->belongsToMany('App\Models\Author');
   	}

}
