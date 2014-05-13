<?php

# GET /
function bookings_create()
{
    $obj = new stdClass;

    $date_from = $_POST['date_from'];
    $date_to = $_POST['date_to'];

    if ('' == $_POST['date_from'] or '' == $_POST['date_to'])
    {
        $date_from = '0000-00-00';
        $date_to = '0000-00-00';
    }

    $obj->user_id = $_SESSION['user_id'];
    $obj->hotel_id = $_POST['hotel_id'];
    $obj->enquiry_source = $_POST['enquiry_source'];
    $obj->booking_source = $_POST['booking_source'];
    $obj->booking_ref = $_POST['booking_ref'];
    $obj->non_booking_calls = $_POST['non_booking_calls'];
    $obj->non_booking_reason = $_POST['non_booking_reason'];
    $obj->currency = $_POST['currency'];
    $obj->value = $_POST['value'];
    $obj->date_from = $date_from;
    $obj->date_to = $date_to;
    $obj->date = gmdate('Y-m-d H:i:s');

    $booking = new Booking;
    $booking->create($obj);

    redirect('/');
}

function validate($fields) 
{
    foreach ($fields as $field) 
    {
        if (strlen($field) < 1)
        {
            if ('value' == $field)
            {
                exit($field);
            }
            
            return false;
        }
    }

    return true;
}