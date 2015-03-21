<?php if(!defined('THEMEPLE_FRAMEWORK')) exit("Direct script access not allowed");


class themepletwitter extends WP_Widget{

    

    function themepletwitter(){

        $options = array('classname' => 'widget_twitter', 'description' => 'A widget to display latest entries from twitter' );

		$this->WP_Widget( 'widget_twitter', THEMENAME.' Twitter Widget', $options );

    }


    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo $before_widget;

        

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

		$count = empty($instance['count']) ? '' : $instance['count'];
		
              
		$username = empty($instance['username']) ? '' : $instance['username'];
              
              $twitter_consumer_key = empty($instance['twitter_consumer_key']) ? '' : $instance['twitter_consumer_key'];

              $twitter_consumer_secret = empty($instance['twitter_consumer_secret']) ? '' : $instance['twitter_consumer_secret'];
 
        $time = empty($instance['time']) ? 'no' : $instance['time'];

		$display_image = empty($instance['display_image']) ? 'no' : $instance['display_image'];

        $used_for = 'sidebar';

		if ( !empty( $title ) && $used_for == 'sidebar' ) { 

		      echo $before_title . $title . $after_title; 

        }

		$entries = get_twitter_entries($count, $username, $widget_id, $time, $display_image, $used_for, $twitter_consumer_key, $twitter_consumer_secret );

		echo $entries;

        echo $after_widget;

    }


    function update($new_instance, $old_instance) {

		$instance = $old_instance;	

		foreach($new_instance as $key=>$value)

		{

			$instance[$key]	= strip_tags($new_instance[$key]);

		}

		delete_transient(THEMENAME.'_tweetcache_id_'.$instance['username'].'_'.$this->id_base."-".$this->number);

		return $instance;

	}


    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => 'Latest Tweets', 'count' => '3', 'username' => themeple_get_option('twitter_username') ) );

		$title = 			isset($instance['title']) ? strip_tags($instance['title']): "";

		$count = 			isset($instance['count']) ? strip_tags($instance['count']): "";

		$username = 		isset($instance['username']) ? strip_tags($instance['username']): "";

		$time = 			isset($instance['time']) ? strip_tags($instance['time']): "";

		$display_image = 	isset($instance['display_image']) ? strip_tags($instance['display_image']): "";
              
              $twitter_consumer_key = isset($instance['twitter_consumer_key']) ? strip_tags($instance['twitter_consumer_key']): "";
          
              $twitter_consumer_secret = isset($instance['twitter_consumer_secret']) ? strip_tags($instance['twitter_consumer_secret']): "";

        

        ?>

        <p>

		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title: 

		<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title'));; ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

		

		<p><label for="<?php echo esc_attr($this->get_field_id('username')); ?>">Enter your twitter username:

		<input id="<?php echo esc_attr($this->get_field_id('username')); ?>" name="<?php echo esc_attr($this->get_field_name('username')); ?>" type="text" value="<?php echo esc_attr($username); ?>" /></label></p>
              
             
                 <p><label for="<?php echo esc_attr($this->get_field_id('twitter_consumer_key')); ?>">Enter your twitter consumer key:

		<input id="<?php echo esc_attr($this->get_field_id('twitter_consumer_key')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter_consumer_key')); ?>" type="text" value="<?php echo esc_attr($twitter_consumer_key); ?>" /></label></p>

              <p><label for="<?php echo esc_attr($this->get_field_id('twitter_consumer_secret')); ?>">Enter your twitter consumer secret:

		<input id="<?php echo esc_attr($this->get_field_id('twitter_consumer_secret')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter_consumer_secret')); ?>" type="text" value="<?php echo esc_attr($twitter_consumer_secret); ?>" /></label></p>



		

		<p>


                   

			<label for="<?php echo esc_attr($this->get_field_id('count')); ?>">How many entries do you want to display: </label>

			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>">

				<?php 

				$elements = "";

				for ($i = 1; $i <= 20; $i++ )

				{

					$selected = "";

					if($count == $i) $selected = 'selected="selected"';

				

					$elements .= "<option $selected value='$i'>$i</option>";

				}

				$elements .= "</select>";

				echo $elements;

				?>

				

			

		</p>

		

		<p>

			<label for="<?php echo esc_attr($this->get_field_id('time')); ?>">Display time of tweet</label>

			<select id="<?php echo esc_attr($this->get_field_id('time')); ?>" name="<?php echo esc_attr($this->get_field_name('time')); ?>">

				<?php 

				$elements = "";

				$answers = array('yes','no');

				foreach ($answers as $answer)

				{

					$selected = "";

					if($answer == $time) $selected = 'selected="selected"';

				

					$elements .= "<option $selected value='$answer'>$answer</option>";

				}

				$elements .= "</select>";

				echo $elements;

				?>

				

			

		</p>



		<p>

			<label for="<?php echo esc_attr($this->get_field_id('display_image')); ?>">Display Twitter User Avatar</label>

			<select  id="<?php echo esc_attr($this->get_field_id('display_image')); ?>" name="<?php echo esc_attr($this->get_field_name('display_image')); ?>">

				<?php 

				$elements = "";

				$answers = array('yes','no');

				foreach ($answers as $answer)

				{

					$selected = "";

					if($answer == $display_image) $selected = 'selected="selected"';

				

					$elements .= "<option $selected value='$answer'>$answer</option>";

				}

				$elements .= "</select>";

				echo $elements;

				?>

		</p>

       

        <?php

    }

    

}


function get_twitter_entries($count, $username, $widget_id, $time='yes', $avatar = 'yes', $used_for = 'sidebar', $twitter_consumer_key, $twitter_consumer_secret)

