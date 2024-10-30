<?php

/*
Plugin Name: Blocksolid Gather
Plugin URI: https://www.peripatus.uk/blocksolid-gather
Description: Creates a Gutenberg block and shortcode that pulls in related posts and media via specified parameters
Version: 1.1.9
Author: Peripatus Web Design
Author URI: https://www.peripatus.uk
License: GPLv2 or later
Text Domain: blocksolid-gather
*/

// ---------------------------------------------------------------------------------------------------------------------------------------------

add_action('admin_enqueue_scripts', 'blocksolid_gather_admin_styles');
function blocksolid_gather_admin_styles() {
	wp_enqueue_style( 'blocksolid-gather-admin-styles', plugins_url( '/css/blocksolid-gather-admin-styles.css', __FILE__ ), '', filemtime(plugin_dir_path(__FILE__).'css/blocksolid-gather-admin-styles.css'));
}

add_action( 'wp_enqueue_scripts', 'blocksolid_gather_enqueue' );
function blocksolid_gather_enqueue() {
	wp_enqueue_style( 'blocksolid_gather', plugins_url( '/css/blocksolid-gather.css', __FILE__ ), '', filemtime(plugin_dir_path(__FILE__).'css/blocksolid-gather.css'));
}

// ---------------------------------------------------------------------------------------------------------------------------------------------

/**
 * Add video and podcast metaboxes to posts.
 */

function blocksolid_gather_add_metabox() {
   add_meta_box(
		'blocksolid_gather_section',  	// The HTML id attribute for the metabox section
		'Videos & Podcats',     		// The title of your metabox section
		'blocksolid_gather_metabox_callback',  // The metabox callback function (below)
		'post'                  		// Your custom post type slug
	);
}
add_action( 'add_meta_boxes', 'blocksolid_gather_add_metabox' );

/**
 * Print the metabox content.
 */

function blocksolid_gather_metabox_callback( $post ) {

   // Create a nonce field.
	wp_nonce_field( 'blocksolid_gather_metabox', 'blocksolid_gather_metabox_nonce' );

	// Retrieve a previously saved value, if available.
	$blocksolid_gather_video = get_post_meta( $post->ID, '_blocksolid_gather_video', true );
	$blocksolid_gather_podcast = get_post_meta( $post->ID, '_blocksolid_gather_podcast', true );

   // Create the metabox field mark-up.
   ?>
      <p>
         <label><strong>Video URL</strong></label>&nbsp; &nbsp; &nbsp;<input style="width: 20em;" type="text" name="blocksolid_gather_video" value="<?php echo esc_url( $blocksolid_gather_video ); ?>" size="30" class="regular-text" />
		 <br>
		 <small>e.g. https://youtu.be/aqz-KE-bpKQ</small>
      </p>

      <p>
         <label><strong>Podcast URL</strong></label>&nbsp; <input style="width: 20em;" type="text" name="blocksolid_gather_podcast" value="<?php echo esc_url( $blocksolid_gather_podcast ); ?>" size="30" class="regular-text" />
		 <br>
		 <small>e.g. https://www.buzzsprout.com/123456.mp3</small>
      </p>

   <?php
}

/**
 * Save the metabox.
 */

function blocksolid_gather_save_metabox( $post_id ) {
   // Check if our nonce is set.
   if ( ! isset( $_POST['blocksolid_gather_metabox_nonce'] ) ) {
      return;
   }

   $nonce = $_POST['blocksolid_gather_metabox_nonce'];

   // Verify that the nonce is valid.
   if ( ! wp_verify_nonce( $nonce, 'blocksolid_gather_metabox' ) ) {
      return;
   }

   // If this is an autosave, our form has not been submitted, so we don't want to do anything.
   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return;
   }

   // Check the user's permissions.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
      return;
   }

   // Check for and sanitize user input.
   if ( ! isset( $_POST['blocksolid_gather_video'] ) ) {
      return;
   }

   $blocksolid_gather_video = esc_url_raw( $_POST['blocksolid_gather_video'] );

   // Update the meta fields in the database, or clean up after ourselves.
   if ( empty( $blocksolid_gather_video ) ) {
      delete_post_meta( $post_id, '_blocksolid_gather_video' );
   } else {
      update_post_meta( $post_id, '_blocksolid_gather_video', $blocksolid_gather_video );
   }

   // Check for and sanitize user input.
   if ( ! isset( $_POST['blocksolid_gather_podcast'] ) ) {
      return;
   }

   $blocksolid_gather_podcast = esc_url_raw( $_POST['blocksolid_gather_podcast'] );

   // Update the meta fields in the database, or clean up after ourselves.
   if ( empty( $blocksolid_gather_podcast ) ) {
      delete_post_meta( $post_id, '_blocksolid_gather_podcast' );
   } else {
      update_post_meta( $post_id, '_blocksolid_gather_podcast', $blocksolid_gather_podcast );
   }


}
add_action( 'save_post', 'blocksolid_gather_save_metabox' );

// ---------------------------------------------------------------------------------------------------------------------------------------------

// Gutenberg block

