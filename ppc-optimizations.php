<?php
/**
 * PPC Landing Page Optimizations for Santa Ana Magic Smile
 * 
 * This file contains all customizations to optimize the home page for PPC traffic,
 * specifically focusing on mobile users by:
 * - Removing exit points (social icons, extra CTAs, menu)
 * - Making primary CTAs more prominent
 * - Improving mobile layout and hero image
 * - Taming popup calendar widget
 * 
 * LOCATION OF KEY ELEMENTS:
 * - Header social icons: .header-mobile > a[href*="facebook"], a[href*="instagram"]
 * - Schedule Now button: .menu-btn > a[href*="dm.pcols.com"]
 * - Hamburger menu: .menu-toggle button
 * - Phone number: .header-mobile > a[href^="tel:"]
 * - Book Online CTA: .yellow-btn a[href*="dm.pcols.com"] (multiple instances)
 * - Hero image: .elementor-element-c2fb0be img (home-image1a.png)
 * - ZocDoc popup: .zd-plugin widget at bottom of page
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Remove social icons from header on home page only
 */
function sams_hide_header_social_icons() {
    if (is_front_page()) {
        ?>
        <style>
            /* Hide social icons on home page */
            body.home .header-mobile a[href*="facebook"],
            body.home .header-mobile a[href*="instagram"] {
                display: none !important;
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'sams_hide_header_social_icons', 100);

/**
 * Remove "Schedule Now" button from header on home page
 */
function sams_hide_schedule_now_button() {
    if (is_front_page()) {
        ?>
        <style>
            /* Hide Schedule Now button in header on home page */
            body.home .menu-btn > a[href*="dm.pcols.com"] {
                display: none !important;
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'sams_hide_schedule_now_button', 100);

/**
 * Hide hamburger menu on home page for mobile/PPC traffic
 */
function sams_hide_hamburger_menu() {
    if (is_front_page()) {
        ?>
        <style>
            /* Hide hamburger menu on home page for mobile */
            @media (max-width: 1023px) {
                body.home .menu-toggle,
                body.home #site-navigation .menu-toggle {
                    display: none !important;
                    visibility: hidden !important;
                }
            }
            
            /* Also hide for PPC traffic (check for UTM params via JS) */
            body.home.ppc-traffic .menu-toggle {
                display: none !important;
            }
        </style>
        <script>
        (function() {
            // Check for PPC indicators in URL
            var urlParams = new URLSearchParams(window.location.search);
            var hasPPC = urlParams.has('gclid') || 
                        urlParams.has('utm_source') || 
                        urlParams.has('utm_campaign') ||
                        urlParams.has('fbclid');
            
            if (hasPPC && document.body.classList.contains('home')) {
                document.body.classList.add('ppc-traffic');
            }
        })();
        </script>
        <?php
    }
}
add_action('wp_head', 'sams_hide_hamburger_menu', 100);

/**
 * Make phone number more prominent in header on mobile
 */
function sams_prominent_phone_number() {
    if (is_front_page()) {
        ?>
        <style>
            /* Make phone number more prominent on mobile */
            @media (max-width: 768px) {
                body.home .header-mobile a[href^="tel:"] {
                    font-size: 24px !important;
                    font-weight: 600 !important;
                    padding: 10px 15px !important;
                    display: inline-block !important;
                    text-align: right !important;
                    width: 100% !important;
                    margin-bottom: 10px !important;
                }
                
                /* Ensure phone number is clickable and styled */
                body.home .header-mobile a[href^="tel:"]:hover {
                    text-decoration: underline !important;
                }
            }
            
            @media (max-width: 480px) {
                body.home .header-mobile a[href^="tel:"] {
                    font-size: 22px !important;
                }
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'sams_prominent_phone_number', 100);

/**
 * Adjust hero image focal point for mobile (show mother and daughter)
 */
function sams_adjust_hero_image() {
    if (is_front_page()) {
        ?>
        <style>
            /* Adjust hero image to show mother and daughter on mobile */
            @media (max-width: 768px) {
                body.home .elementor-element-c2fb0be img,
                body.home .elementor-widget-image img[src*="home-image1a"] {
                    object-position: center right !important;
                    object-fit: cover !important;
                }
                
                /* Ensure image container shows the right part */
                body.home .elementor-element-71dcd21 .elementor-widget-image {
                    overflow: hidden !important;
                }
            }
            
            @media (max-width: 480px) {
                body.home .elementor-element-c2fb0be img,
                body.home .elementor-widget-image img[src*="home-image1a"] {
                    object-position: 70% center !important;
                }
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'sams_adjust_hero_image', 100);

/**
 * Tame ZocDoc popup calendar widget
 * - Add delay before showing
 * - Reduce size on mobile
 * - Make it easily dismissible
 */
function sams_tame_zocdoc_popup() {
    if (is_front_page()) {
        ?>
        <style>
            /* Hide ZocDoc widget initially and style it */
            body.home .zd-plugin {
                opacity: 0 !important;
                transition: opacity 0.3s ease-in !important;
            }
            
            body.home .zd-plugin.zd-delayed-show {
                opacity: 1 !important;
            }
            
            /* Reduce size on mobile */
            @media (max-width: 768px) {
                body.home .zd-plugin img {
                    max-width: 150px !important;
                    height: auto !important;
                }
                
                body.home .zd-plugin {
                    position: fixed !important;
                    bottom: 20px !important;
                    right: 20px !important;
                    z-index: 9998 !important;
                    background: rgba(255, 255, 255, 0.95) !important;
                    padding: 10px !important;
                    border-radius: 8px !important;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
                }
                
                /* Close button will be added via JavaScript */
            }
        </style>
        <script>
        (function() {
            if (!document.body.classList.contains('home')) return;
            
            // Wait for ZocDoc widget to load
            function initZocDocWidget() {
                var zocDocWidget = document.querySelector('.zd-plugin');
                if (!zocDocWidget) {
                    // Retry after a short delay
                    setTimeout(initZocDocWidget, 500);
                    return;
                }
                
                // Check if user has dismissed it before (localStorage)
                var dismissed = localStorage.getItem('sams_zocdoc_dismissed');
                if (dismissed === 'true') {
                    zocDocWidget.style.display = 'none';
                    return;
                }
                
                // Add close button functionality
                var closeBtn = document.createElement('div');
                closeBtn.innerHTML = '×';
                closeBtn.className = 'sams-zocdoc-close';
                closeBtn.style.cssText = 'position:absolute;top:-8px;right:-8px;width:24px;height:24px;background:#333;color:white;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:20px;cursor:pointer;line-height:1;z-index:9999;font-weight:bold;';
                closeBtn.setAttribute('aria-label', 'Close booking widget');
                closeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    zocDocWidget.style.display = 'none';
                    localStorage.setItem('sams_zocdoc_dismissed', 'true');
                });
                
                // Make widget position relative for close button and ensure it's visible
                var widgetParent = zocDocWidget.parentElement;
                if (widgetParent) {
                    widgetParent.style.position = 'relative';
                }
                zocDocWidget.style.position = 'relative';
                zocDocWidget.appendChild(closeBtn);
                
                // Delay showing the widget (5 seconds)
                setTimeout(function() {
                    zocDocWidget.classList.add('zd-delayed-show');
                }, 5000);
            }
            
            // Start initialization when DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initZocDocWidget);
            } else {
                initZocDocWidget();
            }
        })();
        </script>
        <?php
    }
}
add_action('wp_footer', 'sams_tame_zocdoc_popup', 100);

/**
 * Ensure Book Online CTA is prominent and above the fold on mobile
 */
function sams_prominent_book_online_cta() {
    if (is_front_page()) {
        ?>
        <style>
            /* Make primary Book Online button more prominent on mobile */
            @media (max-width: 768px) {
                /* Target the first yellow button in the hero section */
                body.home #health_right .yellow-btn .elementor-button,
                body.home .elementor-element-1afbc76 .elementor-button {
                    font-size: 20px !important;
                    padding: 18px 30px !important;
                    width: 100% !important;
                    max-width: 100% !important;
                    display: block !important;
                    text-align: center !important;
                    margin: 20px 0 !important;
                    font-weight: 600 !important;
                }
                
                /* Ensure it's above the fold */
                body.home #health_main {
                    min-height: auto !important;
                }
                
                body.home #health_right {
                    order: -1 !important; /* Move to top on mobile */
                }
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'sams_prominent_book_online_cta', 100);

/**
 * Clean up header spacing after removals
 */
function sams_clean_header_spacing() {
    if (is_front_page()) {
        ?>
        <style>
            /* Clean up header spacing on mobile after removing elements */
            @media (max-width: 768px) {
                body.home .header-mobile {
                    display: flex !important;
                    flex-direction: column !important;
                    align-items: flex-end !important;
                    gap: 10px !important;
                    padding: 10px 0 !important;
                }
                
                body.home .inside-header {
                    display: flex !important;
                    justify-content: space-between !important;
                    align-items: center !important;
                    flex-wrap: wrap !important;
                }
                
                body.home .site-logo {
                    flex: 0 0 auto !important;
                }
                
                body.home .menu-btn {
                    flex: 0 0 auto !important;
                }
                
                /* Ensure header doesn't wrap awkwardly */
                body.home .inside-header > * {
                    margin: 5px 0 !important;
                }
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'sams_clean_header_spacing', 100);

