<?php

# GET /users
function users_index() {
    set('users', find());
    return html('users/index.html.php');
}

# GET /users/:id
function users_show() {
    $user = get_user_or_404();
    set('user', $user);
    return html('users/show.html.php');
}

# GET /users/:id/edit
function users_edit() {
    $user = get_user_or_404();
    set('user', $user);
    set('authors', find_authors());
    return html('users/edit.html.php');
}

# PUT /users/:id
function users_update() {
    $user_data = user_data_from_form();
    $user = get_user_or_404();
    $user = make_user_obj($user_data, $user);

    update_user_obj($user);
    redirect('users');
}

# GET /users/new
function users_new() {
    $user_data = user_data_from_form();
    set('user', make_user_obj($user_data));
    set('authors', find_authors());
    return html('users/new.html.php');
}

# POST /users
function users_create() {
    $user_data = user_data_from_form();
    $user = make_user_obj($user_data);

    create_user_obj($user);
    redirect('users');
}

# DELETE /users/:id
function users_destroy() {
    delete_user_by_id(filter_var(params('id'), FILTER_VALIDATE_INT));
    redirect('users');
}

function get_user_or_404() {
    $user = find_user_by_id(filter_var(params('id'), FILTER_VALIDATE_INT));
    if (is_null($user)) {
        halt(NOT_FOUND, "This user doesn't exist.");
    }
    return $user;
}

function user_data_from_form() {
    return isset($_POST['user']) && is_array($_POST['user']) ? $_POST['user'] : array();
}
