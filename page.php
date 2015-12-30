<?php
/*
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>


							<?php // LOGIC FOR FEATURE IMAGE / CAROUSEL / NONE //echo do_shortcode('[images_carousel fill="true"]' );
							
							$terms = get_the_terms( get_the_id(), 'media-tags' );

							if ($terms && count($terms) > 0) { // we have a media tag attached.  That means they want a carousel - get the images for that


								$term_array = array();

								foreach ($terms as $term) {
									$term_array[] = $term->slug;								
								}
								$atts = 
								array(
									'tag' => implode(',', $term_array),
									'fill' => true
								);

								?>
								<div id="carousel" class='carousel'>  

								<?php echo display_attached_images_carousel($atts, false); ?>

								</div>

							<?php } elseif ( has_post_thumbnail() ) { // featured image ?>
														
													
								<div id="carousel" class='page-featured-image'>
							
									<?php echo responsive_image_thumbnail(null, 'panorama'); ?>

								</div>




							<?php } ?>

							<?php 

							$custom_content = get_post_meta( get_the_id(), 'custom_content', true );

							if ( $custom_content ) {


								$parts = explode("|", trim($custom_content));
							
								echo "<div class='custom-subheading'>";
								foreach ($parts as $part) {
									echo "<span>" . $part . "</span>";
								}
								echo "</div>";
							}

							?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

				
<?php get_template_part( 'content/page' ); ?>


						<?php // get_sidebar(); ?>


				</div>

				

			</div>
		


<div class="menu-wrapper">

<?php
$args = array(
	'post_type' => 'post',
	'order' => 'DESC'
);


	// Custom query.
$query = new WP_Query( $args );
 
// Check that we have query results.
if ( $query->have_posts() ) {
 
    // Start looping over the query results.
    while ( $query->have_posts() ) {
 
        $query->the_post();
        echo '<div class="menu-container">';
	 		echo '<div class="img-container">';
	 		the_post_thumbnail();
 			echo '</div>';
 		echo '<div class="menu-name">'.get_the_title().'</div>';

 		echo '</div>';
        // Contents of the queried post results go here.
        
 
    }
 
}
 
// Restore original post data.
wp_reset_postdata();

?>

</div>


<?php get_footer(); ?>
