<!-- This is the Function PHP file normally located in wp-content/themes/theme/. Simply add this code to that file, DO NOT REPLACE IT WITH THIS CODE -->
<?php
    function ajax_filter_posts() {
        $category = esc_attr( $_POST['category'] );
        $date = esc_attr( $_POST['date'] );

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        );

        if ( $category != 'all' )
            $args['cat'] = $category;

        if ( $date == 'new' ) {
            $args['order'] = 'DESC';
        } else {
            $args['order'] = 'ASC';
        }

        $posts = 'No posts found.';

        $the_query = new WP_Query( $args );
    
        if ( $the_query->have_posts() ) :
            ob_start();
            while ( $the_query->have_posts() ) : $the_query->the_post();
                echo '<article id="post-id-' . the_id() . '"><a href="' . the_permalink() . '"><h3>' . the_title() . '"</h3></article>';
            endwhile;
            $posts = ob_get_clean();
        endif;

        $return = array(
            'posts' => $posts
        );

        wp_send_json($return);
    }
    add_action( 'wp_ajax_filterposts', 'ajax_filter_posts' );
    add_action( 'wp_ajax_nopriv_filterposts', 'ajax_filter_posts' );
?>