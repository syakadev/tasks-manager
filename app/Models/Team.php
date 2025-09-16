<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
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
        'manager_id',
        'user1_id',
        'user2_id',
        'user3_id'
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
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function user1()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    public function user3()
    {
        return $this->belongsTo(User::class, 'user3_id');
    }

    // public function parent()
    // {
    //     return $this->belongsTo(ParentModel::class);
    // }

    // public function children()
    // {
    //     return $this->hasMany(ChildModel::class);
    // }

    // public function manyToManyRelationship()
    // {
    //     return $this->belongsToMany(RelatedModel::class);
    // }
}
