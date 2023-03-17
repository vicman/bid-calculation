<?php

/**
 * Constants file for Bid Calculation exercise.
 */

// Basic user fee: 10% of the price of the vehicle, minimum $10 and maximum $50.
define('BASIC_USER_FEE_PERCENTAGE', 0.10);
define('BASIC_USER_FEE_MINIMUM', 10);
define('BASIC_USER_FEE_MAXIMUM', 50);

// The seller's special fee: 2% of the vehicle price.
define('SELLER_SPECIAL_FEE_PERCENTAGE', 0.02);

// The added costs for the association based on the price of the vehicle:
// $5 for an amount between $1 and $500
// $10 for an amount greater than $500 up to $1000
// $15 for an amount greater than $1000 up to $3000
// $20 for an amount over $3000
define('ASSOCIATION_FEE_TIERS', [
    ['min' => 1, 'max' => 500, 'amount' => 5],
    ['min' => 501, 'max' => 1000, 'amount' => 10],
    ['min' => 1001, 'max' => 3000, 'amount' => 15],
    ['min' => 3001, 'max' => PHP_INT_MAX, 'amount' => 20],
]);

// A fixed storage fee of $100.
define('STORAGE_FEE', 100);