{		

$filtered_message = "";
        $output = "";
        $iterations = 0;
        
        $cache = get_transient(THEMENAME.'_tweetcache_id_'.$username.'_'.$widget_id);
        
        if($cache)
        {
          // $tweets = get_option(THEMENAME.'_tweetcache_'.$username.'_'.$widget_id);
        }
       else
       {

     // Include Twitter API Client
           require_once( 'class-wp-twitter-api.php' );

        // Set your personal data retrieved at https://dev.twitter.com/apps
            $credentials = array(
              'consumer_key' => $twitter_consumer_key,
              'consumer_secret' => $twitter_consumer_secret            ); 

// Let's instantiate Wp_Twitter_Api with your credentials
$twitter_api = new Wp_Twitter_Api( $credentials );

// Example a - Retrieve last 5 tweets from my timeline (default type statuses/user_timeline)
$query = 'count=5&include_entities=true&include_rts=true&screen_name='.$username;
           
        $response = $twitter_api->query( $query );
        
      
           if (!is_wp_error($response)) 
            {
                
                                       
                        $tweets = array();
                        if(!empty($response)){
                        foreach ($response as $tweet) 
                        {
                            if($iterations == $count) break;
                            
                            $text = (string) $tweet->text;
                            if($text[0] != "@")
                            {
                                $iterations++;
                                $tweets[] = array(
                                    'text' => filter( $text ),
                                    'created' =>  strtotime( $tweet->created_at ),
                                    'user' => array(
                                        'name' => (string)$tweet->user->name,
                                        'screen_name' => (string)$tweet->user->screen_name,
                                        'image' => (string)$tweet->user->profile_image_url,
                                        'utc_offset' => (int) $tweet->user->utc_offset[0],
                                        'follower' => (int) $tweet->user->followers_count));
                            }
                        }
                        
                        set_transient(THEMENAME.'_tweetcache_id_'.$username.'_'.$widget_id, 'true', 60*30);
                        update_option(THEMENAME.'_tweetcache_'.$username.'_'.$widget_id, $tweets);
                  
               
            }
        }
    }

        
      if(!isset($tweets[0]))

		{

			$tweets = get_option(THEMENAME.'_tweetcache_'.$username.'_'.$widget_id);

		}

		

	    if(isset($tweets[0]))

	    {	

	    	$time_format = get_option('date_format')." - ".get_option('time_format');

	        if($used_for == 'sidebar'){

    	    	foreach ($tweets as $message)

    	    	{	

    	    		$output .='<dl><dt><i class="moon-twitter"></i></dt><dd>';

                

	    	    		$output .= '<span class="message">'.$message['text'].'<span>';

	    	    		$output .= '<span class="date">'.date_i18n( $time_format, $message['created'] + $message['user']['utc_offset']).'</span>';

    	    		$output .= '</dd></dl>';

    			}

            }else if($used_for == 'box_content'){

                foreach ($tweets as $message)

    	    	{	

    	    		$output .= '<dl class="span'.(12/$count).'">';

	    	    		$output .= '<dd><span class="message">'.$message['text'].'</span>';

	    	    		$output .= '<span class="date">'.date_i18n( $time_format, $message['created'] + $message['user']['utc_offset']).'</span></dd>';

    	    		$output .= '</dl>';

    			    

                }

            }

	    }

	

		

		if($output != "")

		{

			if($used_for == 'sidebar')

                $filtered_message = "<ul class='tweet_list'>$output</ul>";

            else

                $filtered_message = "<ul class='tweet_list row'>$output</ul>";

		}

		else

		{

			if($used_for == 'sidebar')

                $filtered_message = "<ul class='tweet_list'><li>No public Tweets found</li></ul>";

            else

                $filtered_message = '<p>No public Tweets found</p>';

		}

		

		return $filtered_message;

}






function filter($text) {

    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);

    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);    

    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);

    $text = preg_replace("/#(\w+)/", "<a class=\"twitter-link\" href=\"http://search.twitter.com/search?q=\\1\">#\\1</a>", $text);

    $text = preg_replace("/@(\w+)/", "<a class=\"twitter-link\" href=\"http://twitter.com/\\1\">@\\1</a>", $text);



    return $text;

}



class ListContentWidget extends WP_Widget{


    function ListContentWidget(){

        $options = array('classname' => 'list_content', 'description' => 'A widget to create a list for box content (Columns) page builder' );

		$this->WP_Widget( 'list_content', THEMENAME.' List Content', $options );

    }


    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo $before_widget;

        

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

		$content_title1 = empty($instance['content_title1']) ? '' : $instance['content_title1'];

        $content_img1 = empty($instance['content_img1']) ? '' : $instance['content_img1'];

        $content_link1 = empty($instance['content_link1']) ? '' : $instance['content_link1'];

        $content_title2 = empty($instance['content_title2']) ? '' : $instance['content_title2'];

        $content_img2 = empty($instance['content_img2']) ? '' : $instance['content_img2'];

        $content_link2 = empty($instance['content_link2']) ? '' : $instance['content_link2'];

		$content_title3 = empty($instance['content_title3']) ? '' : $instance['content_title3'];

        $content_img3 = empty($instance['content_img3']) ? '' : $instance['content_img3'];

        $content_link3 = empty($instance['content_link3']) ? '' : $instance['content_link3'];

		

        if ( !empty( $title )) { 

		      echo $before_title . $title . $after_title; 

        }

                $output = '<ul>';

                 $output .=   '                 <li><img src="'.$content_img1.'"><a href="'.$content_link1.'">'.$content_title1.'</a></li>';

                $output .=    '                 <li><img src="'.$content_img2.'"><a href="'.$content_link2.'">'.$content_title2.'</a></li>';

