<?php

# GET /
function auth_index()
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User;
    
    $user = current($user->findBy('username', $username));

    $_SESSION['error'] = null;
    
    if (is_object($user))
    {
        if (md5($password) == $user->password)
        {
            $_SESSION['authenticated'] = true;
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
        }
    }
    else
    {
        $_SESSION['error'] = 'login failed!';
    }

    redirect($base_url);
}

# GET /
function logout()
{
    $_SESSION['authenticated'] = null;
    
    redirect($base_url);
}