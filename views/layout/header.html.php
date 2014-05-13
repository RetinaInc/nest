<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>

<?php

$base_url = "http://" . $_SERVER['SERVER_NAME'] . ":8080/nest/"; 

$uri_parts = explode("?", $_SERVER['REQUEST_URI']); 

$controller = end($uri_parts);

$title = "Nest";

$action = "?bookings/save";
$button = "Save";
$required = ' required';
$tab_title = "Booking Capture";
$frm_title = "Enter Booking Details";

if ('reports' == $controller)
{
    $action = "?reports/export";
    $button = "Export";
    $required = null;
    $tab_title = "Booking Export";
    $frm_title = "Choose Parameter(s)";
}
elseif ('hotels' == $controller)
{
    $tab_title = "Hotels";
    $frm_title = "Hotel Listing";
}

?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo($title); ?></title>
  <link rel="icon" href="favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="./media/stylesheets/base.css" type="text/css" media="screen" />
  <link rel="stylesheet" id="current-theme" href="./media/stylesheets/style.css" type="text/css" media="screen" />  
  <script type="text/javascript" charset="utf-8" src="./media/javascripts/jquery-1.3.min.js"></script>
  <script type="text/javascript" src="./media/javascripts/jquery.validate.js"></script>
  <script type="text/javascript" charset="utf-8" src="./media/javascripts/jquery.scrollTo.js"></script>
  <script type="text/javascript" charset="utf-8" src="./media/javascripts/jquery.localscroll.js"></script>
    
  <script type="text/javascript" charset="utf-8">
    // <![CDATA[
    $(document).ready(function() {
      $('#frmBooking').validate({
      <?php if ('reports' != $controller): ?>
          rules: {
              date_from: {
                  required: {
                      depends: function(element) {
                          return ($('#booking_ref').val());
                      }
                  }
              },
              date_to: {
                  required: {
                      depends: function(element) {
                          return ($('#booking_ref').val());
                      }
                  }
              },
              enquiry_source: {
                  required: {
                      depends: function(element) {
                          return !($('#non_booking_calls').val());
                      }
                  }
              },
              booking_source: {
                  required: {
                      depends: function(element) {
                          return !($('#non_booking_calls').val());
                      }
                  }
              },
          }
      });
      <?php endif; ?>
    });          
    // ]]>
  </script>
</head>
<body>
  <div id="container">

    <div id="header">
      <?php if (isset($_SESSION['authenticated']) and true == $_SESSION['authenticated']): ?>
      <div id="user-navigation">
        <ul class="wat-cf">
          <li><a href="<?php echo($base_url); ?>">Home</a></li>
          <?php if ($user->is_admin): ?>
              <li><a href="<?php echo($base_url); ?>?hotels">Hotels</a></li>
          <?php endif; ?>
          <?php if ($user->is_admin): ?>
              <li><a href="<?php echo($base_url); ?>?reports">Reports</a></li>
          <?php endif; ?>
          <li><a class="logout" href="<?php echo($base_url); ?>?auth/logout">Logout</a></li>
        </ul>
      </div>
      <div id="main-navigation">
        <ul class="wat-cf">
        </ul>
      </div>
      <?php endif; ?>
    </div>
    <div id="wrapper" class="wat-cf">
      <div id="main">
