<?php

error_reporting(0);

require_once dirname(__FILE__) . '/lib/limonade.php';

function configure()
{
    $_SESSION['authenticated'] = false;

    $env = $_SERVER['HTTP_HOST'] == 'library.dev' ? ENV_DEVELOPMENT : ENV_PRODUCTION;

    $link = mysql_connect('localhost', 'nest', 'yourpasswordgoeshere');

    if (!$link) 
    {
        die('Could not connect: ' . mysql_error());
    }

    $db = mysql_select_db('nest');

    option('env', $env);
    option('db_conn', $db);
    option('debug', true);   
}

function after($output) 
{
    $time = number_format((float)substr(microtime(), 0, 10) - LIM_START_MICROTIME, 6);
    $output .= "<!-- page rendered in $time sec., on " . date(DATE_RFC822)."-->";

    return $output;
}

layout('layout/default.html.php');

// main controller
dispatch('/', 'main_page');

// users controller
dispatch_get   ('users',          'users_index');
dispatch_post  ('users',          'users_create');
dispatch_get   ('users/new',      'users_new');
dispatch_get   ('users/:id/edit', 'users_edit');
dispatch_get   ('users/:id',      'users_show');
dispatch_put   ('users/:id',      'users_update');
dispatch_delete('users/:id',      'users_destroy');

// hotels controller
dispatch_get   ('/hotels',            'hotels_index');
dispatch_post  ('/hotels/save',       'hotels_create');
dispatch_get   ('/hotels/:id/delete', 'hotels_destroy');
dispatch_get   ('/hotels/new',        'hotels_new');
dispatch_get   ('/hotels/:id/edit',   'hotels_edit');
dispatch_get   ('/hotels/:id',        'hotels_show');
dispatch_put   ('/hotels/:id',        'hotels_update');

dispatch_post ('auth/authenticate', 'auth_index');
dispatch_get  ('auth/logout', 'logout');

// bookings controller
dispatch_post ('bookings/save', 'bookings_create');

dispatch_get  ('reports', 'reports_index');
dispatch_post ('reports/export', 'reports_export');

mysql_close($link);

run();
