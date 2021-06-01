<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Punchin extends Model
{
    use HasFactory;

    protected $fillable = [
        'employe_id', 'punchin_datetime', 'punchout_datetime'
    ];

 	public function employee()
    {
    	return $this->belongsTo(Employee::class);
    }
}
