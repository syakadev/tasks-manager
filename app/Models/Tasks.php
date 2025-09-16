<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
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
        'project_id'
    ];

    /*     * The attributes that should be hidden for serialization.
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

    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }

    // public function children()
    // {
    //     return $this->hasMany(ChildModel::class);
    // }

    // public function manyToManyRelationship()
    // {
    //     return $this->belongsToMany(RelatedModel::class);
    // }
}
