<?php
// ruet-db.php - Updated for new fields
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

global $wpdb;

$table_name = $wpdb->prefix . "ruet_registrations";
$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id INT(11) NOT NULL AUTO_INCREMENT,
    department VARCHAR(255),
    roll VARCHAR(100),
    reg_no VARCHAR(255),
    name VARCHAR(255),
    session_sem VARCHAR(255),
    prev_credit VARCHAR(50),
    adviser_comment TEXT,
    course_data LONGTEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) $charset_collate;";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql);

// Check if table exists and columns are correct
$columns = $wpdb->get_results("SHOW COLUMNS FROM $table_name");
$columns_exist = array_column($columns, 'Field');

// Add missing columns if needed
if (!in_array('prev_credit', $columns_exist)) {
    $wpdb->query("ALTER TABLE $table_name ADD prev_credit VARCHAR(50) AFTER session_sem");
}

if (!in_array('adviser_comment', $columns_exist)) {
    $wpdb->query("ALTER TABLE $table_name ADD adviser_comment TEXT AFTER prev_credit");
}
?>