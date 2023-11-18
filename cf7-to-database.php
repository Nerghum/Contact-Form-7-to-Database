<?php
/*
Plugin Name: Contact Form 7 to Database
Description: Save Contact Form 7 data to a database.
Version: 1.0
Author: Nerghum
*/

// Create the table on plugin activation
function cf7_to_db_activate() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cf7_data';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,
        form_id INT,
        form_data TEXT
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'cf7_to_db_activate');

// Hook into Contact Form 7 submission
add_action('wpcf7_mail_sent', 'save_cf7_data_to_db');

function save_cf7_data_to_db($contact_form) {
    // Get form data
    $submission = WPCF7_Submission::get_instance();

    if ($submission) {
        $form_id = $contact_form->id();
        $posted_data = $submission->get_posted_data();

        // Insert data into the database
        global $wpdb;

        $table_name = $wpdb->prefix . 'cf7_data';

        $wpdb->insert(
            $table_name,
            array(
                'form_id'   => $form_id,
                'form_data' => json_encode($posted_data),
            )
        );
    }
}

// Add an admin menu to view the data
add_action('admin_menu', 'cf7_to_db_menu');

function cf7_to_db_menu() {
    add_menu_page(
        'CF7 Form Data',
        'CF7 Form Data',
        'manage_options',
        'cf7-to-db',
        'cf7_to_db_page'
    );
}

function cf7_to_db_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cf7_data';

    $data = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

    echo '<div class="wrap">';
    echo '<h2>CF7 Form Data</h2>';
    echo '<table class="widefat">';
    echo '<thead><tr><th>ID</th><th>Form ID</th><th>Form Data</th></tr></thead>';
    echo '<tbody>';

    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['form_id'] . '</td>';
        echo '<td>' . $row['form_data'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
