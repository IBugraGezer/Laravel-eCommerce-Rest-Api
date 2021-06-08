<?php

$messages = [
    'error' => "An error occured.",
    'unauthorized' => "You are not authorized for this action.",
    'not_found' => "Not found.",
    'already_logged_in' => "You are already logged in.",
    'bad_creds' => "Bad creds.",
    'logged_out' => "Logged out."
];

$responses = [
    'as_array' => []
];

$responses = array_merge($responses, $messages);

$errorMessagesAsArray = [];

foreach($messages as $key => $message) {
    $responses['as_array'][$key] = ["message" => $message];
}

return $responses;