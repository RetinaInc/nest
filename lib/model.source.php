<?php

class Source extends Base
{
    protected $name = 'sources';

    public function __construct()
    {
        parent::__construct($this->name);
    }
}