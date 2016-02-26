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
		

<div class="entry">
		

<div class="menu-wrapper">

<h2><span>A quick glance at our menu</span></h2>

<?php
$args = array(
	'post_type' => 'page',
	'post_parent' => '145',
	'order' => 'DESC',
	'posts_per_page' => 4
);


	// Custom query.
$query = new WP_Query( $args );
 
// Check that we have query results.
if ( $query->have_posts() ) {
 
    // Start looping over the query results.
    while ( $query->have_posts() ) {
 
        $query->the_post(); 
        ?>
        <a href="<?php the_permalink(); ?>"><div class='menu-container'>
        <?php
	 		echo '<div class="img-container">';
	 		the_post_thumbnail();
	 		echo '<div class="menu-name">'.get_the_title().'</div>';
 			echo '</div></a>';
 		

 		echo '</div>';

        // Contents of the queried post results go here.
        
 
    }
 
}
 
	// Restore original post data.
	wp_reset_postdata();

		?>

	</div>
</div>

<div class="fullmenu-btn"><a href="#">View Full Menu</a></div>


<div class="upcoming-events-wrapper">
		
<div class="event-wrapper">

		<?php
$args = array(
	'post_type' => 'event',
	'order' => 'DESC'
);


	// Custom query.
$query = new WP_Query( $args );
 
// Check that we have query results.
if ( $query->have_posts() ) { ?>

	<h2>Upcoming Events</h2>

	<?php
 
    // Start looping over the query results.
    while ( $query->have_posts() ) {
 
        $query->the_post();
        echo '<div class="event-wrap">';
        echo '<div class="event-container">';
	 		echo '<div class="img-container">';
	 		the_post_thumbnail();
 			echo '</div>';
 		echo '</div>';

 		echo '<div class="event-title-container">';
 			echo '<div class="menu-name">'.get_the_title().'</div>';
 			echo '<div class="event-description"><div>'.the_excerpt().'</div></div>';
 		echo '</div>';
 		echo '</div>';
        // Contents of the queried post results go here.
        
 
    }
 
} else {
	echo " ";
}
 
// Restore original post data.
wp_reset_postdata();

?>

</div>
</div>


<?php get_footer(); ?>
