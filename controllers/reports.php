<?php

class Reports
{
    private static $params = array('booking_ref', 'value', 'hotel_id', 'user', 'booking_source', 'enquiry_source', 'non_booking_calls', 'non_booking_reason', 'date_from', 'date_to', 'date_created_from', 'date_created_to');

    function build()
    {
        #$sql = "SELECT name, username, booking_ref, value, enquiry_source, booking_source, non_booking_calls, non_booking_reason, date_from, date_to, date FROM reports WHERE";
        $sql = "SELECT name, username, booking_ref, value, enquiry_source, booking_source, non_booking_calls, non_booking_reason, DATE_FORMAT(date_from, '%d/%m/%Y') as date_from, DATE_FORMAT(date_to, '%d/%m/%Y') as date_to, DATE_FORMAT(date, '%d/%m/%Y') as `date` FROM reports WHERE";
        $i = 0;
        foreach (self::$params as $param)
        {
        	if (isset($_POST[$param]) and $_POST[$param] <> '')
          {
                if ($i > 0)
                {
                    /** ensure if date_to is last param not to include AND */
                    if ($param <> 'date_to')
                    {
                        $sql .= " AND";
                    }
                }
                if (strstr($param, 'user'))
                {
                    /** only supporting 25 users */
                    if ('all' == $_POST[$param])
                    {
                        $sql .= " user_id BETWEEN 1 AND 25 ";
                    }
                    else
                    {
                        $sql .= " user_id = " . $_POST[$param];
                    }
                }
                if (strstr($param, 'date'))
                {    
                    if (strstr($param, 'date_from'))
                    {
                        if (strstr($param, '/'))
                        {
                            $parts = explode("/", $_POST[$param]);
                            $date_from = "{$parts[2]}-{$parts[1]}-{$parts[0]}";
                        }
                        else
                        {
                            /** chrome */
                            $date_from = $_POST[$param];
                        }                        
                    }
                    elseif (strstr($param, 'date_to'))
                    {
                        if (strstr($param, '/'))
                        {
                            $parts = explode("/", $_POST[$param]);
                            $date_to = "{$parts[2]}-{$parts[1]}-{$parts[0]}";
                        }
                        else
                        {   /** chrome */
                            $date_to = $_POST[$param];
                        }
                        $sql .= " `date_from` BETWEEN '{$date_from}' AND '{$date_to}' AND ";
                        $sql .= " `date_to` BETWEEN '{$date_from}' AND '{$date_to}'";
                    }
                    elseif (strstr($param, 'date_created_from')) 
                    {
                            $created_at_from = dateSplitter($_POST[$param]);
                            $sql .= " `date` >= '{$created_at_from} 00:00:00'";
                    }
                    elseif (strstr($param, 'date_created_to')) 
                    {
                            $created_at_to = dateSplitter($_POST[$param]);
                            $sql .= " `date` <= '{$created_at_to} 23:59:59'";
                    }                    
                }
                else
                {
                    if (!strstr($param, 'user'))
                    {
                        $sql .= " $param = '{$_POST[$param]}'";
                    }
                }
                $i++;
            }
        }

        #$sql .= " GROUP BY id;";

	#exit($sql);
        return $sql;
    }   
}

function dateSplitter($date)
{
    if (strstr($date, '/'))
    {
        $parts = explode("/", $date);
        $date = "{$parts[2]}-{$parts[1]}-{$parts[0]}";
    }
    else
    {   /** chrome */
        $date = $date;
    }
    return $date;
}

# GET /
function reports_index()
{
    $user = new User;
    
    $user = current($user->findBy('id', $_SESSION['user_id']));
    
    if ($user->is_admin)
    {
        Main::run();    
        
        return html('main.html.php');        
    }
    else
    { 
        halt(SERVER_ERROR, "forbidden...");
    }
}

function reports_export()
{
    $sql = Reports::build();

    if (strstr($sql, 'WHERE GROUP'))
    {
        halt(400, "error: please choose at least one search criteria!");
    }

    $booking = new Booking;

    $bookings = $booking->inject($sql);

    #echo "<pre>";
    #exit(print_r($bookings));

    $csv = "Hotel,User,Booking Ref.,Value,Enquiry Src.,Booking Src.,Non Booking Calls,Non Booking Reason,Arrival Date,Departure Date,Created Date\n";

    if (count($bookings) <= 0)
    {
        halt(416, "warning: no records were returned for your chosen criteria!");
    }

    foreach ($bookings as $obj)
    {
        foreach ($obj as $m => $v)
        {
            $csv .= "{$v},";
        }
        $csv = substr($csv, 0, -1);
        $csv .= "\n";
    }

    $filename = gmdate('YmdHis') . '.csv';

    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Length: " . strlen($csv));
    header("Content-type: text/x-csv");
    header("Content-Disposition: attachment; filename=$filename");
    exit($csv);
}
