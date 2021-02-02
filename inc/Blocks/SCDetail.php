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

class SCDetail extends BaseController
{
	public function register() {
       add_action( "init", array( $this, "registerBlock" ) );
    }
    public function registerBlock() {
        register_block_type(
            $this->plugin_name . '/sc-detail', array(
                'style'         => $this->plugin_name . '-style',
                'editor_script' => $this->plugin_name . '-js',
                'editor_style'  => $this->plugin_name . '-editor-css',
                'render_callback' => array( $this, 'renderPostsBlock' ),
                'attributes' => array(
                    'api' => array(
                        'type' => 'string',
                        'default' => ''
                    )
                )
            )
        );
    }
    public function renderPostsBlock( $attributes ) {
        if ( ! isset( $_GET['service_id'] ) ) {
            return;
        }
        $id = $_GET['service_id'];
        $data = $this->getDistantTerms( 'https://demo.cambodia.gov.kh/wp-json/wp/v2/service/'.$id );
        ob_start();
        echo '
        <section class="mb-2 mb-md-6">
            <header class="block-heading text-left">
                <h4 class="text-danger font-weight-bold">
                    '.$data->title->rendered.'
                </h4>
            </header>
        </section>
        ';
        echo $data->content->rendered;
        return ob_get_clean();
    }
    
}

