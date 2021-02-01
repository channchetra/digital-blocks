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
                    )
                )
            )
        );
    }
    public function renderPostsBlock( $attributes ) {
        ob_start();
        echo '<pre>';
        // print_r( $this->getDistantTerms() );
        // foreach( $this->getDistantTerms() as $item ) {
        //     print_r( $item->content->rendered );
        // }
        echo '</pre>';
        echo '<div class="container">';
        foreach( $this->getDistantTerms( 'https://demo.cambodia.gov.kh/wp-json/wp/v2/service?service-topic=316' ) as $item ) {
            echo '<p><a href="https://provincial.local/service-detail/?service_id='.$item->id.'">'.$item->title->rendered.'</a></p>';
        }
        echo '</div>';
        return ob_get_clean();
    }
}

