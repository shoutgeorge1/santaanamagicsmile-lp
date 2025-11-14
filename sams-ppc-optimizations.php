<?php
/**
 * Plugin Name: SAMS PPC Landing Page Optimizations
 * Plugin URI: https://www.santaanamagicsmile.com
 * Description: Optimizes the home page for PPC traffic by removing exit points, simplifying CTAs, and improving mobile experience.
 * Version: 1.0.0
 * Author: Santa Ana Magic Smile
 * Author URI: https://www.santaanamagicsmile.com
 * License: GPL v2 or later
 * Text Domain: sams-ppc-optimizations
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Include the main optimizations file
require_once plugin_dir_path(__FILE__) . 'ppc-optimizations.php';

