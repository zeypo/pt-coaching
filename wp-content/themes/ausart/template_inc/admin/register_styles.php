  <?php

  global $themeple_controller;

  $options = $themeple_controller->options;

  $styles = $options['themeple'];


  if(isset($_COOKIE['themeple_skin'])){

  	include(THEMEPLE_BASE.'/template_inc/admin/register_skins.php');

  	if(is_array($predefined[$_COOKIE['themeple_skin']]) && count($predefined[$_COOKIE['themeple_skin']]) > 0 ){

  		foreach($predefined[$_COOKIE['themeple_skin']] as $el_id => $value){

  			$styles[$el_id] = esc_attr($value);

  		}

  	}

  }
  if(isset($_COOKIE['themeple_color_skin'])){

    include(THEMEPLE_BASE.'/template_inc/admin/register_skins.php');

    if(is_array($skin[$_COOKIE['themeple_color_skin']]) && count($skin[$_COOKIE['themeple_color_skin']]) > 0 ){

      foreach($skin[$_COOKIE['themeple_color_skin']] as $el_id => $value){

        $styles[$el_id] = esc_attr($value);

      }

    }

  }

  


  extract($styles);
  if(isset($_COOKIE['themeple_pattern']) && $_COOKIE['themeple_pattern'] != '')
      $bg_img = esc_attr($_COOKIE['themeple_pattern']);

  $header_background = $header_bg_color; 
  $nav_bg_color_rgb_op = '0.9';



  if(isset($_COOKIE['themeple_header']) && $_COOKIE['themeple_header'] == '5'){

     
      $header_background = '#444';
      $header_bar = 'yes';
      $header_bar_font_color = '#555';
      $second_color="#fff";
      $header_logo_light_activation = 'yes';
      $nav_font_color = '#f6f6f6';
      $third_color = '#444';
      $top_nav_hover_font_color ='#fff';
      $header_border_color = '#fff';
      $top_widget = 'no';
      $header_border ='no';
        
  }

  if(isset($_COOKIE['themeple_header']) && $_COOKIE['themeple_header'] == '6'){
       
         
       $top_nav_bg_color = '#f6f6f6'; 
       $top_nav_border_color =  '#eeeeee';
       $header_background = '#ffffff';
       $top_widget = 'no';
       $header_border ='no';
       $header_bar = 'yes';

  }

  if(isset($_COOKIE['themeple_header']) && $_COOKIE['themeple_header'] == '1'){
      $header_bar = 'no';
      $header_border ='no';
  }

  if(isset($_COOKIE['themeple_header']) && $_COOKIE['themeple_header'] == '2'){
     
      $top_nav_bg_color = '#fcfcfc';
      $header_background = '#ffffff';
      $header_bar = 'no';
      $top_widget = 'no';
      $header_border ='no';
      

  }

    if(isset($_COOKIE['themeple_header']) && $_COOKIE['themeple_header'] == '3'){
     
      $top_nav_bg_color = '#fcfcfc';
      $header_background = '#f6f6f6';
      $header_bar = 'no';
      $header_bar_font_color = '#555';
      $second_color="#fff";
      $header_logo_light_activation = 'no';
      $nav_font_color = '#555';
      $third_color = '#444';
      $top_nav_hover_font_color ='#000';
      $header_border_color = '#ddd';
      $header_border ='no';

  }


    if(isset($_COOKIE['themeple_header']) && $_COOKIE['themeple_header'] == '4'){
     
      $top_nav_bg_color = '#fcfcfc';
      $header_background = '#fff';
      $header_bar = 'yes';
      $header_bar_font_color = '#444';
      $second_color="#f6f6f6";
      $header_logo_light_activation = 'yes';     
      $third_color = '#444';
      $top_widget = 'no';
      $header_border ='no';

  }


  if(isset($_COOKIE['themeple_header']) && $_COOKIE['themeple_header'] == '7'){
     
     $header_background = '#ffffff';
     $header_bar = 'no';
     $top_widget = 'no';
     $header_border ='yes';

     
  }


  ?>



  <style type="text/css">
    
  	body{background: <?php echo esc_attr($bg_color) ?> 

  	<?php if($bg_img != 'none' && $bg_your_img == '' && ((themeple_get_option('overall_layout') == 'boxed' && !isset($_COOKIE['themeple_layout'])) || (isset($_COOKIE['themeple_layout']) && $_COOKIE['themeple_layout'] == 'boxed' ))){ ?>

  		url('<?php echo esc_url(get_template_directory_uri()."/img/backgrounds/".$bg_img.".png") ?>') repeat;

  	<?php } ?>

    <?php if($bg_your_img != '' && $bg_type == 'repeat'): ?>

      url('<?php echo esc_url($bg_your_img) ?>') repeat;

    <?php endif; ?>

  	}
    .boxed_layout,  .top_wrapper{background: <?php echo esc_attr($bg_color) ?>;}

    /* Custom Css Box */

     <?php $custom_css = themeple_get_option('custom_css'); 
     echo $custom_css;
      ?>
     /* End Custom Css Box */ 

  	input,button,select,textarea,body,span, aside .widget_twitter li,.ui-slider-tabs-list li a span, aside ul li a, nav .menu li ul.sub-menu li a, .skill_title{font-family: <?php if($font_page == 'standart') echo '"Helvetica Neue", Helvetica, Open Sans, sans-serif'; else echo esc_attr($font_page) ?>;  }
    input,button,select,textarea,body, aside .widget_twitter li { font-size: <?php echo esc_attr($font_size_page) ?>px; color:<?php echo esc_attr($body_font_color) ?>; }
  	h1,h2,h3,h4,h5,h6,.ui-slider-tabs-list li a,.page_intro h1, .kwicks .box p.title, .single-post .single_title{font-family: <?php if($font_headings == 'standart') echo '"Helvetica Neue", Helvetica, Arial, sans-serif'; else echo esc_attr($font_headings) ?>}
    aside ul li a, .recent_posts_widget #recent .title a{color: <?php echo esc_attr($hyperlink_font_color); ?>;}  
    nav .menu > li > a{font-family: <?php echo esc_attr($font_menu) ?>;}
    nav .menu li ul.sub-menu li a{color: <?php echo esc_attr(themeple_get_option('sub_font_color')) ; ?> !important;}
    nav .menu li > ul.sub-menu li:hover, nav .menu .sub-menu li.current-menu-item {background: <?php echo esc_attr(themeple_get_option('sub_background_hover_color')); ?>}
      
    <?php $header_bg_color = themeple_HexToRGB($header_bg_color);  ?>
    header#header, .header_4 #navigation, .right_search_container input[type="text"], .header_3 .nav_top {background: rgba(<?php echo esc_attr($header_bg_color['r']) ?>,<?php echo esc_attr($header_bg_color['g']) ?>,<?php echo esc_attr($header_bg_color['b']) ?>,0);}

    header#header.fixed_header, .header_4 .fixed_header #navigation, .fixed_header .right_search_container input[type="text"]{background:rgba(<?php echo esc_attr($header_bg_color['r']) ?>,<?php echo esc_attr($header_bg_color['g']) ?>,<?php echo esc_attr($header_bg_color['b']) ?>,0.9)}
  	h1{font-size: <?php echo esc_attr($font_size_1) ?>px}

  	h2{font-size: <?php echo esc_attr($font_size_2) ?>px}

  	h3{font-size: <?php echo esc_attr($font_size_3) ?>px}

  	h4{font-size: <?php echo esc_attr($font_size_4) ?>px}

  	h5{font-size: <?php echo esc_attr($font_size_5) ?>px}

  	h6{font-size: <?php echo esc_attr($font_size_6) ?>px}

    nav .menu > li > a{font-size: <?php echo esc_attr($menu_font_size);?>px}

    <?php $nav_bg_color_rgb = themeple_HexToRGB(esc_attr($base_color)); ?>
   
    <?php $port_single_arrow = themeple_HexToRGB(esc_attr($base_color)); ?>
    
    <?php $base_color_rgb = themeple_HexToRGB($base_color); ?>

    #logo{width:<?php echo esc_attr($logo_width) ?>; margin-top: <?php echo esc_attr($logo_margin_top); ?>; margin-bottom:<?php echo esc_attr($logo_margin_bottom) ?>;}
      

    <?php if($header_bar == "yes"){ ?>

    .header_wrapper.no-transparent{height: 142px !important;}

    <?php } ?>          
  

    <?php if($header_border == "yes"){ ?>

      .header_7 .nav_top{margin-top: -5px;}
      .header_7 #logo{padding-top: 18px;}
      .header_7 header .right_search{margin-top: 41px; height: 17px;}
      .header_7 header#header{height:78px;}


    <?php } ?>  

     <?php if($header_border == "yes"){ ?>

    header#header{border-top:4px solid <?php echo esc_attr($base_color) ?>;}

    <?php } ?>

  

  <?php if($header_logo_light_activation == 'yes'): ?>

    			
    			#logo img{display: none;}

    			#logo img.light{opacity: 1 !important; display: block;}

   <?php endif; ?> 			
    
    <?php if($top_widget == 'no'){ ?>

      .top_nav {display: none;}


    <?php } ?>
    nav .menu > li > a{color:<?php echo esc_attr($nav_font_color) ?>;}
    nav .menu>li:hover>a, nav .menu>li.current-menu-item > a {color:<?php echo esc_attr($top_nav_hover_font_color) ?> ;}
    header#header.sticky_header.fixed_header nav .menu li > a,.background--dark header#header.sticky_header.fixed_header .right_search_container input[type="text"], .background--dark header#header.sticky_header.fixed_header .right_search_container .input-append i {color:<?php echo esc_attr($nav_font_color); ?>}
    .no-transparent nav .themeple_custom_menu_mega_menu, .header_wrapper.no-transparent nav .menu > li > ul.sub-menu{border-top:2px solid <?php echo esc_attr($base_color); ?>;}
    header .right_search i, .arrow_down i{color: <?php echo esc_attr($base_color) ?>;}
    .header_1 nav .menu li > a, .header_4 nav .menu li > a, .header_2 nav .menu > li > a {color:<?php echo esc_attr($nav_font_color); ?>;}
    footer#footer .inner{background:<?php echo esc_attr($footer_bg_color) ?>; color:<?php echo esc_attr($footer_font_color) ?>;} 
    footer .widget-title {background: <?php echo esc_attr($footer_bg_color) ?>;}
    footer .tabbable .nav-tabs > li > a {color:<?php echo esc_attr($footer_font_color) ?>;}
    footer .inner .widget ul li, #popular_widget dl {border-bottom:1px solid <?php echo esc_attr($footer_border_color) ?>; } 
    footer#footer #copyright{background:<?php echo esc_attr($footer_copyright_bg) ?>; color:<?php echo esc_attr($copyright_font_color) ?>;} 
    #mc_signup_form .mc_input{background: <?php echo esc_attr($footer_copyright_bg) ?> !important;}
    .top_nav, .top_nav_sub.login, .cart .content{background:<?php echo esc_attr($top_nav_bg_color); ?>}
    .top_nav_sub.login, .top_nav_sub.login input, .cart .content{border:1px solid <?php echo esc_attr($top_nav_border_color) ?>;}
    .top_nav .social_widget li i:hover{color: <?php echo esc_attr($top_nav_hover_color); ?>}
    .top_nav .topinfo .phone, .top_nav .topinfo .email, .top_nav .social_widget li i{color:<?php echo esc_attr(themeple_get_option('top_nav_font_color')); ?>}
    .top_nav .widget{border-left:1px solid <?php echo esc_attr($top_nav_border_color); ?>; border-right:1px solid <?php echo esc_attr($top_nav_border_color) ?>;}
    .top_nav .widget_text, .login.small_widget .widget_activation a, .headecart.small_widget .widget_activation a, .lang_sel_sel.icl-en, .top_nav #lang_sel a, #lang_sel a.lang_sel_sel:hover{color:<?php echo esc_attr($top_nav_font_color) ?>;}
    aside .tweet_list dt i, #popular_widget i{color:<?php echo esc_attr($base_color); ?>}
    .footer_social_bar:before, .top_footer .title{background:<?php echo esc_attr($footer_twitter_bg_color)?>;}  
    .footer_social_bar .triangle{border-left: 35px solid <?php echo esc_attr($footer_twitter_bg_color) ?>;}  
    aside .tweet_list dt {border:1px solid <?php echo esc_attr($base_color) ?>;} 
    .details_side{border-bottom:1px solid <?php echo esc_attr($base_border) ?>;}  
    .widget #wp-calendar a, #faq-filter ul li.active a, #faq-filter ul li a:hover, .portfolio_go a i {color:<?php echo esc_attr($base_color); ?>;}
    a:hover, footer .inner .widget_contact_info li i, .blog-article h1 a:hover,aside ul li:hover a, .blog-article .info ul.shares li:hover i, .dark .services_medium_new i, .dark .services_medium_new a, .dark .services_medium_new h6, .services_medium_new h6 a:hover, .recent_news .news-carousel-item dl .info, .services_medium_box h5 a, .services_medium_box .read_m, .services_medium_left dl dt .icon_wrapper i, .services_medium_left dl dd > a, .services_medium:hover i, .services_small .services_small_container .services_small_icon i ,.dark .dynamic_page_header i, .one-staff .social_widget ul li:hover i, .light .services_small dt i, .single_testimonial .content .data h6, .star-rating span, ul.products .product .price, #woocommerce .product .summary .price, .woocommerce .product .summary .price, .right_search i:hover, .swiper-slide.blog-article .content a:hover, .contact_info .social ul li a:hover, .single_testimonial .content span   {color:<?php echo esc_attr($base_color) ?>;}
    nav .menu > li > ul.sub-menu, nav .menu > li > ul.sub-menu ul, nav .themeple_custom_menu_mega_menu{background: <?php echo esc_attr(themeple_get_option('sub_background_color')); ?>}
    footer .tabbable .nav-tabs li, footer .tabbable .nav-tabs li   {background:<?php echo esc_attr($footer_copyright_bg) ?>;}
    footer .tagcloud a{border:1px solid <?php echo esc_attr($footer_border_color) ?>;}  
    footer .tagcloud a:hover, .footer_social_bar, .blog-article dt .date.box, #faq-filter ul li:hover, #faq-filter ul li.active, .portfolio-item .link:hover, article .content .dl-horizontal dt .dt, .single article .content .dl-horizontal dt .dt , aside h5.widget-title:after, .details_side h1:after,  .meta-content .meta h1:after, .arrow_right_circle:after {background:<?php echo esc_attr($base_color) ?>;}
    .top_nav .widget ul li a:hover, .information i{color:<?php echo esc_attr($base_color) ?>;} 
    .top_nav .widget span, .top_nav .widget ul li a, .top_nav .checkout_link a i, .top_nav .view_cart a i {color:<?php echo esc_attr($top_nav_font_color) ?>}
    .top_nav {border: 1px solid <?php echo esc_attr($top_nav_border_color); ?>;}
    #faq-filter ul li:hover, #faq-filter ul li.active {border-right:1px solid <?php echo esc_attr($base_color) ?>;}
    #portfolio-filter ul li a {color: <?php echo esc_attr($base_color) ?>;}
    #faq-filter ul li.active{border-left:1px solid <?php echo esc_attr($base_color) ?>;}
    .woocommerce ul.products li.product .links a, .woocommerce ul.products li.product .price,
    .woocommerce ul.products li.product .price .amount, .woocommerce ul.products li.product .price ins, 
    .woocommerce ul.products li.product .price del{color:<?php echo esc_attr($base_color) ?>; }
    .woocommerce ul.products li.product .links a:hover, .woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale{background: <?php echo esc_attr($base_color); ?>}
    .woocommerce ul.products li.tpl2:hover {border:1px solid <?php echo esc_attr($base_color) ?>;}
    .woocommerce #content div.product form.cart .button, 
    .woocommerce div.product form.cart .button, 
    .woocommerce #content div.product form.cart .button, 
    .woocommerce div.product form.cart .button{background: <?php echo esc_attr($base_color) ?>}
    .services_step:hover i{border:1px solid <?php echo esc_attr($base_color);?>;}
    .services_step:hover i{background: <?php echo esc_attr($base_color); ?>;}
    .skill .prog, .contact_form input[type="submit"]{background:<?php echo esc_attr($base_color) ?>;}
    .header_border_left, .header_border_right, .border_counter_center {background:<?php echo esc_attr($base_color) ?>;}
    .tpl2 .bg{background:rgba(<?php echo esc_attr($base_color_rgb['r'])?>, <?php echo esc_attr($base_color_rgb['g'])?>, <?php echo esc_attr($base_color_rgb['b']) ?>, 0.8); }
    .full_testimonials .pagination a.selected{border-color: <?php echo esc_attr($base_color) ?>;}
    .btn-system.only_border:hover{background: <?php echo esc_attr($base_color); ?>; border:1px solid <?php echo esc_attr($base_color) ?> !important;}
    .btn-system.default{border:2px solid <?php echo esc_attr($base_color); ?>;}
    .btn-system.normal{border:2px solid <?php echo esc_attr($base_color); ?>;}
    .btn-system.normal{background:<?php echo esc_attr($base_color); ?>;}
    header nav .menu > li > a:before{background: <?php echo esc_attr($base_color); ?>;}
    .accordion .accordion-heading.in_head{border:none;}
    .accordion .accordion-heading.in_head .accordion-toggle{color:<?php echo esc_attr($base_color);?>}
    .accordion .accordion-heading.in_head:before{background: <?php echo esc_attr($base_color); ?>}
    .header_bar{background:<?php echo esc_attr($second_color) ?>;}
    .header_bar h3, .header_bar .pull-right.socials li a{color:<?php echo esc_attr($header_bar_font_color) ?>;}
    .header_bar .pull-right.socials li a:hover{color: <?php echo esc_attr($base_color); ?>}
    .accordion .accordion-heading.in_head:after{color: <?php echo esc_attr($base_color); ?>}
    .contact_form input[type="submit"]:hover{background:<?php echo esc_attr($base_color) ?>; border:2px solid <?php echo esc_attr($base_color) ?>;}
    .contact_form input[type="submit"]{border:2px solid <?php echo esc_attr($base_color) ?> !important;}
    .not_found_error  .search #searchsubmit{background: <?php echo esc_attr($base_color) ?>;}
    .not_found_error  .search #searchsubmit{border:2px solid <?php echo esc_attr($base_color);?>;}
    .tp-rightarrow.default:hover, .tp-leftarrow.default:hover{background: <?php echo esc_attr($base_color) ?> !important; border:2px solid <?php echo esc_attr($base_color) ?>;}
    .p_pagination .pagi ul li a, .p_pagination .nav-previous a, .p_pagination .nav-next a {border:2px solid <?php echo esc_attr($base_color) ?>; color:<?php echo esc_attr($base_color) ?>;}
    .p_pagination .pagi ul li.selected a, .p_pagination .pagi ul li a:hover, .p_pagination .nav-next a:hover, .p_pagination .nav-previous a:hover {background:<?php echo esc_attr($base_color)?>; border:2px solid <?php echo esc_attr($base_color) ?>;}
    aside .tagcloud a:hover{background: <?php echo esc_attr($base_color) ?>;}   
    .single_content.side_single .flex-direction-nav li:last-child a, .single_content.side_single .flex-direction-nav li a, .flex-direction-nav li a{background-color:<?php echo esc_attr($base_color) ?>}  
    #blogmasonery .readm, .shares li a{color:<?php echo esc_attr($body_font_color) ?>;}
    .shares li a:hover, .blog-article .info > li i{color:<?php echo esc_attr($base_color) ?>;}
    .left_content .border_bottom_left{background: <?php echo esc_attr($base_color) ?>;}
    .style_3 .border_center, .header_page .border_center{background: <?php echo esc_attr($base_color);?>}
    .services_step i, .services_boxed span a{color:<?php echo esc_attr($base_color); ?>;}
    .services_step:hover .line_left, .services_step:hover .line_right{background: <?php echo esc_attr($base_color) ?>;}
    .services_boxed:hover .icon_wrapper i {color: <?php echo esc_attr($base_color) ?>;}
    .services_boxed .icon_wrapper i{background: <?php echo esc_attr($base_color); ?>;}
    #blogmasonry .readm:hover, .load_more_pagination .load_new{background:<?php echo esc_attr($base_color); ?>}
    aside .tagcloud a:hover, .flex-control-thumbs li:hover{border:1px solid <?php echo esc_attr($base_color) ?>;}
    .light .single_testimonial .content .data span{color: <?php echo esc_attr($base_color) ?>;}
    .center-bar .btn-system:hover{background:<?php echo esc_attr($base_color) ?>;}
    .tabbable .nav-tabs li.active{border-top:3px solid <?php echo esc_attr($base_color) ?>;}
    .line_under_full .read_1:hover{background: <?php echo esc_attr($base_color); ?>;}
    .line_under_full .read_2:hover{color:<?php echo esc_attr($base_color); ?>;}
    .dl-horizontal.list dt .circle i{color:<?php echo esc_attr($base_color); ?>;}
    aside .tagcloud a{border:1px solid <?php echo esc_attr($base_color) ?>;}
    .header_page.basic.single{background:<?php echo esc_attr($single_post_bg) ?>;}
    .header_page.basic.single h1{color:<?php echo esc_attr($single_post_title_color) ?>;}
    .portfolio_single_nav li a:hover{color:<?php echo esc_attr($base_color) ?>;}
    .single_content .meta i{border:2px solid <?php echo esc_attr($base_color) ?>; color:<?php echo esc_attr($base_color) ?>;}
    .dynamic_page_header.left .header_border, .dynamic_page_header.right .header_border{background: <?php echo esc_attr($base_color); ?>}
    .portfolio_big_title, .line_under_full .read_1{color:<?php echo esc_attr($base_color); ?>}
    .line_under .line_center{background:<?php echo esc_attr($base_color); ?>;}
    .services_boxed .readmore:hover{background: <?php echo esc_attr($base_color);?>; border:2px solid <?php echo esc_attr($base_color) ?>;}
    .line_under_full .full_center{background: <?php echo esc_attr($base_color) ?>}
    .services_boxed .readmore{color: <?php echo esc_attr($base_color); ?>}
    .header_wrapper.no-transparent, #header.sticky_header.fixed_header{background: <?php echo esc_attr($header_background); ?>}
    .services_small_icon{border:1px solid <?php echo esc_attr($base_color) ?>;}
    .services_small:hover .services_small_icon{background: <?php echo esc_attr($base_color); ?>} 
    .latest_blog .date_divs, .latest_blog .month_div{background: <?php echo esc_attr($base_color); ?>}
    .latest_blog .overlay li{color: <?php echo esc_attr($base_color); ?>}
    .latest_blog .blog-article.grid .content a.readmore, .latest_blog .blog-article.grid .overlay li, .latest_blog .blog-article.grid .overlay, .post_type i, .recent_news .news-carousel-item dl dd .read_more a{color: <?php echo esc_attr($base_color) ?> !important;}
    .clients .item {width: <?php echo esc_attr($item_width_size); ?>; height: <?php echo esc_attr($item_height_size); ?>;}

     /* Border */
    
     <?php $tests = themeple_post_meta(themeple_get_post_id(), 'page_header_border_bottom'); ?>
     <?php if($tests != 'no') : ?>

        .header_wrapper.no-transparent{border-bottom: 1px solid <?php echo esc_attr($top_nav_border_color) ?>;}

     <?php endif; ?>
     header nav .menu > li > a{border-right:1px solid <?php echo esc_attr($base_border);?>}
     .clients .item{border:1px solid <?php echo esc_attr($base_border) ?>;}
     .clients .item:last-child{border-right:1px solid <?php echo esc_attr($base_border) ?> ;}
     aside .tagcloud a, .header_page.basic .breadcrumbss .page_parents{border:1px solid <?php echo esc_attr($base_border); ?>}    
     .border_before{background: <?php echo esc_attr($header_border_color) ?>;}
     header .right_search {border-left:1px solid <?php echo esc_attr($header_border_color) ?>;}
     .services_slideshow_icon:hover{background: <?php echo esc_attr($base_color); ?>}
     .recent_news .month_div{background: <?php echo esc_attr($base_color) ?>}
     .textbar-container{border:1px solid <?php echo esc_attr($base_border) ?>;} 
     .textbar-container .btn-system.normal:hover, .btn-system.normal:hover{background: <?php echo esc_attr($second_color); ?>}
     .btn-system.normal:hover{border:1px solid <?php echo esc_attr($second_color); ?> !important;}
     .single_content .flex-direction-nav li:first-child a:hover, .single_content .flex-direction-nav li:last-child a:hover, .flex-direction-nav li a.flex-prev:hover, .flex-direction-nav li a.flex-next:hover{background-color:<?php echo esc_attr($second_color) ; ?>!important}
     .textbar-container .btn-system.normal{border:1px solid <?php echo esc_attr($base_color) ?>;}
     nav .menu li > ul.sub-menu li{border-bottom: 1px solid <?php echo esc_attr(themeple_get_option('sub_border_color'));  ?>}
     nav .menu li > ul.sub-menu li{background: <?php echo esc_attr(themeple_get_option('sub_background_color')); ?>}                                 
    .clients_el.no .clients .item:nth-child(2), .clients_el.no .clients .item:nth-child(6) {border-left:1px solid <?php echo esc_attr($base_border) ?>; border-right:1px solid <?php echo esc_attr($base_border) ?>;}
    .line_under_full .read_1{border:1px solid <?php echo esc_attr($base_border) ?>;}
    .tpl2{border:1px solid <?php echo esc_attr($base_border) ?>;}
    .clients_el.no .clients .separator{background: <?php echo esc_attr($base_border) ?>}
    .line_under .line_left, .line_under .line_right, .line_under_full .line_full:after{background: <?php echo esc_attr($base_border); ?>}
    .services_boxed .readmore{border:2px solid <?php echo esc_attr($base_border) ?>;}
    .portfolio_single_header:after{background: <?php echo esc_attr($base_border); ?>}
    .single_content .meta-content .meta h1{border-bottom:1px solid <?php echo esc_attr($base_border) ?>;}
    #portfolio-filter #filters{border:1px solid <?php echo esc_attr($base_border) ?>;}
    .themeple_blockquote{border-left:2px solid <?php echo esc_attr($base_color); ?>;}
    .one-staff:hover .social_widget{background: <?php echo esc_attr($base_color); ?>;}
    .not_found_error .search input{border:1px solid <?php echo esc_attr($base_border) ?>;}
    #faq-filter ul{border:1px solid <?php echo esc_attr($base_border); ?>}
    .recent_news .post_type, .latest_blog .post_type{border-right:1px solid <?php echo esc_attr($base_border) ?>; border-left:1px solid <?php echo esc_attr($base_border) ?>; border-bottom: 1px solid <?php echo esc_attr($base_border); ?>}
    .recent_news .date_div{background:<?php echo esc_attr($base_color); ?>;}
    .light .services_boxed .icon_wrapper i, .services_boxed .icon_wrapper i{border:1px solid <?php echo esc_attr($base_color); ?>} 
    .full_testimonials, .img_testimonial{border:1px solid <?php echo esc_attr($base_border) ?>;}
    .recent_news .tags, .services_media .read_more a, .recent_news .news-carousel-item dl dd .read_right a{color:<?php echo esc_attr($base_color) ?>;}
    .details_side span, .meta-content .meta span.uppertitle{color: <?php echo esc_attr($base_color) ?>;}  
    .portfolio_single_nav li a, .skill{border:1px solid  <?php echo esc_attr($base_border); ?>}
    .row-dynamic-el .header h2,.themeple_sc .header h2{border-bottom:1px solid <?php echo esc_attr($base_border); ?>}
    .row-dynamic-el .header h2:after , .themeple_sc .header h2:after{background:<?php echo esc_attr($base_color);?>}
    .services_medium .icon_wrapper{border:1px solid <?php echo esc_attr($base_border) ?>;}
    .services_medium:hover .icon_wrapper{background:<?php echo esc_attr($base_color); ?>} 
    .services_medium:hover .icon_wrapper{border:1px solid <?php echo esc_attr($base_color); ?>}
    .services_medium .read_more .readmore:hover{color:<?php echo esc_attr($base_color); ?>}
    aside #s {border:1px solid <?php echo esc_attr($base_border); ?>;}
    .single .information, .clients_el .controls{border-top:1px solid <?php echo esc_attr($base_border) ?>;}
    .blog-article.grid .info{border-bottom: 1px solid <?php echo esc_attr($base_border); ?>;}
    .one-staff, .controls a, .recent_portfolio.pagination a, .recent_news .pagination a {border:1px solid <?php echo esc_attr($base_border); ?>;}
    .portfolio-item:hover .info{border-bottom: 1px solid <?php echo esc_attr($base_color); ?>}
    aside dl:first-child{border-top:1px solid <?php echo esc_attr($base_border);?>}
    aside h5.widget-title{border-bottom:1px solid <?php echo esc_attr($base_border); ?>}
    .comment .upper{border-bottom:1px solid <?php echo esc_attr($base_border) ?>;}
    .page_parents li a:hover{color:<?php echo esc_attr($base_color); ?>}
    .widget_recent_content .tabbable.style_1 .nav-tabs li{
      border-left:1px solid <?php echo esc_attr($base_border) ?>; 
      border-right:1px solid <?php echo esc_attr($base_border) ?>; 
      border-bottom:1px solid <?php echo esc_attr($base_border) ?>;
    }
   
        
    aside .widget_recent_content #recent dl, 
    aside .widget_recent_content #popular dl, 
    footer .widget_recent_content #recent dl, 
    footer .widget_recent_content #popular dl,
    aside .widget_recent_content #comments_recent dl,
    footer .widget_recent_content #comments_recent dl
    {

      border-bottom:1px solid <?php echo esc_attr($base_border) ?>;
    }

    .side-nav {border-right:1px solid <?php echo esc_attr($base_border); ?> ;} 

    .side-nav li{border-bottom:1px solid <?php echo esc_attr($base_border) ?> ;}

    .one-staff .left_border{background: <?php echo esc_attr($base_color); ?>} 

    .one-staff .right_border{background: <?php echo esc_attr($base_color); ?>}
    
    
    /* End Border #e6e9ea */
     #portfolio-filter ul li a, #portfolio-filter ul li:last-child a{border:1px solid <?php echo esc_attr($base_border) ?>;}
    .side-nav li.current_page_item a, .readm{color: <?php echo esc_attr($base_color) ?>;}
    .widget_recent_content .tabbable .nav-tabs > li > a{color: <?php echo esc_attr($body_font_color) ?>;}
    .btn-system.standard{background: <?php echo esc_attr($base_color); ?>; border:2px solid <?php echo esc_attr($base_color) ?>;}
    .coupon input.btn-system, .actions input.btn-system, .shipping-calculator-form .btn-system, .form-row.place-order #place_order, .checkout_coupon .btn-system{background: <?php echo esc_attr($base_color); ?>}
    #respond input[type="submit"]{background: <?php echo esc_attr($base_color); ?>; border:2px solid <?php echo esc_attr($base_color) ?>;}
    .dynamic_page_header.style_3 h1, .dynamic_page_header.style h1, .dynamic_page_header .subtitle {color: <?php echo esc_attr($second_color) ?>;} 
    nav .menu > li.current-menu-item, nav .menu > li:hover, nav .menu > li.current-menu-parent,  nav .menu > li.current_page_ancestor, nav .menu > li.current-menu-ancestor {border-bottom:4px solid <?php echo esc_attr($base_color) ?>;}
   
    <?php 
    $page_header_left_font_color =themeple_post_meta(themeple_get_post_id(), 'page_header_left_font_color');
   
    if(!empty($page_header_left_font_color)): ?>

    .left_content h1, .left_content h2, .description_left{color:<?php echo esc_attr($page_header_left_font_color); ?>} 
    
    <?php endif; ?>

   <?php 

   $page_header_color = themeple_post_meta(themeple_get_post_id(), 'page_header_font_color'); 
   $page_header_height = themeple_post_meta(themeple_get_post_id(), 'page_header_height'); 

   ?>

   .header_page.centered{height:<?php echo esc_attr($page_header_height) ?>;}

 

  <?php if(!empty($page_header_basic_font_color)) : ?>

  .header_page.basic h1, .header_page.basic .description_basic {color: <?php echo esc_attr($page_header_basic_font_color) ?>;}


  <?php endif; ?>


   <?php if(!empty($page_header_color) ): ?>
   .header_page.centered h2:before{
    background:<?php echo esc_attr($page_header_color) ?>;
   }
   .header_page.centered h2:after{
    background:<?php echo esc_attr($page_header_color) ?>;
   }
   <?php endif; ?>
  </style>


   		<?php $font = themeple_get_option('font_page');  ?>

      <?php $font_head = themeple_get_option('font_headings');  ?>

   		<?php if($font == 'standart' || $font_head == 'standart'): ?>
          <style type="text/css">
         
          @font-face {
              font-family: 'Helvetica Neue';
              src: url('<?php echo esc_url(get_stylesheet_directory_uri()."/css/Helvetica_Neue.ttf") ?>') format('truetype');
              font-weight: normal;
              font-style: normal;

          }

          @font-face {
              font-family: 'Helvetica Neue';
              src: url('<?php echo esc_url(get_stylesheet_directory_uri()."/css/Helvetica_Neue_Bold.ttf") ?> ') format('truetype');
              font-weight: 600;
              font-style: normal;

          }


          </style>


          <?php endif; ?> 

      <?php if ($font == 'Bebas Neue' || $font_head == 'Bebas Neue'): ?>

        <style type="text/css">
          
          @font-face {
                font-family: 'Bebas Neue';
                src: url('<?php echo esc_url(get_stylesheet_directory_uri()."/font/BebasNeue.otf" ) ?>') format('opentype');
                font-weight: 300;
                font-style: normal;

            }

         
            

        </style>

      <?php endif; ?>  

      <?php if($font_menu == 'bignoodletitling'): ?>


        <style type="text/css">

        @font-face {
            font-family: 'bignoodletitling';
            src: url('<?php echo esc_url(get_stylesheet_directory_uri()."/font/bignoodletitling.eot" ) ?>');
            src: local('bignoodletitling'), url('<?php echo esc_url(get_stylesheet_directory_uri()."/font/bignoodletitling.woff" ) ?>') format('woff'), url('<?php echo esc_url(get_stylesheet_directory_uri()."/font/bignoodletitling.ttf" ) ?>') format('truetype');
          } 
      
            
            
        </style>
          <?php endif;?>

         <?php if($font_menu == 'HelveticaLTStd-Bold' || $font_head == 'HelveticaLTStd-Bold'): ?>


        <style type="text/css">

        @font-face {
            font-family: 'HelveticaLTStd-Bold';
            src: url('<?php echo esc_url(get_stylesheet_directory_uri()."/font/HelveticaLTStd-Bold.eot" ) ?>');
            src: local('HelveticaLTStd-Bold'), url('<?php echo esc_url(get_stylesheet_directory_uri()."/font/HelveticaLTStd-Bold.woff" ) ?>') format('woff'), url('<?php echo esc_url(get_stylesheet_directory_uri()."/font/HelveticaLTStd-Bold.ttf" ) ?>') format('truetype');
            font-weight:300;
          } 
      
            
            
        </style>
  	   
      <?php endif; ?> 