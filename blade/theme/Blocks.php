<?php 

namespace ShaneOliver;

use Carbon_Fields\Field;
use Carbon_Fields\Block;
use Carbon_Fields\Container;

class Blocks
{
    /**
     * Register Carbon Fields blocks
     */
    public function register()
    {
        Block::make(__('My Shiny Gutenberg Block'))
            ->add_fields([
                Field::make('text', 'heading', __('Block Heading')),
                Field::make('image', 'image', __('Block Image')),
                Field::make('rich_text', 'content', __('Block Content')),
            ])->set_render_callback(function($fields, $attributes, $inner_blocks) {
                view('blocks.test', $fields);
            });
    }
}