                $output .=    '                 <li><img src="'.$content_img3.'"><a href="'.$content_link3.'">'.$content_title3.'</a></li>';

                $output .='</ul>';

            

        

        

        

		echo $output;

        echo $after_widget;

    }


    public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['title'] = strip_tags( $new_instance['title'] );

        $instance['content_title1'] = strip_tags( $new_instance['content_title1'] );

        $instance['content_img1'] = $new_instance['content_img1'];

        $instance['content_link1'] = $new_instance['content_link1'];

        $instance['content_title2'] = strip_tags( $new_instance['content_title2'] );

        $instance['content_img2'] = $new_instance['content_img2'];

        $instance['content_link2'] = $new_instance['content_link2'];

        $instance['content_title3'] = strip_tags( $new_instance['content_title3'] );

        $instance['content_img3'] = $new_instance['content_img3'];

        $instance['content_link3'] = $new_instance['content_link3'];

  		return $instance;

	}


    public function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => 'Services & More', 'content_title1' => '', 'content_img1' => '', 'content_link1' => '', 'content_title2' => '', 'content_img2' => '', 'content_link2' => '', 'content_title3' => '', 'content_img3' => '', 'content_link3' => '' ) );

        $title = isset($instance['title']) ? strip_tags($instance['title']): "";

        $content_title1 = isset($instance['content_title1']) ? strip_tags($instance['content_title1']): "";

        $content_img1 = isset($instance['content_img1']) ? strip_tags($instance['content_img1']): "";

        $content_link1 = isset($instance['content_link1']) ? strip_tags($instance['content_link1']): "";

        $content_title2 = isset($instance['content_title2']) ? strip_tags($instance['content_title2']): "";

        $content_img2 = isset($instance['content_img2']) ? strip_tags($instance['content_img2']): "";

        $content_link2 = isset($instance['content_link2']) ? strip_tags($instance['content_link2']): "";

        $content_title3 = isset($instance['content_title3']) ? strip_tags($instance['content_title3']): "";

        $content_img3 = isset($instance['content_img3']) ? strip_tags($instance['content_img3']): "";

        $content_link3 = isset($instance['content_link3']) ? strip_tags($instance['content_link3']): "";

        ?>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title: 

    		<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title'));; ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('content_title1')); ?>">First Row Title: 

    		<input id="<?php echo esc_attr($this->get_field_id('content_title1')); ?>" name="<?php echo esc_attr($this->get_field_name('content_title1')); ?>" type="text" value="<?php echo esc_attr($content_title1); ?>" /></label>

        </p>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('content_img1')); ?>">First Row Img: 

    		<input id="<?php echo esc_attr($this->get_field_id('content_img1')); ?>" name="<?php echo esc_attr($this->get_field_name('content_img1')); ?>" type="text" value="<?php echo esc_attr($content_img1); ?>" /></label>

        </p>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('content_link1')); ?>">First Row Link: 

    		<input id="<?php echo esc_attr($this->get_field_id('content_link1')); ?>" name="<?php echo esc_attr($this->get_field_name('content_link1')); ?>" type="text" value="<?php echo esc_attr($content_link1); ?>" /></label>

        </p>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('content_title2')); ?>">Second Row Title: 

    		<input id="<?php echo esc_attr($this->get_field_id('content_title2')); ?>" name="<?php echo esc_attr($this->get_field_name('content_title2')); ?>" type="text" value="<?php echo esc_attr($content_title2); ?>" /></label>

        </p>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('content_img2')); ?>">Second Row Img: 

    		<input id="<?php echo esc_attr($this->get_field_id('content_img2')); ?>" name="<?php echo esc_attr($this->get_field_name('content_img2')); ?>" type="text" value="<?php echo esc_attr($content_img2); ?>" /></label>

        </p>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('content_link2')); ?>">Second Row Link: 

    		<input id="<?php echo esc_attr($this->get_field_id('content_link2')); ?>" name="<?php echo esc_attr($this->get_field_name('content_link2')); ?>" type="text" value="<?php echo esc_attr($content_link2); ?>" /></label>

        </p>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('content_title3')); ?>">Third Row Title: 

    		<input id="<?php echo esc_attr($this->get_field_id('content_title3')); ?>" name="<?php echo esc_attr($this->get_field_name('content_title3')); ?>" type="text" value="<?php echo esc_attr($content_title3); ?>" /></label>

        </p>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('content_img3')); ?>">Third Row Img: 

    		<input id="<?php echo esc_attr($this->get_field_id('content_img3')); ?>" name="<?php echo esc_attr($this->get_field_name('content_img3')); ?>" type="text" value="<?php echo esc_attr($content_img3); ?>" /></label>

        </p>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('content_link3')); ?>">Third Row Link: 

    		<input id="<?php echo esc_attr($this->get_field_id('content_link3')); ?>" name="<?php echo esc_attr($this->get_field_name('content_link3')); ?>" type="text" value="<?php echo esc_attr($content_link3); ?>" /></label>

        </p>

		

        

        <?php

    }

    

}


class VideoWidget extends WP_Widget{

    

    function VideoWidget(){

        $options = array('classname' => 'video_widget', 'description' => 'Add a video' );

		$this->WP_Widget( 'video_widget', THEMENAME.' Video', $options );

    }


    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo $before_widget;

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        $video = empty($instance['video']) ? '' : $instance['video'];

        $video_ = '<div class="visual">';

		

		if(themeple_backend_is_file($video, 'html5video'))

					{

						$video_ .= themeple_html5_video_embed($video);

					}

					else if(strpos($video,'<iframe') !== false)

					{

						$video_ .= $video;

					}

					else

					{

						global $wp_embed;

						$video_ .= $wp_embed->run_shortcode("[embed]".trim($video)."[/embed]");

					}

					

