<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body>
	<div class="container">
		<div id="timeline">
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
					<div class="meta">
						<span class="gravatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 24 ); ?></span>
						<p><span class="highlight"><?php the_author(); ?></span> posted this <span class="highlight"><?php echo get_post_format(); ?></span> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></p>
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