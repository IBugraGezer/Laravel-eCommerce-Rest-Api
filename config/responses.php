<?php

$messages = [
    'error' => 'An error occured.',
    'unauthorized' => 'You are not authorized for this action.',
    'not_found' => 'Not found.'
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