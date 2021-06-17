<?php

$messages = [
    'error' => "An error occured.",
    'unauthorized' => "You are not authorized for this action.",
    'not_found' => "Not found.",
    'already_logged_in' => "You are already logged in.",
    'bad_creds' => "Bad creds.",
    'logged_out' => "Logged out.",
    'bad_request' => "Bad request.",
    'property_name_has_values' => "This property name already has property values. Please remove them before remove the property name."
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