<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'start_date',
        'end_date',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //
    ];

    // Define relationships here

    // public function parent()
    // {
    //     return $this->belongsTo(ParentModel::class);
    // }

    public function tasks()
    {
        return $this->hasMany(tasks::class);
    }

    // public function manyToManyRelationship()
    // {
    //     return $this->belongsToMany(RelatedModel::class);
    // }
}
