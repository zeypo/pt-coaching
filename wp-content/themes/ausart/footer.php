<?php
global $themeple_config;

wp_reset_postdata();
$social_icons = themeple_get_option('social_icons');


?>
 
 <!-- Social Profiles -->
    

<!-- Footer -->
    </div>


    <div class="footer_wrapper">
	
    
    <?php if(themeple_get_option('footer_social_bar') == 'yes'): ?>
        <div class="footer_social_bar">
            <div class="container">
                <div class="row-fluid">
                    <div class="span12">
                       <div class="top_footer"><div class="container"><div class="title"><i class="moon-twitter"></i><span><?php _e('Some Recent Tweets', 'themeple'); ?></span></div><div class="triangle"></div><?php echo themeple_get_twitter_top_footer(3, themeple_get_option('twitter_account')) ?><div class="pagination pull-right"><a href="#" class="back"><i class="moon-arrow-left"></i></a><a href="#" class="next"><i class="moon-arrow-right-2"></i></a></div><span class="shadow_top_footer"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <footer id="footer" class="type_<?php echo esc_attr(themeple_get_option('footer_skin') ) ?>">
        

    	<div class="inner">
	    	<div class="container">
	        	<div class="row-fluid ff">
                
                	<!-- widget -->
		        	<?php
                    
                    $columns = esc_attr(themeple_get_option('footer_number_columns') );
                    for($i = 1; $i <= $columns; $i++){
                        ?>
                        <div class="span<?php echo 12/$columns ?>">
                        
                            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - column'.$i) ) : else : echo "<div class='widget'>Add Widget Column $i</div>"; endif; ?>
                            
                        </div>
                        
                        
                        
                         
                        <?php
                    }
                
                
                
                ?>
                    
	            </div>
	        </div>
            <div class="arrow_down"><i class="icon-angle-up"></i></div>
        </div>
        
        <div id="copyright">
	    	<div class="container">
	        	<div class="row-fluid">
		        	<div class="span12 desc">
                        
                        <div class="span4">
                            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Copyright Footer Sidebar Left') ) : else : echo "<div class='widget'>Add Widget Column</div>"; endif; ?>
                        </div>
                        <div class="span4"></div>
                        <div class="span4"><?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Copyright Footer Sidebar Right') ) : else : echo "<div class='widget'>Add Widget Column</div>"; endif; ?></div>
                    
                    
                    </div>
                    
                </div>
            </div>
        </div><!-- #copyright -->

    </footer><!-- #footer -->
</div>

<?php $layout = themeple_get_option('overall_layout'); if($layout == 'boxed'): ?>
</div>

<?php endif; ?>
<?php
wp_footer();
?>
</body>
</html>