					if(strpos($video, '<a') === 0)

					{

						$video_ .= '<iframe width="width:220px" src="'.esc_url($video).'"></iframe>';

					}

		if (!empty( $title )) { 

		      echo $before_title . $title . $after_title; 

        }

        $video_ .= '</div>';

        echo $video_; 

        

		

        echo $after_widget;

    }


    function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['video'] = $new_instance['video'];

        return $instance;

    }


    function form($instance){

        $instance = wp_parse_args( (array) $instance, array('title'=>'Video Widget',  'video' => '') );

        $video = isset($instance['video']) ? $instance['video']: "";

        $title = isset($instance['title']) ? strip_tags($instance['title']): "";

        ?>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title: 

    		<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('video')); ?>">Video: 

    		<input id="<?php echo esc_attr($this->get_field_id('video')); ?>" name="<?php echo esc_attr($this->get_field_name('video')); ?>" type="text" value="<?php echo esc_attr($video); ?>" /></label>

        </p>

        <?php

    }

}



class FooterLogoDesc extends WP_Widget{


    function FooterLogoDesc(){

        $options = array('classname' => 'footerlogo_widget', 'description' => 'Add you footer logo and content' );

        $this->WP_Widget( 'footerlogo_widget', THEMENAME.'Footer Logo and Description', $options );

    }


    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

        echo $before_widget;

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        $content = empty($instance['content']) ? '' : $instance['content'];

        $footerlogodesc= '<div class="footerlogodesc"> ';

        $logo = themeple_get_option('logo_light');

        if(!empty($logo)){
 
          $footerlogodesc.='<div class="footerlogodesc_logo"><img src="'.esc_url($logo).'" /></div>';
        }

        $footerlogodesc.='<div class="footerlogodesc_content">'.do_shortcode($content).'</div>';

        $footerlogodesc.='</div>';

        echo $footerlogodesc;

        echo $after_widget;

    }

    
    function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['content'] = $new_instance['content'];

        return $instance;

    }



    function form($instance){

        $instance = wp_parse_args( (array) $instance, array('title'=>'Footer Logo',  'content' => '') );

        $content = isset($instance['content']) ? $instance['content']: "";

        $title = isset($instance['title']) ? strip_tags($instance['title']): "";

        ?>

        <p>

            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title: 

            <input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title'));; ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        <p>

            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>">Content: 

            <textarea id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>"> <?php echo esc_attr($content); ?> </textarea></label>

        </p>

        <?php

    }

}

class SocialWidget extends WP_Widget{



    function SocialWidget(){

        $options = array('classname' => 'social_widget', 'description' => 'Add a social widget' );

		$this->WP_Widget( 'social_widget', THEMENAME.' Social Widget', $options );

    }

    

    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo $before_widget;

        

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        $text = empty($instance['text']) ? '' : $instance['text'];

        $social_icons = themeple_get_option('social_icons');

        

        echo $before_title . $title . $after_title;
	 

        echo '<div class="row-fluid social_row">';

        	echo '<div class="span12">';



        		echo '<ul class="footer_social_icons">';
        			if(is_array($social_icons))
                    foreach($social_icons as $icon):



        				echo '<li class="'.$icon['social'].'"><a href="'.$icon['link'].'"><i class="moon-'.$icon['social'].'"></i></a></li>';



        			endforeach;



        		echo '</ul>';



        	echo '</div>';

        echo '</div>';


        echo $after_widget;

    }



    function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = $new_instance['title'];

        $instance['text'] = $new_instance['text'];

        return $instance;

    }


    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";

        $text = isset($instance['text']) ? $instance['text']: "";

        ?>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title: 

    		<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title'));; ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('text')); ?>">Text: 

    		<textarea id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" ><?php echo esc_attr($text); ?></textarea>

        </p>

        <?php

    }

}







class FlickrWidget extends WP_Widget{



    function FlickrWidget(){

        $options = array('classname' => 'widget_flickr', 'description' => 'Add a flickr list' );

		$this->WP_Widget( 'widget_flickr', THEMENAME.' Widget Flickr', $options );

    }



    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo $before_widget;

        

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        $user_id = empty($instance['user_id']) ? '' : $instance['user_id'];

        

        if ( !empty( $title ) ) { 

		      echo $before_title . $title . $after_title; 

        }

        echo '<div class="flickr_container">';

        echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=6&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user='.esc_attr($user_id).'"></script>';

        echo '</div>';

        

        echo $after_widget;

    }

    



    function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = $new_instance['title'];

        $instance['user_id'] = $new_instance['user_id'];

        return $instance;

    }



    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'user_id' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";

        $user_id = isset($instance['user_id']) ? $instance['user_id']: "";

        ?>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title: 

    		<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title'));; ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('used_id')); ?>">User Id: 

    		<input id="<?php echo esc_attr($this->get_field_id('user_id')); ?>" name="<?php echo esc_attr($this->get_field_name('user_id')); ?>" type="text" value="<?php echo esc_attr($user_id); ?>" /></label>

        </p>

        <?php

    }

}









class SubscribersWidget extends WP_Widget{



    function SubscribersWidget(){

        $options = array('classname' => 'widget_subscribers', 'description' => 'Add a widget to display the number of followers on twitter and rss subscribers' );

		$this->WP_Widget( 'widget_subscribers', THEMENAME.' Widget Subscribers', $options );

    }



    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo $before_widget;

        

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        $text_description = empty($instance['text_description']) ? '' :  $instance['text_description'];

        


        if ( !empty( $title ) ) { 

		      echo $before_title . $title . $after_title; 

        }

        $social_icons = themeple_get_option('social_icons');

         echo '<div class="row-fluid social_">';

        	echo '<div class="span12">'.$text_description.'</div>';

