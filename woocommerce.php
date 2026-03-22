<?php
/**
 * The template for displaying WooCommerce pages
 *
 * @package suyropainterior
 */

get_header();
?>

    <div class="woocommerce-page-container">
        <?php woocommerce_content(); ?>
    </div>

<?php
get_sidebar();
get_footer();
