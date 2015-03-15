<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body>
	<div class="container">
		<div id="timeline">
			<div id="mobile-header" class="mobile-view">
				<h1><?php echo bloginfo(); ?></h1>
				<p class="site-description"><?php echo bloginfo('description'); ?></p>
			</div>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="content">
						<?php 

						$thumbnail_id = get_post_thumbnail_id();
						$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, 'large' );
						$thumbnail_url = $thumbnail_url_array[0];

						if ( $thumbnail_url ):
						?>
							<div class="thumbnail" style="background-image: url(<?php echo $thumbnail_url; ?>);"></div>
						<?php endif; ?>
						<h2><?php the_title(); ?></h2>
						<div class="text"><?php the_content(); ?></div>
						<div class="tags hide"><?php the_tags(); ?></div>
						<div class="comment hide">
							<input type="text" placeholder="Leave a comment" />
						</div>
						<div class="actions hide"><a href="#">Get More Info</a></div>
					</div>
				</div>
			<?php endwhile; else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</body>

<?php wp_footer(); ?>