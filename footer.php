    </main><!-- #primary -->

    <!-- Footer Mobile (Tab Bar Sticky) -->
    <footer class="site-footer-mobile-tabbar">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="tabbar-item <?php echo is_front_page() ? 'active' : ''; ?>">
            <span class="tabbar-icon">🏠</span>
            <span class="tabbar-label">Inicio</span>
        </a>

        <?php if ( class_exists( 'WooCommerce' ) ) : ?>
        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="tabbar-item <?php echo is_shop() ? 'active' : ''; ?>">
            <span class="tabbar-icon">🛍️</span>
            <span class="tabbar-label">Tienda</span>
        </a>

        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="tabbar-item <?php echo is_cart() ? 'active' : ''; ?>">
            <span class="tabbar-icon">🛒</span>
            <span class="tabbar-label">Carrito</span>
            <?php
                $cart_count = WC()->cart->get_cart_contents_count();
                if ( $cart_count > 0 ) {
                    echo '<span class="cart-count">(' . esc_html( $cart_count ) . ')</span>';
                }
            ?>
        </a>
        <?php endif; ?>
    </footer>

</div><!-- #page .site-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
