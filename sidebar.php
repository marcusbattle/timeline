<div id="sidebar">
	<h1><?php echo bloginfo(); ?></h1>
	<p class="site-description"><?php echo bloginfo('description'); ?></p>
	<?php $locations = get_nav_menu_locations(); ?>
	<?php foreach( array( 'main_menu', 'social_menu', 'contact_menu' ) as $menu_location ): ?>
		<?php if ( array_key_exists( $menu_location, $locations ) ): ?>
			<?php $menu = wp_get_nav_menu_object( $locations[ $menu_location ] ); ?>
			<?php if ( isset( $menu->term_id ) ): ?>
				<div class="menu">
					<h2><?php echo $menu->name; ?></h2>
					<ul class="menu">
						<?php foreach( wp_get_nav_menu_items( $menu->term_id ) as $menu_item ): ?>
							<?php 
								$font_awesome_icon = '';
								$classes = implode( ' ', $menu_item->classes );

								foreach( $menu_item->classes as $class ) {
									if ( stripos( $class, 'fa-' ) === 0 ) {
										$font_awesome_icon = "<i class=\"fa $class\"></i> ";
										$classes = str_ireplace( $class . ' ', '', $classes );
										continue;
									}
								}
								
							?>
							<li><a href="<?php echo $menu_item->url ?>" class="<?php echo $classes ?>"><?php echo $font_awesome_icon . $menu_item->title ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
	<p class="copyright">&copy; <?php echo date('Y'); ?> <?php echo bloginfo(); ?>.<br /> All Rights Reserved.</p>
</div>