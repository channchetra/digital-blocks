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

class SCFor extends BaseController
{
	public function register() {
       add_action( "init", array( $this, "registerBlock" ) );
    }
    public function registerBlock() {
        register_block_type(
            $this->plugin_name . '/sc-for', array(
                'style'         => $this->plugin_name . '-style',
                'editor_script' => $this->plugin_name . '-js',
                'editor_style'  => $this->plugin_name . '-editor-css',
                'render_callback' => array( $this, 'renderPostsBlock' ),
                'attributes' => array(
                    'api' => array(
                        'type' => 'string',
                        'default' => ''
                    ),
                    'union' => array(
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
        ob_start();
        
        $column = 3;
        $term_id = $attributes['union'];
        $api = $attributes['api'];
        echo (
            '
            <div class="">
                <div class="block-topic">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
            '
        );

        foreach ( $this->getDistantTerms( $api.'/'.$term_id ) as $key => $term ) {
            printf(
                '
                <td>
                    <article>
                        <figure class="d-lg-flex">
                            <div class="mr-lg-2">
                                <img width="34" src="%s" />
                            </div>
                            <figcaption>
                                <a href="%s?topic=%s&for=%s">
                                    <h5>%s</h5>
                                </a>
                                <p class="d-none d-lg-block">%s</p>
                            </figcaption>
                        </figure>
                    </article>
                </td>
                ',
                $term->icon,
                $attributes['page'],
                $term->id,
                $term_id,
                $term->name,
                $term->description
            );
            if ( ( ( $key + 1 ) % $column ) === 0 ) {
                echo '</tr><tr>';
            }
            
        }

        echo ( '</tr></tbody></table></div></div>' );

        return ob_get_clean();
    }
    
}

