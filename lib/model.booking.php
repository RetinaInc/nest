<?php

class Booking extends Base
{
    protected $name = 'bookings';

    public function __construct()
    {
        parent::__construct($this->name);
    }
}