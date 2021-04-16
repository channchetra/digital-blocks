<?php
/**
 * @package CEGOV
 */

namespace CEGOV\Blocks;

use CEGOV\Base\BaseController;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */

class SCUnion extends BaseController
{
	public function register() {
       add_action( "init", array( $this, "registerBlock" ) );
    }
    public function registerBlock() {
        register_block_type(
            $this->plugin_name . '/sc-union', array(
                'style'         => $this->plugin_name . '-style',
                'editor_script' => $this->plugin_name . '-js',
                'editor_style'  => $this->plugin_name . '-editor-css',
                'render_callback' => array( $this, 'renderPostsBlock' ),
                'attributes' => array(
                    'api' => array(
                        'type' => 'string',
                        'default' => ''
                    ),
                    'page' => array(
                        'type' => 'string',
                        'default' => ''
                    )
                )
            )
        );
    }
    public function renderPostsBlock( $attributes ) {
        $api = $attributes['api'];
        $service_topic = isset( $_GET['topic'] ) ? $_GET['topic'] : '';
        $service_for = isset( $_GET['for'] ) ? $_GET['for'] : '';
        $service_level = isset( $_GET['level'] ) ? $_GET['level'] : '';
        $des_page_slug = $attributes['page'];
        if ( !$api || !$service_for || !$service_topic || !$des_page_slug ) {
            return ob_get_clean();
        }
        ob_start();

        echo ( $this->getDistantTerms( $api.'/topic='.$service_topic.'/for='.$service_for.'/level='.$service_level.'/base='.$this->baseUrlWithoutHttp().'/page='.$des_page_slug ));

        return ob_get_clean();
    }
}

