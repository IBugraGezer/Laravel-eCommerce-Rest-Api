<?php
function generateProductSerialNumber() {
    $chars = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $serialNumber = substr(str_shuffle($chars), 0, 8);
    return $serialNumber;
}
