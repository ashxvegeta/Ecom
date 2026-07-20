<?php

function formatPrice($price) {
    $price = (int) $price;
    $formatted = preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))/', '$1,', $price);
    return '₹' . $formatted;
}