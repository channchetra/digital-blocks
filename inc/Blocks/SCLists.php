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

class SCLists extends BaseController
{
	public function register() {
       add_action( "init", array( $this, "registerBlock" ) );
    }
    public function registerBlock() {
        register_block_type(
            $this->plugin_name . '/sc-lists', array(
                'style'         => $this->plugin_name . '-style',
                'editor_script' => $this->plugin_name . '-js',
                'editor_style'  => $this->plugin_name . '-editor-css',
                'render_callback' => array( $this, 'renderPostsBlock' ),
                'attributes' => array(
                    'api' => array(
                        'type' => 'string',
                        'default' => ''
                    ),
                    'item_to_show' => array(
                        'type' => 'number',
                        'default' => 8
                    ),
                    'tax_term' => [
                        'type' => 'number',
                        'default' => ''
                    ]
                )
            )
        );
    }
    public function renderPostsBlock( $attributes ) {
        ob_start();
        echo '<pre>';
            print_r($attributes);
        echo '</pre>';
        echo '<div class="container">';
        foreach( $this->getDistantTerms( $attributes ) as $item ) {
            echo '<p><a href="'. get_site_url() . '/service-detail/?service_id='.$item->id.'">'.$item->title->rendered.'</a></p>';
        }
        echo '</div>';
        return ob_get_clean();
    }
    public function getDistantTerms( $attributes ) {
        $response = wp_remote_get('https://demo.cambodia.gov.kh/wp-json/wp/v2/service?service-topic='.$attributes['tax_term']);
        if(is_wp_error($response)) {
            return array();
        }
        return json_decode(wp_remote_retrieve_body($response));
    }
}

