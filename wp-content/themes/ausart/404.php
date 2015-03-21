<?php

get_header();

?>

<!-- Page Head -->
  
 


   
	    <section id="content" style="padding-top:0px !important; padding-bottom:0px !important;">

   

	    	<div class="row-fluid row-dynamic-el" style=" margin-bottom:100px;">

                 <div class="container">

                      <div class="row-fluid">

                         <div class="row-fluid row-dynamic-el " style="">

                                 <div class="container">

                                       <div class="row-fluid">
                                                
                                          <div class="span12 dynamic_page_header not_found_error">

                                                    <div class="headings">
                                                          <h2><?php echo esc_attr(themeple_get_option('404_error_message')); ?></h2>
                                                          <h3><?php _e('or the page may have been removed.', 'themeple'); ?></h3>
                                                    </div>   

                                                    <div class="image_not_found">
                                                          <img src="<?php echo esc_url(get_template_directory_uri(). '/img/404.png'); ?>" />
                                                    </div>

                                                    <div class='title'>
                                                        <h1> <?php _e('PAGE NOT FOUND', 'themeple'); ?>
                                                    </div>

                                                    <div class="search">
                                                            <form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
                                                                  <div>
                                                                      <input type="text" value="" name="s" id="s" />
                                                                      <input type="submit" id="searchsubmit" value="Search" />
                                                                  </div>
                                                            </form>
                                                    </div>

                                                   
                                         </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                 </div>
               </div>

	    </section>
	
<?php
get_footer();


?>