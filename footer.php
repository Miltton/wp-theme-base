    	</div> <!-- .page-content -->

    	<footer class="page-footer" role="contentinfo">
    		<div class="container">
    			<div class="footer-container">
    				<?php echo '&copy; ' . get_bloginfo('name') . '. ' . date('Y'); ?>
    			</div><!-- .footer-container -->
    		</div>
    	</footer><!-- .page-footer -->
    </div><!-- .wrapper -->

    <?php wp_footer(); ?>
    
    <div class="hide"><?php dynamic_sidebar( 'google-analytics' ); ?></div>
</body>
</html>