        echo '</div>';
        

         echo '<div class="row-fluid social_ mail_sub">';

        /*	echo '<div class="span12"><input type="text" class="subscribe" id="appendedInputButton" value="Enter Your Email Address" /><a class="btn" href="">Send</a></div>';*/
         mailchimpSF_signup_form();


        echo '</div>';

        

        echo '<div class="row-fluid social_row">';

        	echo '<div class="span12">';



        		echo '<ul class="footer_social_icons">';
        			foreach($social_icons as $icon):



        				echo '<li class="'.$icon['social'].'"><a href="'.$icon['link'].'"><i class="moon-'.$icon['social'].'"></i></a></li>';



        			endforeach;



        		echo '</ul>';



        	echo '</div>';

        echo '</div>';







        ?>


        <?php

        

        echo $after_widget;

    }

    



    function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = $new_instance['title'];

        $instance['text_description'] = $new_instance['text_description'];


        return $instance;

    }



    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text_description' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";

        $text_description = isset($instance['text_description']) ? $instance['text_description']: "";

       

        ?>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title: 

    		<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title'));; ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('text_description')); ?>">Text Description: 

    		<textarea id="<?php echo esc_attr($this->get_field_id('text_description')); ?>" name="<?php echo esc_attr($this->get_field_name('text_description')); ?>" ><?php echo esc_attr($text_description); ?></textarea></label>

        </p>

        <?php

    }

}



function getTwitCount($user='codeforest'){

    $apiurl = "http://api.twitter.com/1/users/show.json?screen_name={$user}";



    $transientKey = "cfTwitterFollowers";



    $cached = get_transient($transientKey);



    if (false !== $cached) {

        return $cached;

    }



    // Request the API data, using the constructed URL

    $remote = wp_remote_get(esc_url($apiurl));



    // If the API data request results in an error, return

    // some number <img src="http://www.codeforest.net/wp-includes/images/smilies/icon_smile.gif" alt=":)" class="wp-smiley" style="opacity: 1; visibility: visible; "> 

    if (is_wp_error($remote)) {

        return '256';

    }

    $data = json_decode( $remote['body'] );

    $output = $data->followers_count;

    set_transient($transientKey, $output, 600);

    

    return $output;

}

function get_shares($url) {    



  $json_string = file_get_contents("http://www.linkedin.com/countserv/count/share?url=$url&format=json");



  $json = json_decode($json_string, true);



  return intval( $json['count'] );

}


function fb_fanpage_count($fanpage_id) {

	$data = wp_remote_get('http://api.facebook.com/restserver.php?method=facebook.fql.query&query=SELECT%20fan_count%20FROM%20page%20WHERE%20page_id='.$fanpage_id.'');

	$count = get_transient('fan_count');

	



	if (is_wp_error($data)) {

		return 'Error';

	}else{

		$count = strip_tags($data[body]);

	}

	set_transient('fan_count', $count, 60*60*24); // 24 hour cache

	return $count;

}



class RecentContentWidget extends WP_Widget{



    function RecentContentWidget(){

        $options = array('classname' => 'widget_recent_content', 'description' => 'Add a widget to display recent and popular posts' );

        $this->WP_Widget( 'widget_recent_content', THEMENAME.' Widget Recent Content', $options );

    }



    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

        echo $before_widget;


        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        $number_of_posts = empty($instance['number_of_posts'])? '' : $instance['number_of_posts'];


            if ( !empty( $title ) ) { 

              echo $before_title . $title . $after_title; 

        }        ?>
     

                          

                            <div id="popular_widget">

                                <?php   

                                query_posts('showposts='.$number_of_posts.'&orderby=comment_count&order=desc');

                                while (have_posts()) : the_post();

                                    ?>

                                    <dl>
                                     
                                     <dt>
                                         
                                      <?php 
                                        $post_id = get_the_ID();
                                        $post_format = get_post_format($post_id);
                                        if(strlen($post_format) == 0) 
                                         $post_format = 'standard';
                                              if($post_format == 'standard'){
                                                    $icon_class="pencil";
                                                }elseif($post_format == 'audio'){
                                                    $icon_class="music";
                                                }elseif($post_format == 'soundcloud'){
                                                    $icon_class="music";
                                                }elseif($post_format == 'video'){
                                                    $icon_class="play";
                                                }elseif($post_format == 'quote'){
                                                    $icon_class="bubble";
                                                }elseif($post_format == 'gallery'){
                                                    $icon_class="image";
                                                }elseif($post_format == 'image'){
                                                    $icon_class="images";
                                                }
                                         
                                         ?>
                                         <i class='moon-<?php echo esc_attr($icon_class) ?>'></i>
                                      </dt>
                                    
                                      <dd>   
                                            <div class="title"><a href="<?php echo get_permalink() ?>"><?php echo themeple_text_limit(get_the_title(), 5) ?></a></div>

                                            <span><?php echo get_the_date() ?></span>

                                     </dd>

                                    </dl>

                                    <?php

                                endwhile;   

                                wp_reset_postdata();

                                ?>

                            </div>

                      


                   

     

  

        <?php

        

        echo $after_widget;

    }

    



    function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = $new_instance['title'];

        $instance['number_of_posts'] = $new_instance['number_of_posts'];

        return $instance;

    }



    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'number_of_posts' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";

        $number_of_posts = isset($instance['number_of_posts']) ? $instance['number_of_posts']: "";

        ?>

        <p>

            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title: 

            <input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title'));; ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        

        <p>

            <label for="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>">Number of posts: 

            <input id="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('number_of_posts')); ?>" type="text" value="<?php echo esc_attr($number_of_posts); ?>" /></label>

        </p>

       

        <?php

    }

}




