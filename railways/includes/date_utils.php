<?php
/**
 * Date utility functions for Railway Maintenance system
 * Uses Indian timezone (Asia/Kolkata)
 */

// Set timezone to India
date_default_timezone_set('Asia/Kolkata');

/**
 * Format a date in Indian format (DD-MM-YYYY)
 * 
 * @param string $date_string Date string in any format that strtotime can parse
 * @return string Formatted date
 */
function format_indian_date($date_string) {
    $timestamp = strtotime($date_string);
    return date('d-m-Y', $timestamp);
}

/**
 * Format a date and time in Indian format with 12-hour clock (DD-MM-YYYY hh:mm AM/PM)
 * 
 * @param string $date_string Date string in any format that strtotime can parse
 * @return string Formatted date and time
 */
function format_indian_datetime($date_string) {
    $timestamp = strtotime($date_string);
    return date('d-m-Y h:i A', $timestamp);
}

/**
 * Get current date in Y-m-d format
 * 
 * @return string Current date
 */
function get_current_date() {
    return date('Y-m-d');
}

/**
 * Get current date and time in Y-m-d H:i:s format
 * 
 * @return string Current date and time
 */
function get_current_datetime() {
    return date('Y-m-d H:i:s');
}

/**
 * Calculate date difference in days
 * 
 * @param string $date1 First date
 * @param string $date2 Second date
 * @return int Number of days between dates
 */
function date_diff_days($date1, $date2) {
    $timestamp1 = strtotime($date1);
    $timestamp2 = strtotime($date2);
    $diff = abs($timestamp2 - $timestamp1);
    return floor($diff / (60 * 60 * 24));
}

/**
 * Check if a date is in the past
 * 
 * @param string $date Date to check
 * @return bool True if date is in the past
 */
function is_past_date($date) {
    $date_timestamp = strtotime($date);
    $current_timestamp = time();
    return $date_timestamp < $current_timestamp;
}

/**
 * Add days to a date
 * 
 * @param string $date Starting date
 * @param int $days Number of days to add
 * @return string New date
 */
function add_days_to_date($date, $days) {
    $timestamp = strtotime($date);
    $new_timestamp = $timestamp + ($days * 24 * 60 * 60);
    return date('Y-m-d', $new_timestamp);
}
?> 