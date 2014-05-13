<?php

class Main
{
    public static function run()
    {        
        $user = new User;
     
        /** CHANGE TO USER ID FROM SESSION */
        if (isset($_SESSION['authenticated']))
        {
            $users = $user->find();
            set('users', $users);        

            $user = current($user->findBy('id', $_SESSION['user_id']));   
            set('user', $user);

            $source = new Source;
            $sources = $source->find();
            set('sources', $sources);

            $non_booking_types = array();
            $non_booking_types[] = 'Additional Info on Existing Booking';
            $non_booking_types[] = 'Re-confirming Existing Booking';
            $non_booking_types[] = 'Amend Existing Booking';
            $non_booking_types[] = 'Provisional/Enquiry now Confirming';
            $non_booking_types[] = 'Call Transfer to Hotel';
            $non_booking_types[] = 'Internal Call';
            set('non_booking_types', $non_booking_types);

            $non_booking_reasons = array();
            $non_booking_reasons[] = 'Hotel Full';
            $non_booking_reasons[] = 'Partial Availability';
            $non_booking_reasons[] = 'Price';
            $non_booking_reasons[] = 'Provisional';
            $non_booking_reasons[] = 'Hotel Closed';
            $non_booking_reasons[] = 'Checking Rates in General';
            $non_booking_reasons[] = 'Checking Dates in General';
            $non_booking_reasons[] = 'Promotion Full';

            set('non_booking_reasons', $non_booking_reasons);

            $hotel = new Hotel;
            $hotels = $hotel->find();
            set('hotels', $hotels);
        }
    }
}

# GET /
function main_page()
{
    Main::run();

    return html('main.html.php');
}
