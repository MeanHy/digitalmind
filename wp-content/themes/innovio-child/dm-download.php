<?php
/**
 * Secure Download Handler - Token-based One-Time Download
 * 
 * Creates signed URLs that expire after 5 minutes and can only be used once.
 * Redirects to Google Drive after verification.
 * 
 * Usage: /wp-content/themes/innovio-child/dm-download.php?token=xxx
 */

// Load WordPress
require_once dirname(__FILE__) . '/../../../wp-load.php';

// Get and validate token
$token = sanitize_text_field($_GET['token'] ?? '');

if (empty($token)) {
    wp_die(__('Invalid download request', 'innovio_child'), __('Error', 'innovio_child'), ['response' => 400]);
}

// Look up token in transients
$token_data = get_transient('dm_download_token_' . $token);

if (!$token_data) {
    wp_die(__('Download link has expired or already been used. Please request a new download link.', 'innovio_child'), __('Link Expired', 'innovio_child'), ['response' => 403]);
}

// Delete token immediately (one-time use)
delete_transient('dm_download_token_' . $token);

// Extract data
$report_id = intval($token_data['report_id'] ?? 0);
$user_identifier = $token_data['user_identifier'] ?? '';
$created_at = intval($token_data['created_at'] ?? 0);

// Validate report ID
if (empty($report_id)) {
    wp_die(__('Invalid report', 'innovio_child'), __('Error', 'innovio_child'), ['response' => 400]);
}

// Get the actual download link from ACF
$download_url = get_field('link_for_report', $report_id);

if (empty($download_url)) {
    wp_die(__('Download file not found', 'innovio_child'), __('Error', 'innovio_child'), ['response' => 404]);
}

// Log download for analytics (optional)
do_action('dm_file_downloaded', $report_id, $user_identifier);

// Redirect to the actual download URL (Google Drive)
wp_redirect($download_url);
exit;
