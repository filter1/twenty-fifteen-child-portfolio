<?php
function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


function wpb_list_child_pages() {

global $post;

if ( is_page() && $post->post_parent )
	$childpages = get_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
else
	$childpages = get_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );

if ( $childpages ) {

	$string = "<div class='filter-container'>";
	foreach($childpages as $page){
		$string .= '<div>' . get_the_post_thumbnail( $page->ID, 'full') . '<p>' . get_the_title( $page->ID ) . '</p>' . '</div>';
	}
	$string .= '</div>';
}

return $string;

}

add_shortcode('wpb_childpages', 'wpb_list_child_pages');
?>
