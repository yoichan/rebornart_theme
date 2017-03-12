<?php if ( is_active_sidebar( 'footer-a' ) || is_active_sidebar ('footer-b') || is_active_sidebar ('footer-c') ) : ?>

<div class="footer section medium-padding bg-graphite">
	
	<div class="section-inner row">
	
		<?php if ( is_active_sidebar( 'footer-a' ) ) : ?>
		
			<div class="column column-1 one-third">
			
				<div class="widgets">
		
					<?php dynamic_sidebar( 'footer-a' ); ?>
										
				</div>
				
			</div>
			
		<?php else : ?>
		
			<div class="column column-1 one-third">
			
				<div class="widgets">
			
					<div id="search" class="widget widget_search">
					
						<div class="widget-content">
						
							<h3 class="widget-title"><?php _e( 'Search form', 'baskerville' ); ?></h3>
			                <?php get_search_form(); ?>
			                
						</div>
						
	                </div>
									
				</div>
				
			</div>
			
		<?php endif; ?> <!-- /footer-a -->
			
		<?php if ( is_active_sidebar( 'footer-b' ) ) : ?>
		
			<div class="column column-2 one-third">
			
				<div class="widgets">
		
					<?php dynamic_sidebar( 'footer-b' ); ?>
										
				</div> <!-- /widgets -->
				
			</div>
			
		<?php else : ?>
		
			<div class="column column-2 one-third">
			
				<div class="widgets">
				
					<div class="widget widget_recent_entries">
					
						<div class="widget-content">
						
							<h3 class="widget-title"><?php _e( 'Latest posts', 'baskerville' ); ?></h3>
							
							<ul>
				                <?php
									$args = array( 'numberposts' => '5', 'post_status' => 'publish' );
									$recent_posts = wp_get_recent_posts( $args );
									foreach( $recent_posts as $recent ){
										echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a> </li> ';
									}
								?>
							</ul>
			                
						</div>
						
	                </div>
									
				</div> <!-- /widgets -->
				
			</div>
			
		<?php endif; ?> <!-- /footer-b -->
							
		<?php if ( is_active_sidebar( 'footer-c' ) ) : ?>
		
			<div class="column column-3 one-third">
		
				<div class="widgets">
		
					<?php dynamic_sidebar( 'footer-c' ); ?>
										
				</div> <!-- /widgets -->
				
			</div>
			
		<?php else : ?>
		
			<div class="column column-3 one-third">
			
				<div id="meta" class="widget widget_text">
					<div class="widget-content">
					
						<h3 class="widget-title"><?php _e( "Text widget", "baskerville" ); ?></h3>
						<p><?php _e( "These widgets are displayed because you haven't added any widgets of your own yet. You can do so at Appearance > Widgets in the WordPress settings.", "baskerville" ); ?></p>
		                
					</div>
                </div>
								
			</div>
			
		<?php endif; ?> <!-- /footer-c -->
		
		<div class="clear"></div>
	
	</div> <!-- /footer-inner -->

</div> <!-- /footer -->

<?php endif; ?>

<div class="credits section bg-dark medium-padding">

	<div class="credits-inner section-inner">

		<p class="credits-left fleft">
		
			<span>Copyright&copy; 日本ふるさと手しごと協会 All rights reserved.</span>
		
		</p>
		
		<div class="clear"></div>
	
	</div> <!-- /credits-inner -->
	
</div> <!-- /credits -->

<?php wp_footer(); ?>

<script type="text/javascript">
    (function($){ $(function(){
        $('a[href^="#"]').click(function(){
            var speed = 500;
            var href= $(this).attr("href");
            var target = $(href == "#" || href == "" ? 'html' : href);
            var position = target.offset().top;
            $("html, body").animate({scrollTop:position}, speed, "swing");
            return false;
        });
    });})(jQuery);
</script>

</body>
</html>
