add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

function twentysixteen_scripts() {

wp_register_style('bootstrap',get_template_directory_uri().'/css/bootstrap.css');
	wp_enqueue_style('bootstrap');

	wp_enqueue_script('jquery');

	wp_register_script('bootstrap-js',get_template_directory_uri().'/js/bootstrap.min.js',array(),true,false);
	wp_enqueue_script('bootstrap-js');
}


/*get the images*/

function get_images_from_media_library() {
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' =>'image',
        'post_status' => 'inherit',
        'posts_per_page' => 5,
        'orderby' => 'rand'
    );
    $query_images = new WP_Query( $args );
    $images = array();
    foreach ( $query_images->posts as $image) {
        $images[]= $image->guid;
    }
    return $images;
}

/*shortcode for display random images in single row*/
  function display_images_from_media_library() {

	$imgs = get_images_from_media_library();
	$html = '<div id="media-gallery" class="col-md-12 col-xs-12 col-sm-12">';
	
	foreach($imgs as $img) {
	
		$html .= '<img src="' . $img . '" alt="" class="img-responsive col-md-2 col-xs-12"/>';
	
	}
	
	$html .= '</div>';
	
	return $html;

}

add_shortcode('display_images_from_media_library','display_images_from_media_library');

/*add this shortcode into post or page in wordpress images will display*/
[display_images_from_media_library]
