<?php get_header(); ?>
<div id="inner-wrap" class="<?php echo shandora_is_home() ? 'home ' : ''; ?>slide">

    <?php 

        if( bon_get_option('show_slider', 'show') == 'show' && is_front_page() ) {
            bon_get_template_part('loop', 'slider'); 
        }

    ?>

    <div id="body-container" class="container">


        <?php 

        /**
         * Shandora Before Loop Hook
         *
         * @hooked shandora_get_page_header - 1
         * @hooked shandora_search_get_listing - 2
         * @hooked shandora_open_main_content_row - 5
         * @hooked shandora_get_left_sidebar - 10
         * @hooked shandora_open_main_content_column - 15
         *
         */

        do_atomic('before_loop'); ?>
   
            <?php bon_get_template_part('loop', get_post_type()); ?>

        <?php 

        /**
         * Shandora After Loop Hook
         *
         * @hooked shandora_close_main_content_column - 1
         * @hooked shandora_get_right_sidebar - 5
         * @hooked shandora_close_main_content_row - 10
         *
         */

        do_atomic('after_loop'); ?>

    </div>


<?php get_footer(); ?>
