<?php

class Hotel extends Base
{
    protected $name = 'hotels';

    public function __construct()
    {
        parent::__construct($this->name);
    }
}