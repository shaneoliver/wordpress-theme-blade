<?php

namespace ShaneOliver;

class PostTypes
{
    /**
     * Create Custom Post Types
     * Generate the post type fields here https://generatewp.com/post-type/
     * 
     * @return  mixed [array, error]
     */
    public function register() 
    {

    }

    /**
     * Flush Rewrite on CPT activation
     * 
     * @return empty
     */
    public function rewrite_flush()
    {
        // call the CPT init function
        $this->register();

        // Flush the rewrite rules only on theme activation
        flush_rewrite_rules();
    }
}
