<?php

class User extends Base
{
    protected $name = 'users';

    public function __construct()
    {
        parent::__construct($this->name);
    }
}