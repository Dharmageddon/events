<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscores
 */

get_header();
?>

<div class="container">
<div id="primary" class="content-area">
<main id="main" class="site-main">

	<header class="entry-header"><h1 class="entry-title">Events</h1></header><!-- .entry-header -->

		<div class='table-responsive'>
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th scope="col text-center">Date</th>
						<th scope="col">Time</th>
						<th scope="col text-center">Location</th>
						<th scope="col text-center"></th>
					</tr>
				</thead>
				<tbody>

				<?
				$category_name = 'event';

				$args = array('posts_per_page' => 8, 'category_name' => $category_name, 'paged' => 1, 'post_type' => 'post', 'post_status' => 'publish' );

				// The Query
				//$the_query = new WP_Query( $args );

				$the_query = new WP_Query(array(
					'post_type'			=> 'post',
					'posts_per_page'		=> -1,
					'meta_key'			=> 'event_date',
					'orderby'			=> 'meta_value',
					'order'				=> 'ASC'
				));

				// The Loop
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
				?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<?php $location = get_field('event_location'); ?>

							<tr>
								<td class="align-middle"><?php the_field('event_date'); ?></td>
								<td class="align-middle"><?php the_field('event_time'); ?></td>
								<td class="align-middle"><?php the_field('event_host'); ?> -- <?php echo $location['address']; ?></td>
								<td class="align-middle"><a class="btn btn-outline-primary" href='<?php the_permalink(); ?>'>Register!</a></td>
							</tr>

						</article><!-- #post-<?php the_ID(); ?> -->
				<?
					}
					/* Restore original Post Data */
					wp_reset_postdata();
				} else {
					// no posts found
				}
				?>

			</tbody>
		</table>
	</div>


</main><!-- #main -->
</div><!-- #primary -->
</div>

<?php
//get_sidebar();
get_footer();
