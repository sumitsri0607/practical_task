<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessList extends Model
{
    use HasFactory;

    protected $table = 'access_list';

    protected $fillable = [
        'user_id','view','edit','add','delete',
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
