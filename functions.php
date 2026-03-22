<?php
/**
 * SUY ROPA INTERIOR functions and definitions
 *
 * @package suyropainterior
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/* ==========================================================================
   Misión Crítica: Sistema de Actualizaciones Remotas (PUC)
   --------------------------------------------------------------------------
   IMPORTANTE: Una vez generado, este bloque de código es INTOCABLE.
   No alterar en futuras tareas, ya que es el puente de comunicación con el servidor.
   ========================================================================== */

require_once get_template_directory() . '/inc/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/bruisertech/BRUISER-TECH-suyropainterior.com-tema/',
    __FILE__,
    'suyropainterior' // Tema slug
);

// Establecer la rama a 'main'
$myUpdateChecker->setBranch('main');

// Autenticación para el repositorio privado
// --------------------------------------------------------------------------
// INSERTE SU GITHUB PERSONAL ACCESS TOKEN (CLASSIC) A CONTINUACIÓN
// --------------------------------------------------------------------------
$myUpdateChecker->setAuthentication('AQUI_TU_TOKEN');


/* ==========================================================================
   Configuración del Tema
   ========================================================================== */

if ( ! function_exists( 'suyropainterior_setup' ) ) :
    function suyropainterior_setup() {
        // Soporte para etiquetas de título
        add_theme_support( 'title-tag' );

        // Soporte para miniaturas
        add_theme_support( 'post-thumbnails' );

        // Registro de menús
        register_nav_menus(
            array(
                'menu-1' => esc_html__( 'Primary', 'suyropainterior' ),
            )
        );

        // Soporte para HTML5
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Soporte para WooCommerce
        add_theme_support( 'woocommerce', array(
            'thumbnail_image_width' => 600,
            'single_image_width'    => 800,
            'product_grid'          => array(
                'default_rows'    => 3,
                'min_rows'        => 2,
                'max_rows'        => 8,
                'default_columns' => 4,
                'min_columns'     => 2,
                'max_columns'     => 5,
            ),
        ) );

        // Soporte para Galería de WooCommerce
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
endif;
add_action( 'after_setup_theme', 'suyropainterior_setup' );

/* ==========================================================================
   Encolado de Scripts y Estilos
   ========================================================================== */

function suyropainterior_scripts() {
    // Fuentes de Google: Playfair Display
    wp_enqueue_style( 'suyropainterior-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap', array(), null );

    // Estilo Principal
    wp_enqueue_style( 'suyropainterior-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'suyropainterior_scripts' );

/* ==========================================================================
   Funciones Auxiliares
   ========================================================================== */

if ( ! function_exists( 'suyropainterior_post_thumbnail' ) ) :
    /**
     * Muestra la miniatura del post opcional.
     */
    function suyropainterior_post_thumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        if ( is_singular() ) :
            ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->
        <?php else : ?>
            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail(
                    'post-thumbnail',
                    array(
                        'alt' => the_title_attribute(
                            array(
                                'echo' => false,
                            )
                        ),
                    )
                );
                ?>
            </a>
        <?php
        endif; // End is_singular().
    }
endif;
