<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'start_date', 'end_date', 'status', 'type_id'];

    public const AVAILABLE_STATUSES =
    [
        [
            'value' => 'ongoing',
            'text' => 'Ongoing'
        ],
        [
            'value' => 'ongoing',
            'text' => 'Ongoing'
        ],
        [
            'value' => 'ongoing',
            'text' => 'Ongoing'
        ]
    ];



    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
