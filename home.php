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
			<?php if ( is_user_logged_in() ): ?>
				<div class="post create-new">
					<div class="content">
						<div class="thumbnail hide"></div>
						<div class="text">
							<textarea id="post-text" rows="2" placeholder="Say something dope!"></textarea>
						</div>
						<div class="new-post-menu">
							<ul>
								<li><button id="post-button">Post</button></li>
								<li>
									<a href="#" class="add-image"><i class="fa fa-camera"></i></a>
								</li>
								<!-- <li><i class="fa fa-video-camera"></i></li> -->
							</ul>
							<form id="feature-image-uploader" class="hide">
								<input type="file" id="featured-image-input" accept="image/*" />
								<input type="hidden" id="base64" />
							</form> 
						</div>
					</div>
					<div class="meta">
						<div class="title-area hide">
							<p>Enter a title (optional)</p>
						</div>
					</div>
				</div>
			<?php endif; ?>
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