class SlideshowWidget extends WP_Widget{



    function SlideshowWidget(){

        $options = array('classname' => 'widget_slider', 'description' => 'Add a widget to display a slider' );

		$this->WP_Widget( 'widget_slider', THEMENAME.' Widget Slider', $options );

    }



    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo $before_widget;

        

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        $post = empty($instance['post']) ? '' : $instance['post'];

        $page = empty($instance['page']) ? '' : $instance['page'];



        if ( !empty( $title ) ) { 

		      echo $before_title . $title . $after_title; 

        }

        $the_id = 0;

        $the_id = $page;

        $the_id = (($post != 0)? $post : $page);

        $slider = new themeple_slideshow($the_id, 'flexslider'); 

        if($slider && $slider->slide_number > 0){

	        $sliderHtml = $slider->render_slideshow();

	        echo $sliderHtml;   

	    }

        

        echo $after_widget;

    }

    



    function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = $new_instance['title'];

        $instance['post'] = $new_instance['post'];

        $instance['page'] = $new_instance['page'];

        return $instance;

    }



    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'post' => '', 'page' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";

        $post = isset($instance['post']) ? $instance['post']: "";

        $page = isset($instance['page']) ? $instance['page'] : "";

        ?>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title: 

    		<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title'));; ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('post')); ?>">Post: 

    		<select  id="<?php echo esc_attr($this->get_field_id('post')); ?>" name="<?php echo esc_attr($this->get_field_name('post')); ?>">

				<option value="0">--Select--</option>

				<?php 

					$elements = "";

					$entries = get_posts('title_li=&orderby=name&numberposts=9999');

					

					foreach ($entries as $key => $name)

					{

						$selected = "";

						if($name->ID == $post) $selected = 'selected="selected"';

					

						$elements .= "<option $selected value='$name->ID'>$name->post_title</option>";

					}

					$elements .= "</select>";

					echo $elements;

				?>

		</p>

       

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('page')); ?>">or page to get slides to be used: 

    		<select  id="<?php echo esc_attr($this->get_field_id('page')); ?>" name="<?php echo esc_attr($this->get_field_name('page')); ?>">

				

				<option value="0">--Select--</option>	

				<?php 

					$elements = "";

					$entries = get_pages('title_li=&orderby=name');

					foreach ($entries as $key => $name)

					{

						$selected = "";

						if($name->ID == $page) $selected = 'selected="selected"';

					

						$elements .= "<option $selected value='$name->ID'>$name->post_title</option>";

					}

					$elements .= "</select>";

					echo $elements;

				?>

		</p>	



        <?php

    }

}


class ShortcodeWidget extends Wp_Widget{
 
 function ShortcodeWidget(){

        $options = array('classname' => 'widget_shortcode', 'description' => 'Add a text widget to show shortcodes' );

		$this->WP_Widget( 'widget_shortcode', THEMENAME.' Widget Shortcode', $options );

    }

 function widget($atts, $instance){

      extract($atts, EXTR_SKIP);

	    echo $before_widget;
    

        $title = empty($instance['title']) ? '' : $instance['title'];

        $content = empty($instance['content']) ? '' : $instance['content'];
               
            if ( !empty( $title ) ) { 

		      echo $before_title . $title . $after_title; 

        }
        	  echo '<div class="row-fluid">';

        	      echo do_shortcode($content);

        		echo '</div>';

        		
       
       echo $after_widget; 

    }     


function update($new_instance, $old_instance){

        $instance = array();
 
        $instance['title'] = $new_instance['title'];

        $instance['content'] = $new_instance['content'];

        return $instance;

    }

 function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'content' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";

        $content = isset($instance['content']) ? $instance['content']: "";


        ?>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title: 

    		<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title'));; ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        

         <p>

    		<label for="<?php echo esc_attr($this->get_field_id('content')); ?>">Text & Shortcodes: 

  <textarea id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" type="text"><?php echo esc_attr($content); ?></textarea>

  			</label>

        </p>



        <?php

    }




}
/** End Text Shortcodes  **/ 

class ContactWidget extends WP_Widget{



    function ContactWidget(){

        $options = array('classname' => 'widget_contact', 'description' => 'Add a widget to display a subscribers input and some little info ' );

		$this->WP_Widget( 'widget_contact', THEMENAME.' Widget Contact', $options );

    }



    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo $before_widget;

        

        

        $large_phone = empty($instance['large_phone']) ? '' : $instance['large_phone'];

        $google_map_text = empty($instance['google_map_text']) ? '' : $instance['google_map_text'];

		$link = empty($instance['link']) ? '' : $instance['link'];

        

        echo '<div class="subscribers row-fluid">';

        	echo '<div class="span12">';

        		echo '<div class="row-fluid">';

        		echo '<h5>Subscribe to our newsletter</h5>';

        		echo '<input type="text" placeholder="Enter your email"><button class="btn">Subscribe</button>';

        		echo '</div>';

        	echo '</div>';



        echo '</div>';

        echo '<h2>'.$large_phone.'</h2>';

        echo '<dl><dt></dt><dd><a href="'.$link.'">'.$google_map_text.'</a></dd></dl>';

        

