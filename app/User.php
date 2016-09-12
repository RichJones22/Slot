<?php

namespace App;

class User extends UserBase
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }
}
