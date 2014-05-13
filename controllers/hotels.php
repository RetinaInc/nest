<?php

function hotels_index()
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

# GET /
function hotels_create()
{
    $obj = new stdClass;

    $obj->name = $_POST['name'];

    $hotel = new Hotel;
    
    if (strlen($obj->name) > 1)
    {
        $hotel->create($obj);
    }

    redirect_to("/hotels");
}

function hotels_destroy()
{
    $hotel = new Hotel;
    
    $hotel->delete(params('id'));

    redirect_to("{$base_url}hotels");
}