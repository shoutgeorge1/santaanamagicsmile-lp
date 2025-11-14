# PPC Landing Page Optimizations for Santa Ana Magic Smile

## Overview
This file contains optimizations to improve the home page experience for PPC (paid search) traffic, with a focus on mobile users.

## Installation Instructions

### Option 1: Add to Child Theme's functions.php (Recommended)
1. Open your child theme's `functions.php` file
2. Add this line at the end:
   ```php
   require_once get_stylesheet_directory() . '/ppc-optimizations.php';
   ```
3. Upload `ppc-optimizations.php` to your child theme directory

### Option 2: Install as Plugin
1. Create a new folder: `wp-content/plugins/sams-ppc-optimizations/`
2. Upload `ppc-optimizations.php` to that folder
3. Create a plugin header file (see below)
4. Activate the plugin in WordPress admin

## Changes Implemented

### Header Changes
- ✅ **Removed social icons** (Facebook, Instagram) from header on home page
- ✅ **Removed "Schedule Now" button** from header on home page
- ✅ **Hidden hamburger menu** on home page for mobile devices and PPC traffic
- ✅ **Made phone number more prominent** (larger font, better spacing on mobile)
- ✅ **Cleaned up header spacing** after element removals

### CTA / Booking Flow Changes
- ✅ **Consolidated to one primary "Book Online" CTA** (removed duplicate Schedule Now)
- ✅ **Made "Book Online" button more prominent** on mobile (full-width, larger, above fold)

### Mobile Layout Changes
- ✅ **Adjusted hero image focal point** to show mother and daughter on mobile
- ✅ **Tamed ZocDoc popup calendar widget**:
  - 5-second delay before appearing
  - Smaller size on mobile
  - Easy dismiss button (stays dismissed via localStorage)
  - Positioned as fixed bottom-right on mobile

## Files Modified
- `ppc-optimizations.php` - Main optimization file with all customizations

## Testing Checklist

### On Mobile View (Dev Tools or Real Device):
- [ ] Header no longer shows Facebook/Instagram icons on home page
- [ ] "Schedule Now" header button is gone
- [ ] There is exactly ONE clear booking CTA ("Book Online" or "Make an Appointment") above the fold
- [ ] Hamburger/menu icon is hidden on home page (especially for ad traffic)
- [ ] Hero image shows the mother and daughter clearly
- [ ] ZocDoc popup calendar:
  - Does NOT immediately appear on load
  - Appears after 5 seconds
  - Is smaller and easy to dismiss
  - Stays dismissed after closing
- [ ] Phone number is visually prominent, clickable, and well-positioned
- [ ] Header spacing looks clean and uncluttered

### On Desktop:
- [ ] Desktop layout remains functional and visually unchanged
- [ ] No broken CSS/JS references or console errors

## Tracking & Analytics
All existing tracking is preserved:
- Google Tag Manager scripts remain intact
- GA4 tracking remains intact
- CallRail tracking remains intact
- Phone number click tracking (gtag conversion) remains intact

## Notes
- Changes only apply to the home page (`is_front_page()`)
- Social icons and Schedule Now button still appear on other pages
- Hamburger menu is only hidden on mobile viewports (max-width: 1023px)
- ZocDoc widget dismissal is stored in localStorage (per browser)

## Support
If you need to revert changes, simply comment out or remove the `require_once` line from your `functions.php` file.

# santaanamagicsmile-lp