        echo $after_widget;

    }

    



    function update($new_instance, $old_instance){

        $instance = array();

        $instance['large_phone'] = $new_instance['large_phone'];

        $instance['google_map_text'] = $new_instance['google_map_text'];

        $instance['link'] = $new_instance['link'];

        return $instance;

    }



    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'large_phone' => '', 'google_map_text' => '', 'link' => '') );

        $large_phone = isset($instance['large_phone']) ? $instance['large_phone']: "";

        $google_map_text = isset($instance['google_map_text']) ? $instance['google_map_text']: "";

        $link = isset($instance['link']) ? $instance['link']: "";

        ?>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('large_phone')); ?>">Phone Text: 

    		<input id="<?php echo esc_attr($this->get_field_id('large_phone')); ?>" name="<?php echo esc_attr($this->get_field_name('large_phone')); ?>" type="text" value="<?php echo esc_attr($large_phone); ?>" /></label>

        </p>

        

         <p>

    		<label for="<?php echo esc_attr($this->get_field_id('google_map_text')); ?>">Location Text: 

    		<input id="<?php echo esc_attr($this->get_field_id('google_map_text')); ?>" name="<?php echo esc_attr($this->get_field_name('google_map_text')); ?>" type="text" value="<?php echo esc_attr($google_map_text); ?>" /></label>

        </p>



        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('link')); ?>">Link: 

    		<input id="<?php echo esc_attr($this->get_field_id('link')); ?>" name="<?php echo esc_attr($this->get_field_name('link')); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></label>

        </p>



        <?php

    }

}
class TopInfoWidget extends WP_Widget{



    function TopInfoWidget(){

        $options = array('classname' => 'widget_topinfo', 'description' => 'Add a widget to display top information email and phone' );

        $this->WP_Widget( 'widget_topinfo', THEMENAME.' Widget Top Info', $options);

    }



    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

        echo $before_widget;

        

        

        $phone = empty($instance['phone']) ? '' : $instance['phone'];

        $email = empty($instance['email']) ? '' : $instance['email'];

        

        echo '<div class="topinfo">';

                echo '<span class="phone"><i class="moon-phone"></i>'.$phone.'</span>';

                echo '<span class="email"><i class="icon-envelope"></i>'.$email.'</span>';

                
         echo '</div>';

        

        echo $after_widget;

    }

    



    function update($new_instance, $old_instance){

        $instance = array();

        $instance['phone'] = $new_instance['phone'];

        $instance['email'] = $new_instance['email'];

        return $instance;

    }



    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'phone' => '', 'email' => '') );

        $large_phone = isset($instance['phone']) ? $instance['phone']: "";

        $google_map_text = isset($instance['email']) ? $instance['email']: "";


        ?>

        <p>

            <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>">Phone Number: 

            <input id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>" /></label>

        </p>

        

         <p>

            <label for="<?php echo esc_attr($this->get_field_id('email')); ?>">Emai:l 

            <input id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></label>

        </p>




        <?php

    }

}


class ContactInfoWidget extends WP_Widget{



    function ContactInfoWidget(){

        $options = array('classname' => 'widget_contact_info', 'description' => 'Add a widget to display your contact information' );

		$this->WP_Widget( 'widget_contact_info', THEMENAME.' Widget Contact Info', $options );

    }



    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo $before_widget;

        

        $title = empty($instance['title']) ? '' : $instance['title'];


        $address = empty($instance['address']) ? '' : $instance['address'];

        $phone = empty($instance['phone']) ? '' : $instance['phone'];

        $email = empty($instance['email']) ? '' : $instance['email'];

       

        



		if ( !empty( $title ) ) { 

		      echo $before_title . $title . $after_title; 

        }
        if(isset($desc))

            echo '<p>'.$desc.'</p>';

        echo '<ul>';

            if(!empty($address))
                echo '<li class="address"><i class="moon-location"></i><span>'.__('Address:', 'themeple').'</span><br /><span>'.$address.'</span></li>';
            if(!empty($email))
                echo '<li class="email"><i class="moon-envelop"></i><span>'.__('Email:', 'themeple').'</span><br /><span>'.$email.'</span></li>';
        	if(!empty($phone))
        		echo '<li class="phone"><i class="moon-phone"></i><span>'.__('Phone:', 'themeple').'</span><br /><span>'.$phone.'</span></li>';
        	
           

        echo '</ul>';

        

        echo $after_widget;

    }

    



    function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = $new_instance['title'];

        $instance['address'] = $new_instance['address'];

        $instance['phone'] = $new_instance['phone'];

        $instance['email'] = $new_instance['email'];

      

        return $instance;

    }



    function form($instance){

        $instance = wp_parse_args( (array) $instance, array('title' => '', 'address' => '', 'phone' => '', 'email' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";

        $address = isset($instance['address']) ? $instance['address']: "";

        $phone = isset($instance['phone']) ? $instance['phone']: "";

        $email = isset($instance['email']) ? $instance['email']: "";


      

        ?>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title 

    		<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title'));; ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

       

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('address')); ?>">Address 

    		<input id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" type="text" value="<?php echo esc_attr($address); ?>" /></label>

        </p>

        

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('phone')); ?>">Phone 

    		<input id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>" /></label>

        </p>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('email')); ?>">Email 

    		<input id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr( $this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></label>

        </p>

         


        <?php

    }

}




class TopNavWidget extends WP_Widget{



    function TopNavWidget(){

        $options = array('classname' => 'widget_topnav', 'description' => 'A widget that can be used only for the top navigation widgetized area' );

		$this->WP_Widget( 'widget_topnav', THEMENAME.' Widget Top Navigation', $options );

    }



    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo $before_widget;

        

    

        $serialize_ = empty($instance['serialize_']) ? '' :  $instance['serialize_'];

        
       

        

        $selected = unserialize($serialize_);
        
       

        $output = '';
        