add_action('init', function() {

	if (!function_exists('register_block_type')) {
		return;
	}

	$blocksolid_gather_media_url = plugins_url() . '/blocksolid-gather/media/'; // https://stackoverflow.com/questions/57303729/

	$default_placeholder_image = $blocksolid_gather_media_url.'default-placeholder.png';

	$js_data = array(
		'blocksolid_gather_media_url' => $blocksolid_gather_media_url,
	);

	wp_register_script( 'blocksolid-gather-js', plugins_url( '/gutenberg/blocksolid-gather.js', __FILE__ ), array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ), '1.0', false );
	register_block_type('pwd/gather', array(
			'editor_script' => 'blocksolid-gather-js',
			'render_callback' => 'blocksolid_gather_block_handler',
			'attributes' => [
				'gather_max_posts' => [
					'type' => 'string',
					'default' => '1'
				],
				'gather_first_post' => [
					'type' => 'string',
					'default' => '1'
				],
				'gather_post_type' => [
					'type' => 'string',
					'default' => 'post'
				],
				'gather_title' => [
					'type' => 'string',
					'default' => ''
				],
				'gather_categories' => [
					'type' => 'string',
					'default' => ''
				],
				'gather_excluded_categories' => [
					'type' => 'string',
					'default' => ''
				],
				'gather_tags' => [
					'type' => 'string',
					'default' => ''
				],
				'gather_number_per_row' => [
					'type' => 'string',
					'default' => '1'
				],
				'gather_order_by' => [
					'type' => 'string',
					'default' => 'date'
				],
				'gather_ascending' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_ignore_sticky' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_get_related' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_media_position' => [
					'type' => 'string',
					'default' => 'top'
				],
				'gather_media_size' => [
					'type' => 'string',
					'default' => 'thumbnail'
				],
				'gather_excerpt_length' => [
					'type' => 'string',
					'default' => 'full'
				],
				'gather_excerpt_signoff' => [
					'type' => 'string',
					'default' => '...'
				],
				'gather_placeholder_image_src' => [
					'type' => 'string',
					'default' => $default_placeholder_image
				],
				'gather_placeholder_image_id' => [
					'type' => 'string',
					'default' => '0'
				],
				'gather_show_media_only' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_show_media_caption' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_show_media_link' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_move_title_above' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_move_meta_above' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_move_meta_above_title' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_show_additional_full_excerpt' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_media_hover' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_show_figcaption_link' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_hide_margins' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_final_row_pad_empty' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_show_date_created' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_show_author' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_show_categories' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_show_tags' => [
					'type' => 'boolean',
					'default' => false
				],
				'gather_current_post_id' => [
					'type' => 'string',
					'default' => '0'
				],
				'gather_taxonomy_slug' => [
					'type' => 'string',
					'default' => 'category'
				],
			]
	));

	wp_add_inline_script(
		'blocksolid-gather-js',
		'var jsData = ' . wp_json_encode( $js_data ),
		'before'
	);

});


// ---------------------------------------------------------------------------------------------------------------------------------------------

/**
 * Handler for post title block
 * @param $atts
 *
 * @return string
 */
function blocksolid_gather_block_handler($atts){

	$gather_render = blocksolid_gather(
										$atts['gather_max_posts'],
										$atts['gather_first_post'],
										$atts['gather_categories'],
										$atts['gather_excluded_categories'],
										$atts['gather_tags'],
										$atts['gather_number_per_row'],
										$atts['gather_order_by'],
										$atts['gather_ascending'],
										$atts['gather_ignore_sticky'],
										$atts['gather_get_related'],
										false,
										$atts['gather_title'],
										false,
										$atts['gather_post_type'],
										$atts['gather_media_position'],
										$atts['gather_media_size'],
										$atts['gather_excerpt_length'],
										$atts['gather_excerpt_signoff'],
										$atts['gather_placeholder_image_src'],
										$atts['gather_placeholder_image_id'],
										$atts['gather_show_media_only'],
										$atts['gather_show_media_caption'],
										$atts['gather_show_media_link'],
										$atts['gather_move_title_above'],
										$atts['gather_move_meta_above'],
										$atts['gather_move_meta_above_title'],
										$atts['gather_show_additional_full_excerpt'],
										$atts['gather_media_hover'],
										$atts['gather_show_figcaption_link'],
										$atts['gather_hide_margins'],
										$atts['gather_final_row_pad_empty'],
										$atts['gather_show_date_created'],
										$atts['gather_show_author'],
										$atts['gather_show_categories'],
										$atts['gather_show_tags'],
										false
										);

	return $gather_render;

}

// ---------------------------------------------------------------------------------------------------------------------------------------------

function blocksolid_gather_by_title_with_feedback($page_title, $format, $post_type){

	if ($page_title != ""){

        $posts = get_posts(
        	array(
        		'post_type'              => $post_type,
        		'title'                  => $page_title,
        		'post_status'            => 'publish',
        		'numberposts'            => 1,
        		'update_post_term_cache' => false,
        		'update_post_meta_cache' => false,
        		'orderby'                => 'post_date ID',
        		'order'                  => 'ASC',
        	)
        );

        if ( ! empty( $posts ) ) {
        	$post = $posts[0];
        } else {
        	$post = null;
        }

	    if ($post){
	        return ($post);
	    }else{
	        return false;
	    }
	}else{
        return false;
	}

}

function blocksolid_gather_add_thumbnail_support() {
	if(!current_theme_supports('post-thumbnails')) {
		add_theme_support('post-thumbnails');
	}
}
add_action('init', 'blocksolid_gather_add_thumbnail_support');

add_image_size( 'widescreen_large', 1920, 1080, true );
add_image_size( 'widescreen_medium', 800, 450, true );
add_image_size( 'widescreen_thumbnail', 500, 281, true );

// Register the additional image sizes for use in Add Media modal
add_filter( 'image_size_names_choose', 'blocksolid_gather_custom_sizes' );
function blocksolid_gather_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'widescreen_large' => __( 'Widescreen Large' ),
        'widescreen_medium' => __( 'Widescreen Medium' ),
        'widescreen_thumbnail' => __( 'Widescreen Thumbnail' ),
    ) );
}

