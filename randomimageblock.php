<?php
/**
 * Plugin Name:       Random Image Block -bn
 * Plugin URI:        https://bryannance.com
 * Description:       A block that displays a random image as a background for a container.
 * Version:           1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            Bryan Nance
 * Author URI:        https://bryannance.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       random-image-block
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
// Render the block dynamically
function render_random_image_block($attributes) {
    if (empty($attributes['images']) || !is_array($attributes['images'])) {
        return '<div class="random-image-block">No images selected.</div>';
    }

    // Pick a new random image each time the page loads
    $random_image = $attributes['images'][array_rand($attributes['images'])];
    $parallax_class = !empty($attributes['enableParallax']) ? 'parallax' : '';

    return sprintf(
        '<div class="random-image-block %s" style="background-image: url(%s);">
        </div>',
        esc_attr($parallax_class),
        esc_url($random_image)
    );
}


function random_image_block_register_block() {
    register_block_type(__DIR__ . '/build/testblock', array(
        'render_callback' => 'render_random_image_block',
    ));
}
add_action('init', 'random_image_block_register_block');