       if(!empty($selected)){

 
	   
	    if(in_array("login", $selected)){
	    
	        echo '<div class="login small_widget">';
	        	echo '<div class="widget_activation">';
                if (!is_user_logged_in()){
                echo '<a href="#" data-box="login">'.__('Welcome Guest. Login', 'themeple').'</a></div>';
	        	echo '<div class="top_nav_sub login">';
	        

		?>
               <div class="sub-loggin"> 
                 <form action="<?php echo esc_url(home_url()); ?>/wp-login.php" method="post">
		  	<input type="text" name="log" id="log" value="<?php echo esc_html(stripslashes($user_login)) ?>" size="20" placeholder="<?php _e('Username', 'themeple') ?>" />
			<input type="password" name="pwd" id="pwd" size="20" placeholder="<?php _e('Password', 'themeple') ?>"/>
			<input type="submit" name="submit" value="Send" class="button" />
    		
    		 <div class="check-login">	
       			<label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me</label>
       		</div>
       			<input type="hidden" name="redirect_to" value="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" />
    		
		  </form>
		  <a href="<?php echo esc_url(home_url()); ?>/wp-login.php?action=lostpassword">Recover password</a> </div><?php
			} else { ?>
			<div class="aaaa">
			 <?php

             global $current_user; get_currentuserinfo();

              echo '<a href="#" data-box="login">'.__("Welcome, " . $current_user->user_login , "themeple"). '</a></div>';
         

             ?>


                     <?php
			 }
	        	echo '</div>';
	    	echo '</div>';


			 }

		if(in_array("multilanguage", $selected)){
	    
	        echo '<div class="multilanguage small_widget">';
                echo '<div class="widget_activation">';
	        	echo '<a href="#" data-box="multilanguage">'.__('Select Language', 'themeple').'</a></div>';

	        	echo '<div class="top_nav_sub multilanguage aaaa">';
                
                        do_action('icl_language_selector');
                     	
	        	echo '</div>';
	    	echo '</div>';



	    }	

        if(in_array("cart", $selected) && class_exists('Woocommerce')){
            $icon = '';
            echo '<div class="headecart small_widget">';
            echo '<div class="widget_activation">';
            global $woocommerce;
            if($woocommerce->cart->cart_contents_count != 0){
                $icon = 'cart-items-active';
            }
            echo '<a href="#" data-box="headcart" class="nr">'.__('Shoping Cart', 'themeple').'</a><span class="'.$icon.'"></span></div>';
                echo '<div class="top_nav_sub headcart ">';
                
             

                        if(class_exists('Woocommerce')):
                            get_template_part('template_inc/woocommerce','cart');
                        endif; 

            
          

                echo '</div>';
            echo'</div>';


        }
        
        if(in_array("search", $selected)){
        
            echo '<div class="header_search">';
                  echo '<div class="right_search">';
                     echo '<i class="moon-search-3"></i>';
                        echo '</div>';
                    echo '<div class="right_search_container">' ;
                    get_search_form();
                    echo '</div>';
            echo  '</div>';


        }

    }
        ?>


        <?php

        

        echo $after_widget;

    }

    



    function update($new_instance, $old_instance){

        $instance = array();

       

        $instance['serialize_'] = serialize($new_instance['serialize_']);


        return $instance;

    }



    function form($instance){

        $instance = wp_parse_args( (array) $instance, array(  'serialize_' => '') );

        

        $serialize_ = isset($instance['serialize_']) ? $instance['serialize_']: "";
        $serialize_ = unserialize($serialize_);
        $all = array( 'login', 'multilanguage', 'search');
        if(class_exists('Woocommerce'))
            $all[] = 'cart';
       

        ?>


        

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('serialize_')); ?>">Select the features you want to activate: 

    		<select  id="<?php echo esc_attr($this->get_field_id('serialize_')); ?>" name="<?php echo esc_attr($this->get_field_name('serialize_')); ?>[]" multiple="multiple">

				<?php 

				$elements = "";

				foreach($all as $e)

				{

					$selected = "";

					if(in_array($e, $serialize_)) $selected = 'selected="selected"';

				

					$elements .= "<option $selected value='$e'>$e</option>";

				}

				$elements .= "</select>";

				echo $elements;

				?>


        </p>

        <?php

    }

}


class MostPopularWidget extends WP_Widget{



    function MostPopularWidget(){

        $options = array('classname' => 'widget_most_popular', 'description' => 'Add a widget to show the most popular posts' );

		$this->WP_Widget( 'widget_most_popular', THEMENAME.' Widget Popular Posts', $options );

    }


 
    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo $before_widget;

        

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        $number_of_posts = empty($instance['number_of_posts']) ? '' : $instance['number_of_posts'];

        

        

        

        if ( !empty( $title ) ) { 

		      echo $before_title . $title . $after_title; 

        }

        echo '<ul>';

        query_posts('showposts='.$number_of_posts);

        while (have_posts()) : the_post();
        	$post_id = get_the_ID();
        	$post_format = get_post_format($post_id);

            echo '<li>';
           
            echo '<dl class="dl-horizontal">';
            echo '<dt><span class="date">'.get_the_time('d').'</span><span class="month"><span>'.get_the_time('M').'</span>, <span>'.get_the_time('Y').'</span></span></dt>';
	        echo '<dd>';
            echo '<p class="info">'.themeple_excerpt(9).'</p><a href="'.get_permalink().'" class="link">'.__("Read More", "themeple").'</a></dd></dl>';
	       

            echo '</li>';

        endwhile;

        echo '</ul>';

        echo $after_widget;

    }

    



    function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = $new_instance['title'];

        $instance['number_of_posts'] = $new_instance['number_of_posts'];

        

        return $instance;

    }



    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'number_of_posts' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";

        $number_of_posts = isset($instance['number_of_posts']) ? $instance['number_of_posts']: "";

        

        ?>

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title: 

    		<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title'));; ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        

        <p>

    		<label for="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>">Number of posts: 

    		<input id="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('number_of_posts')); ?>" type="text" value="<?php echo esc_attr($number_of_posts); ?>" /></label>

        </p>

        

        

        <?php

    }

}


















?>