function blocksolid_gather_get_all_image_sizes() {
    global $_wp_additional_image_sizes;

    $default_image_sizes = get_intermediate_image_sizes();

    foreach ( $default_image_sizes as $size ) {
        $image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
        $image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
        $image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
    }

    if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
        $image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
    }

    return $image_sizes;
}

function get_blocksolid_gather_content(
	$blocksolid_gather,
	$number_per_row,
	$order_by,
	$categories,
	$excluded_categories,
	$tags,
	$primary_category_id,
	$post_type,
	$site,
	$media_position,
	$media_size,
	$excerpt_length,
	$excerpt_signoff,
	$placeholder_image_src,
	$placeholder_image_id,
	$show_media_only,
	$show_media_caption,
	$show_media_link,
	$move_title_above,
	$move_meta_above,
	$move_meta_above_title,
	$show_additional_full_excerpt,
	$media_hover,
	$show_figcaption_link,
	$hide_margins,
	$final_row_pad_empty,
	$show_date_created,
	$show_author,
	$show_categories,
	$show_tags,
	$current_post_id
	){

	$truncate_title_to = 100;

	if (wp_is_mobile()){
		$emulate_mobile = true;
	}else{
		$emulate_mobile = false;
	}

	$blog_id = false;

	if ($site != ""){
		if ($site == 'root'){
			$blog_id = get_blog_id_from_url($_SERVER['HTTP_HOST'],'/');
		}else{
			$blog_id = get_blog_id_from_url($_SERVER['HTTP_HOST'],'/'.$site.'/');
		}
	}

	if (is_numeric($blog_id)){
		switch_to_blog($blog_id); //Multisite
	}

	if (!(is_array($blocksolid_gather))){

		$post = get_object_vars( $blocksolid_gather );

		foreach ( array( 'ancestors', 'page_template', 'post_category', 'tags_input' ) as $key ) {
			if ( $blocksolid_gather->__isset( $key ) ){
				$post[ $key ] = $blocksolid_gather->__get( $key );
			}
		}

		$blocksolid_gather = $post;

	}

	$taxonomies = get_object_taxonomies($post_type);

	if (count($taxonomies)){
		$taxonomy = $taxonomies[0];
	}else{
		$taxonomy = 'catgeory';
	}

	if (!($categories)){

		$cats = get_the_terms($blocksolid_gather["ID"],$taxonomy);

/*			foreach ($cats as $index => $data) {
		    if ($data->slug == 'newsletter') {
		        unset($cats[$index]);
		    }
		}*/

		if (is_array($cats)){
			if (count($cats)){
				$cats = array_values($cats);
			}
		}

		$cat_slug = null;

	}else{

		$cats = explode(",", $categories);

	}

    $thumbnail_id = false;
   	$thumbnail_id = get_post_thumbnail_id($blocksolid_gather['ID']);

	// Get placeholder id (if any) if no associated featured image
	if ((!($thumbnail_id))&&($placeholder_image_id)){
		$thumbnail_id = $placeholder_image_id;
	}

	// Check for missing images:
	$attachment_post = get_post($thumbnail_id,'ARRAY_A');

	if (!(is_array($attachment_post))){
		$thumbnail_id = $placeholder_image_id;
	}

	// Check for a video
	$blocksolid_gather_video = get_post_meta( $blocksolid_gather['ID'], '_blocksolid_gather_video', true );

	// Check for a podcast
	$blocksolid_gather_podcast = get_post_meta( $blocksolid_gather['ID'], '_blocksolid_gather_podcast', true );

	$media_type = 'image';

	if ($blocksolid_gather_video){
		$media_type = 'video';
	}elseif($blocksolid_gather_podcast){
		$media_type = 'podcast';
	}

	$post_link = esc_url( get_permalink($blocksolid_gather['ID']));

	$excerpt = '';
	$src = '';
	$srcset = '';
	$image_width = '';
	$image_height = '';
	$media_caption = '';

	$random_token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 10)), 0, 10);
	$blocksolid_gather_token_id = $blocksolid_gather['ID'].'-'.$random_token; //Used to determine which post block is which when using js since potentially the same post may come up more than once.
	$media_block_content = '';

	$additional_figure_class = '';
	if ($media_hover){
		$additional_figure_class = 'blocksolid-gather-zoom-hover ';
	}

	$available_media_sizes = blocksolid_gather_get_all_image_sizes();

	switch ($media_size) {
		case "full" :
			$image_width = "";
			$image_height = "";
		break;
		default :

			if (!($media_size)){
				$media_size = 'thumbnail';
			}

			if (is_array($available_media_sizes)){
				$image_width 	= $available_media_sizes[$media_size]['width'];
				$image_height 	= $available_media_sizes[$media_size]['height'];
			}
		break;
	}

	switch ($media_type){

		case "video" :

			$video_type = '';

			if ($thumbnail_id){

				$srcarray = wp_get_attachment_image_src( $thumbnail_id, $media_size);
				if (is_array($srcarray)){
					$src = $srcarray[0];
				}else{
					$src = $placeholder_image_src;
				}
			}else{
				$src = $placeholder_image_src;
			}

			if (strpos($blocksolid_gather_video, 'vimeo.com') !== false){
				$video_type = 'vimeo';
				$blocksolid_gather_video = str_replace ('https://vimeo.com/','https://player.vimeo.com/video/',$blocksolid_gather_video.'?dnt=1&app_id=122963');
			}elseif(strpos($blocksolid_gather_video, 'youtu.be') !== false){
				$video_type = 'youtube';
				$blocksolid_gather_video = str_replace ('https://youtu.be/','https://www.youtube.com/embed/',$blocksolid_gather_video.'?rel=0');
			}elseif(strpos($blocksolid_gather_video, 'rumble.com') !== false){
				$video_type = 'rumble';
				$blocksolid_gather_video .= '#?secret='.$blocksolid_gather_token_id;
			}elseif(strpos($blocksolid_gather_video, 'dai.ly') !== false){
				$video_type = 'dailymotion';
				$blocksolid_gather_video = str_replace ('https://dai.ly/','https://www.dailymotion.com/embed/video/',$blocksolid_gather_video.'');
			}

			switch ($video_type){

				case 'vimeo' :

					$media_block_content .= '
						<figure class="wp-block-embed is-type-video is-provider-vimeo wp-block-embed-vimeo wp-embed-aspect-16-9 wp-has-aspect-ratio">
							<div class="wp-block-embed__wrapper">
								<iframe loading="lazy" title="'.$blocksolid_gather['post_title'].'" src="'.$blocksolid_gather_video.'" width="'.$image_width.'" height="'.$image_height.'" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
							</div>
						</figure>
					';

				break;

				case 'youtube' :

					$media_block_content .= '
						<figure class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio">
							<div class="wp-block-embed__wrapper">
								<iframe loading="lazy" title="'.$blocksolid_gather['post_title'].'" width="'.$image_width.'" height="'.$image_height.'" src="'.$blocksolid_gather_video.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
						</figure>
					';

				break;

				case 'rumble' :

					$media_block_content .= '
						<figure class="wp-block-embed is-type-wp-embed is-provider-rumble-com wp-block-embed-rumble-com">
							<div class="wp-block-embed__wrapper">
								<img class="blocksolid-gather-image" loading="lazy" src="'.$src.'" width="'.$image_width.'" height="'.$image_height.'" />
								<iframe sandbox="allow-scripts" security="restricted" title="'.$blocksolid_gather['post_title'].'" src="'.$blocksolid_gather_video.'" data-secret="'.$blocksolid_gather_token_id .'" style="display: block; margin: 0 auto;" frameborder="0"></iframe>
							</div>
						</figure>
					';

				break;

				case 'dailymotion' :

					$media_block_content .= '
						<figure class="wp-block-embed is-type-video is-provider-dailymotion wp-block-embed-dailymotion">
							<div class="wp-block-embed__wrapper">
								<img class="blocksolid-gather-image" loading="lazy" src="'.$src.'" width="'.$image_width.'" height="'.$image_height.'" />
								<iframe loading="lazy" title="'.$blocksolid_gather['post_title'].'" frameborder="0" width="'.$image_width.'" height="'.$image_height.'" src="'.$blocksolid_gather_video.'" allowfullscreen allow="autoplay"></iframe>
							</div>
						</figure>
					';

				break;


				default :

					$media_block_content .= '<p>Video type not supported</p>';

				break;

			}

		break;

		case "podcast" :

			$alt_text = $blocksolid_gather['post_title'];
			$alt_title = '';

			if ($thumbnail_id){

				$srcarray = wp_get_attachment_image_src( $thumbnail_id, $media_size);
				if (is_array($srcarray)){
					$src = $srcarray[0];
				}else{
					$src = $placeholder_image_src;
				}
			}else{
				$src = $placeholder_image_src;
			}

			$media_block_content .= '
				<figure class="wp-block-audio blocksolid-gather-audio-figure blocksolid-gather-figure '.$additional_figure_class.'">
					<img class="blocksolid-gather-image" style="padding: 0; margin: 0;" loading="lazy" width="100%" height="auto" src="'.$src.'" alt="'.$alt_text.'" title="'.$alt_title.'" srcset="'.$srcset.'" />
					<audio controls src="'.$blocksolid_gather_podcast.'" class="blocksolid-gather-audio-controls"></audio>
				</figure>
			';
		break;

		case "image" : default :

			$alt_text = $blocksolid_gather['post_title'];
			$media_caption = $blocksolid_gather['post_title'];
			$alt_title = '';

			if ($thumbnail_id){

				$srcarray = wp_get_attachment_image_src( $thumbnail_id, $media_size);
				if (is_array($srcarray)){
					$src = $srcarray[0];
				}else{
					$src = $placeholder_image_src;
				}
				$srcset = wp_get_attachment_image_srcset( get_post_thumbnail_id($blocksolid_gather['ID']), $media_size, true );

				$attachment = get_post($thumbnail_id);

				if (is_array($attachment)){

					$alt_text   = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
					$alt_title = $attachment->post_title;

					if ($show_media_caption){
						$media_caption = $attachment->post_excerpt;
						$media_caption = do_blocks(apply_filters('the_content', $media_caption));
					}

				}

			}else{
				$src = $placeholder_image_src;
			}

			$media_block_content .= '<figure class="wp-block-image '.$additional_figure_class.'blocksolid-gather-figure alignfull size-'.$media_size.'"><img class="blocksolid-gather-image" loading="lazy" src="'.$src.'" alt="'.$alt_text.'" title="'.$alt_title.'" srcset="'.$srcset.'" />';
			if ($show_media_caption){
				if ($show_figcaption_link){
					$media_block_content .= '<a href="'.$post_link.'">';
				}
				$media_block_content .= '<figcaption>'.$media_caption.'</figcaption>';
				if ($show_figcaption_link){
					$media_block_content .= '</a>';
				}
			}
			$media_block_content .= '</figure>';

		break;

	}

	$blocksolid_gather_content = '';

	if ($emulate_mobile){
		$id_string = 'postblockinnermob-'.$blocksolid_gather_token_id;
	}else{
		$id_string = 'postblockinner-'.$blocksolid_gather_token_id;
	}

	if (has_excerpt($blocksolid_gather['ID'])){
		$full_excerpt = wpautop(get_the_excerpt($blocksolid_gather['ID']));
	}else{
		$full_excerpt = "";
	}

	if ($excerpt_length == "content"){

		$excerpt = '<div class="blocksolid-gather-content-block-inner"><div>'.wpautop($blocksolid_gather['post_content']).'</div></div>';

	}elseif ($excerpt_length == "none"){

		$excerpt = false;

	}elseif ($excerpt_length == "full"){

		$excerpt = $full_excerpt;

		if ($excerpt == ""){

			// 16/10/23
			$excerpt = apply_filters( 'the_content', $blocksolid_gather['post_content'] );
			//	$excerpt = wpautop($blocksolid_gather['post_content']);

		}

	}else{

		$excerpt = wpautop(wp_trim_words( get_the_excerpt($blocksolid_gather['ID']), $excerpt_length, '<span class="blocksolid-gather-excerpt-end">...</span>' )).'';

		if ($excerpt == ""){
			$excerpt = wpautop(wp_trim_words( $blocksolid_gather['post_content'], $excerpt_length, '<span class="blocksolid-gather-excerpt-end">...</span>' )).'';
		}

		/*if ($excerpt == ""){
			$excerpt = '&nbsp;';
		}*/

        if ($excerpt){
            $excerpt .= ' <a class="blocksolid-gather-excerpt-signoff" href="'.$post_link.'">'.$excerpt_signoff.'</a>';
        }

	}

	//Build column start
	$column_start = '<div class="wp-block-column blocksolid-gather-inner-column">';

	//Build column end
	$column_end = '</div>';

	//Build row start
	$row_start = '<div class="wp-block-columns blocksolid-gather-inner-row">';

	//Build row end
	$row_end = '</div>';

	//Build Title
	$title_block = '';
	$title_block .= '<div class="blocksolid-gather-title-block">';
	if ($blocksolid_gather["ID"] != $current_post_id){
		$title_block .= '<a href="'.$post_link.'">';
	}
	$title_block .= '<h3>'.blocksolid_gather_truncate_string($blocksolid_gather['post_title'], $truncate_title_to).'</h3>';
	if ($blocksolid_gather["ID"] != $current_post_id){
		$title_block .= '</a>';
	}
	$title_block .= '</div>';

	//Build author block
    if ($show_author){
	    $author_id = $blocksolid_gather['post_author'];
	   	$author_block = '<div class="blocksolid-gather-author"><span>By </span><a href="'.get_author_posts_url( $author_id, get_the_author_meta('user_nicename',$author_id) ).'">'.get_the_author_meta( 'display_name', $author_id ).'</a></div>';
	}

	//Build tags block
    if ($show_tags){
	    $tags_list = "";

	    $tags_this_post = get_the_tags($blocksolid_gather["ID"]);

	    if (is_array($tags_this_post)){

	        if (count($tags_this_post)){

	            $tags_list = '<span class="blocksolid-gather-tags-label">Tags </span>';

	    		foreach ($tags_this_post as $tag_found){
	       			$tag_found_array = (array)$tag_found;
	               	$tags_list .= '<span class="blocksolid-gather-tag"><a href="'.get_tag_link($tag_found_array['term_id']).'">'.$tag_found_array['name'].'</a></span>&nbsp;';
	    		}
	        }
	    }
		$tags_block = '<div class="blocksolid-gather-tags">'.$tags_list.'</div>';
	}

	//$taxonomy = 'category';

	//Build categories block
    if ($show_categories){
	    $categories_list = "";

	    $categories_this_post = get_the_terms($blocksolid_gather["ID"],$taxonomy);

	    if (is_array($categories_this_post)){
	        if (count($categories_this_post)){

	            $categories_list .= '<span class="blocksolid-gather-categories-label">Categories </span>';

	    		foreach ($categories_this_post as $category_found){
	    			$category_found_array = (array)$category_found;
	               	$categories_list .= '<span class="blocksolid-gather-category"><a href="'.get_term_link($category_found_array['term_id']).'">'. $category_found_array['name'].'</a></span>&nbsp;';
	    		}
	        }
	    }
		$categories_block = '<div class="blocksolid-gather-categories">'.$categories_list.'</div>';
	}

	// Build date created block
	$date_created_block = '';
	$y = get_the_date('Y',$blocksolid_gather['ID']);
	$m = get_the_date('m',$blocksolid_gather['ID']);
	$d = get_the_date('d',$blocksolid_gather['ID']);
	$day_link = get_day_link( $y, $m, $d );
	$date_created_block .= '<div class="blocksolid-gather-post-date"><span class="blocksolid-gather-post-date-date"><span>Posted </span><a href="'.$day_link.'">'.get_the_date('',$blocksolid_gather['ID']).'</a></span> <span class="blocksolid-gather-post-time">'.get_the_time('',$blocksolid_gather['ID']).'</span></div>';


	// Build meta block
	$meta_block = '';

	if (($show_date_created) || ($show_author) || ($show_categories) || ($show_tags)){
		$meta_block .= '<div class="blocksolid-gather-meta-block">';
	}

    if ($show_date_created){
		$meta_block .= $date_created_block;
    }

    if ($show_author){
		$meta_block .= $author_block;
    }

    if ($show_categories){
		$meta_block .= $categories_block;
    }

    if ($show_tags){
		$meta_block .= $tags_block;
    }

	if (($show_date_created) || ($show_author) || ($show_categories) || ($show_tags)){
		$meta_block .= '</div>';
	}

	//Build additional full excerpt block (optional)
	$additional_full_excerpt_block = '<div class="blocksolid-gather-additional_full_excerpt-block">'.$full_excerpt.'</a></div>';

	// Build image block
	$media_block = '';
	if ($show_media_link){
		$media_block .= '<a href="'.$post_link.'">';
	}
	$media_block .= '<div class="blocksolid-gather-figure-container">';
	$media_block .= $media_block_content;
	$media_block .= '</div>';

	if ($show_media_link){
		$media_block .= '</a>';
	}

	// Build spacer block
	$spacer_block = '';
	$spacer_block .= '<div style="height:1em;" aria-hidden="true" class="wp-block-spacer blocksolid-gather-spacer"></div>';

	// Build content block -------------------------------------------------------------
	$content_block = '';

	$meta_shown = false;

	$content_block .= '<div class="blocksolid-gather-content-block">';

	if (!($move_title_above)){

		if (($move_meta_above_title)){
			$content_block .= $meta_block;
			$meta_shown = true;
		}

		$content_block .= $title_block;
	}

	if ((($move_meta_above))&&(!($move_meta_above_title))){
		$content_block .= $meta_block;
		$meta_shown = true;
	}

	if (!($move_meta_above)){
		if ($show_additional_full_excerpt){
			$content_block .= $additional_full_excerpt_block;
		}
		if ($excerpt){
			$content_block .= $excerpt;
			$content_block .= $spacer_block;
		}
	}

	if ($move_meta_above){
		if ($show_additional_full_excerpt){
			$content_block .= $additional_full_excerpt_block;
		}
		$content_block .= $excerpt;
	}

	if ((!($move_meta_above))&&(!($move_meta_above_title))){
		$content_block .= $meta_block;
		$meta_shown = true;
	}

	$content_block .= '</div>';

	// ----------------------------------------------------------------------------------

	switch ($media_position) {

		case "top" : default :

			$blocksolid_gather_content .= $column_start;
			if ($move_title_above){
				if ((!($meta_shown))&&(($move_meta_above_title))){
					$blocksolid_gather_content .= $meta_block;
				}
				$blocksolid_gather_content .= $title_block;
			}
			$blocksolid_gather_content .= $media_block;
			if (!($show_media_only)){
				$blocksolid_gather_content .= $spacer_block;
				$blocksolid_gather_content .= $content_block;
			}
			$blocksolid_gather_content .= $column_end;

		break;

		case "right" :

			$blocksolid_gather_content .= $column_start;

			if ($move_title_above){
				$blocksolid_gather_content .= $title_block;
			}

			$blocksolid_gather_content .= $row_start;

			if (!($show_media_only)){
				$blocksolid_gather_content .= $column_start;
				$blocksolid_gather_content .= $content_block;
				$blocksolid_gather_content .= $column_end;
			}

			$blocksolid_gather_content .= $column_start;
			$blocksolid_gather_content .= $media_block;
			$blocksolid_gather_content .= $column_end;
			$blocksolid_gather_content .= $row_end;
			$blocksolid_gather_content .= $column_end;

		break;

		case "bottom" :

			$blocksolid_gather_content .= $column_start;

			if ($move_title_above){
				$blocksolid_gather_content .= $title_block;
			}

			if (!($show_media_only)){
				$blocksolid_gather_content .= $content_block;
				$blocksolid_gather_content .= $spacer_block;
			}
			$blocksolid_gather_content .= $media_block;
			$blocksolid_gather_content .= $column_end;


		break;

		case "left" :

			$blocksolid_gather_content .= $column_start;

			if ($move_title_above){
				$blocksolid_gather_content .= $title_block;
			}

			$blocksolid_gather_content .= $row_start;
			$blocksolid_gather_content .= $column_start;
			$blocksolid_gather_content .= $media_block;
			$blocksolid_gather_content .= $column_end;

			if (!($show_media_only)){
				$blocksolid_gather_content .= $column_start;
				$blocksolid_gather_content .= $content_block;
				$blocksolid_gather_content .= $column_end;
			}
			$blocksolid_gather_content .= $row_end;
			$blocksolid_gather_content .= $column_end;

		break;

		case "none" :
			$blocksolid_gather_content .= $column_start;
			$blocksolid_gather_content .= $content_block;
			$blocksolid_gather_content .= $column_end;
		break;


	}

	if (is_numeric($blog_id)){
		restore_current_blog(); //Multisite
	}

	return ($blocksolid_gather_content);
}

function blocksolid_gather_truncate_string($string, $amount) {
	if (!(is_array($string))){
		if(strlen($string) > $amount){
			$string = trim(substr($string, 0, $amount))."...";
		}
	}
	return $string;
}

function blocksolid_gather($max_posts,$first_post,$categories,$excluded_categories,$tags,$number_per_row,$order_by,$ascending,$ignore_sticky,$get_related,$site,$specificposttitle,$specificpostid,$post_type,$media_position,$media_size,$excerpt_length,$excerpt_signoff,$placeholder_image_src,$placeholder_image_id,$show_media_only,$show_media_caption,$show_media_link,$move_title_above,$move_meta_above,$move_meta_above_title,$show_additional_full_excerpt,$media_hover,$show_figcaption_link,$hide_margins,$final_row_pad_empty,$show_date_created,$show_author,$show_categories,$show_tags,$current_post_id){

    if (!($post_type)){
        $post_type = 'post';
    }

	$blog_id = false;

	if ($site != ""){
		if ($site == 'root'){
			$blog_id = get_blog_id_from_url($_SERVER['HTTP_HOST'],'/');
		}else{
			$blog_id = get_blog_id_from_url($_SERVER['HTTP_HOST'],'/'.$site.'/');
		}
	}

	if (is_numeric($blog_id)){
		switch_to_blog($blog_id); //Multisite
	}

	if ($ascending == "yes"){
		$ascending = 'ASC';
	}else{
		$ascending = 'DESC';
	}

	$primary_category_id = "";

	if (is_numeric($specificpostid)){
		$db_blocksolid_gather = get_post($specificpostid, ARRAY_A);
		if (is_array($db_blocksolid_gather)){
			if (count($db_blocksolid_gather)){
				$db_blocksolid_gather = array($db_blocksolid_gather);
			}
		}

		// For the category page
		if (isset($category)){
			if ($category != ""){
				$tmp_cats = explode(",", $category);
				$primary_category_id = $tmp_cats[0];
			}
		}

	}elseif ($specificposttitle){
		$db_blocksolid_gather = blocksolid_gather_by_title_with_feedback(trim($specificposttitle), 'OBJECT_A', $post_type);
		if (is_object($db_blocksolid_gather)){
			$db_blocksolid_gather = array($db_blocksolid_gather);
		}
	}else{

		$taxonomies = get_object_taxonomies($post_type);

		if (count($taxonomies)){
			$taxonomy = $taxonomies[0];
		}else{
			$taxonomy = 'catgeory';
		}


        // NB. Changed 'numberposts' to 'posts_per_page' 23/12/21
		$args = array('posts_per_page' => $max_posts, 'offset' => ($first_post - 1), 'post_status' => 'publish', 'post_type' => $post_type, 'orderby' => $order_by, 'order' => $ascending);

		if ($ignore_sticky){
			$args['ignore_sticky_posts'] = 1;
		}

        global $post;

        $args['post__not_in'] = array($post->ID);

        if ($get_related){
            $categories = the_terms($post->ID,$post_type);
            $tags = get_the_tags($post->ID);
        }

		if ($categories != ""){
			$cats = explode(",", $categories);
			$args['tax_query'] = array(array(
	            'taxonomy' => $taxonomy,   		// taxonomy name
	            'field' => 'term_id',           // term_id, slug or name
	            'terms' => $cats,               // term id, term slug or term name
		    ));
		}

		if ($tags != ""){
			$the_tags = explode(",", $tags);
			$args['tag__in'] = $the_tags;
		}

		$tmp_excluded_categories = "";
		$tmp_excluded_categories_unsigned = "";

		if ($excluded_categories){

			$excluded_categories_array = explode(",", $excluded_categories);

			if (is_array($excluded_categories_array)){

				$args['tax_query'] = array(array(
		            'taxonomy' => $taxonomy,   						// taxonomy name
		            'field' => 'term_id',           				// term_id, slug or name
		            'terms' => $excluded_categories_array,   // term id, term slug or term name
					'operator' => 'NOT IN',
			    ));

			}
		}

		$db_blocksolid_gather = get_posts($args,ARRAY_A);

        wp_reset_query();

	}

	$blocksolid_gather_posts = '';

	if (is_array($db_blocksolid_gather)){

		if (count($db_blocksolid_gather)){

			$total_posts = count($db_blocksolid_gather);

			if ($show_media_only){
				$show_media_only_class = 'blocksolid-gather-show-media-only';
			}else{
				$show_media_only_class = '';
			}

			if ($hide_margins){
				$hide_margins_class = 'blocksolid-gather-hide-margins';
			}else{
				$hide_margins_class = '';
			}

			if ($final_row_pad_empty){
				$final_row_pad_empty_class = 'blocksolid-gather-final-row-padded';
			}else{
				$final_row_pad_empty_class = '';
			}

			$blocksolid_gather_cell_count = 0;

			$number_per_row_choices = array('zero','one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten');

			if ($number_per_row){
				$number_per_row_handle = $number_per_row_choices[$number_per_row];
			}else{
				$number_per_row_handle  = 'one';
			}

			$blocksolid_gather_post_row = '<div class="wp-block-columns blocksolid-gather-container blocksolid-gather-number-per-row-'.$number_per_row_handle.' blocksolid-gather-post-type-'.$post_type.' blocksolid-gather-media-position-'.$media_position.' blocksolid-gather-media-size-'.$media_size.' '.$show_media_only_class.' '.$hide_margins_class.' '.$final_row_pad_empty_class.'">';

			if ($number_per_row > 1){
				$blocksolid_gather_posts .= $blocksolid_gather_post_row;
			}

			foreach ($db_blocksolid_gather as $blocksolid_gather){

				if ($number_per_row == 1){
					$blocksolid_gather_posts .= $blocksolid_gather_post_row;
				}

				$blocksolid_gather_posts .= get_blocksolid_gather_content($blocksolid_gather,$number_per_row,$order_by,$categories,$excluded_categories,$tags,$primary_category_id,$post_type,$site,$media_position,$media_size,$excerpt_length,$excerpt_signoff,$placeholder_image_src,$placeholder_image_id,$show_media_only,$show_media_caption,$show_media_link,$move_title_above,$move_meta_above,$move_meta_above_title,$show_additional_full_excerpt,$media_hover,$show_figcaption_link,$hide_margins,$final_row_pad_empty,$show_date_created,$show_author,$show_categories,$show_tags,$current_post_id);

				if ($number_per_row == 1){
					$blocksolid_gather_posts .= '</div>';
				}

				$blocksolid_gather_cell_count++;

				// Start another row if we have shown enough columns
				if ($number_per_row > 1){
					if (($blocksolid_gather_cell_count > 1)&&($blocksolid_gather_cell_count % $number_per_row == 0)){
						$blocksolid_gather_posts .= '</div>';
						$blocksolid_gather_posts .= $blocksolid_gather_post_row;
					}
				}
			}

			if ($number_per_row > 1){
				if ($final_row_pad_empty){

					if (($blocksolid_gather_cell_count > 1)&&($blocksolid_gather_cell_count % $number_per_row != 0)){

						$number_of_complete_rows = intval($blocksolid_gather_cell_count / $number_per_row);
						$empty_cells_to_produce = ((($number_per_row + ($number_of_complete_rows * $number_per_row))) - $blocksolid_gather_cell_count);

						for ($x = 1; $x <= $empty_cells_to_produce; $x++) {
						  	$blocksolid_gather_posts .= '<div class="wp-block-column blocksolid-gather-empty-column">&nbsp;</div>';
						}

					}

				}
			}
			if ($number_per_row > 1){
				$blocksolid_gather_posts .= '</div>';
			}

		}else{

			$blocksolid_gather_posts .= '';
		}
	}

	if (is_numeric($blog_id)){
		restore_current_blog(); //Multisite
	}

	return($blocksolid_gather_posts);
}

function get_blocksolid_gather_via_shortcode($atts = array(), $content = null){
	$max_posts 		= (isset($atts['max_posts'])) ? $atts['max_posts'] : false;
	$first_post 	= (isset($atts['first_post'])) ? $atts['first_post'] : false;
	$categories 	= (isset($atts['categories'])) ? $atts['categories'] : false;
	$excluded_categories 	= (isset($atts['excluded_categories'])) ? $atts['excluded_categories'] : false;
	$tags 			= (isset($atts['tags'])) ? $atts['tags'] : false;
	$number_per_row = (isset($atts['number_per_row'])) ? $atts['number_per_row'] : false;
	$ascending		= (isset($atts['ascending'])) ? $atts['ascending'] : false;
	$ignore_sticky	= (isset($atts['ignore_sticky'])) ? $atts['ignore_sticky'] : false;
	$get_related	= (isset($atts['get_related'])) ? $atts['get_related'] : false;
	$order_by		= (isset($atts['order_by'])) ? $atts['order_by'] : false;
	$site 			= (isset($atts['site'])) ? $atts['site'] : false;
	$specificposttitle	= (isset($atts['specificposttitle'])) ? $atts['specificposttitle'] : false;
	$specificpostid	= (isset($atts['specificpostid'])) ? $atts['specificpostid'] : false;
	$post_type		= (isset($atts['post_type'])) ? $atts['post_type'] : false;
	$media_position	= (isset($atts['media_position'])) ? $atts['media_position'] : false;
	$media_size		= (isset($atts['media_size'])) ? $atts['media_size'] : false;
	$excerpt_length		= (isset($atts['excerpt_length'])) ? $atts['excerpt_length'] : false;
	$excerpt_signoff	= (isset($atts['excerpt_signoff'])) ? $atts['excerpt_signoff'] : false;
	$placeholder_image_src	= (isset($atts['placeholder_image_src'])) ? $atts['placeholder_image_src'] : false;
	$placeholder_image_id	= (isset($atts['placeholder_image_id'])) ? $atts['placeholder_image_id'] : false;
	$show_media_only	= (isset($atts['show_media_only'])) ? $atts['show_media_only'] : false;
	$show_media_caption	= (isset($atts['show_media_caption'])) ? $atts['show_media_caption'] : false;
	$show_media_link	= (isset($atts['show_media_link'])) ? $atts['show_media_link'] : false;
	$move_title_above	= (isset($atts['move_title_above'])) ? $atts['move_title_above'] : false;
	$move_meta_above	= (isset($atts['move_meta_above'])) ? $atts['move_meta_above'] : false;
	$move_meta_above_title	= (isset($atts['move_meta_above_title'])) ? $atts['move_meta_above_title'] : false;
	$show_additional_full_excerpt	= (isset($atts['show_additional_full_excerpt'])) ? $atts['show_additional_full_excerpt'] : false;
	$media_hover	= (isset($atts['media_hover'])) ? $atts['media_hover'] : false;
	$show_figcaption_link	= (isset($atts['show_figcaption_link'])) ? $atts['show_figcaption_link'] : false;
	$hide_margins	= (isset($atts['hide_margins'])) ? $atts['hide_margins'] : false;
	$final_row_pad_empty	= (isset($atts['final_row_pad_empty'])) ? $atts['final_row_pad_empty'] : false;
	$show_date_created	= (isset($atts['show_date_created'])) ? $atts['show_date_created'] : false;
	$show_author	= (isset($atts['show_author'])) ? $atts['show_author'] : false;
	$show_categories	= (isset($atts['show_categories'])) ? $atts['show_categories'] : false;
	$show_tags	= (isset($atts['show_tags'])) ? $atts['show_tags'] : false;
	$current_post_id	= (isset($atts['current_post_id'])) ? $atts['current_post_id'] : false;
	return blocksolid_gather($max_posts,$first_post,$categories,$excluded_categories,$tags,$number_per_row,$order_by,$ascending,$ignore_sticky,$get_related,$site,$specificposttitle,$specificpostid,$post_type,$media_position,$media_size,$excerpt_length,$excerpt_signoff,$placeholder_image_src,$placeholder_image_id,$show_media_only,$show_media_caption,$show_media_link,$move_title_above,$move_meta_above,$move_meta_above_title,$show_additional_full_excerpt,$media_hover,$show_figcaption_link,$hide_margins,$final_row_pad_empty,$show_date_created,$show_author,$show_categories,$show_tags,$current_post_id);
}

add_shortcode('blocksolid_gather','get_blocksolid_gather_via_shortcode');

?>