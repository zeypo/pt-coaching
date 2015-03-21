<?php if(!defined('THEMEPLE_FRAMEWORK')) exit("Direct script access not allowed");

/**
 * themeple_form
 * 
 * @package    
 * @author roshi
 * @copyright roshi[www.themeforest.net/user/roshi]
 * @version 2012
 * @access public
 */
class themeple_form{
  var $form_elements = array();
  var $output = "";
  var $form_parameters = array();
  var $elements_html = "";
  var $check_submit = true;
  var $autoresponde_content;  
  var $errors = false;
  /**
   * themeple_form::themeple_form()
   * 
   * @param mixed $form_params
   * @return
   */
  function themeple_form($form_params){
        $this->form_parameters = $form_params;
        $this->output = '<form name="contactForm" class="'.(isset($form_params['form_class'])?$form_params['form_class']:'').' row-fluid" action="#" method="post">';
       
        
        if(!isset($_POST) || !count($_POST))
        {
    		$this->check_submit = false;
        }
  }
  
  /**
   * themeple_form::text()
   * 
   * @param mixed $id
   * @param mixed $element
   * @return
   */
  function text($id, $element){
	$id = str_replace(" ", "_", preg_replace("[^A-Za-z]", "" ,$id));
        $required = $valid = $value = "";
        if(!empty($element['check'])){
            $valid = $this->check_validation_element($id, $element);
        }
        
        if(!empty($_POST[$id])) $value = urldecode($_POST[$id]);
		if(!isset($this->form_parameters['form_class']))	
			$this->elements_html .= "<p class='".$valid."' id='element_$id'>";
		//$this->elements_html .= '<span class="label">'.$element['label'].'</span>';
		$this->elements_html .= '<input class="'.(isset($element['class'])?$element['class']:'span6').'" name="'.$id.'" placeholder="'.$element['label'].'"  type="text" id="'.$id.'" value="'.$value.'"/>';
		if(!isset($this->form_parameters['form_class']))
			$this->elements_html .= '<span class="help-inline">'.$required.'</span>';
		if(!isset($this->form_parameters['form_class']))	
			$this->elements_html .= "</p>";
  }
  
  /**
   * themeple_form::select()
   * 
   * @param mixed $id
   * @param mixed $element
   * @return
   */
  function select($id, $element){
		$id = str_replace(" ", "_", preg_replace("[^A-Za-z]", "" ,$id));
		if(empty($element['options'])) return;
		$element['options'] = explode(',',$element['options']);
			
		$required = $valid = $value = $prefilled_value = "";
			
			if(!empty($element['check'])){
                $valid = $this->check_validation_element($id, $element);
            }
			
			if(!empty($_POST[$id])) $prefilled_value = urldecode($_POST[$id]);
			$select = '';
			foreach($element['options'] as $option)
			{
				$key = $value = trim($option);
				$suboptions =  explode('|',$option);
				if(is_array($suboptions) && !empty($suboptions[1]))
				{
					$key = trim($suboptions[1]);
					$value = trim($suboptions[0]);
				}
				
			
				$active = $value == $prefilled_value ? "selected='selected'" : "";
				$select .= "<option $active value ='$key'>$value</option>";
			}
			
			if(!isset($this->form_parameters['form_class']))	
				$this->elements_html .= "<p class='".$valid."' id='element_$id'>";
			//$this->elements_html .= '<span class="label">'.$element['label'].'</span>';
			$this->elements_html .= '<select class="'.(isset($element['class'])?$element['class']:'span12').'"  placeholder="'.$element['label'].'"  name="'.$id.'" id="'.$id.'">'.$select.'</select>';
			if(!isset($this->form_parameters['form_class']))
				$this->elements_html .= '<span class="help-inline">'.$required.'</span>';
			if(!isset($this->form_parameters['form_class']))	
				$this->elements_html .= "</p>";
    }
    /**
     * themeple_form::textarea()
     * 
     * @param mixed $id
     * @param mixed $element
     * @return
     */
    function textarea($id, $element)
    {
			$id = str_replace(" ", "_", preg_replace("[^A-Za-z]", "" ,$id));
			$required = $valid = $value = "";
			
			if(!empty($element['check'])){
                $valid = $this->check_validation_element($id, $element);
            }
			
			if(!empty($_POST[$id])) $value = urldecode($_POST[$id]);
			if(!isset($this->form_parameters['form_class']))	
				$this->elements_html .= "<p class='".$valid."' id='element_$id'>";
			//$this->elements_html .= '<span class="label">'.$element['label'].'</span>';
			$this->elements_html .= '	 <textarea class="'.(isset($element['class'])?$element['class']:'span12').'"  placeholder="'.$element['label'].'"  name="'.$id.'" cols="40" rows="7" id="'.$id.'" >'.$value.'</textarea>';
			if(!isset($this->form_parameters['form_class']))
				$this->elements_html .= '<span class="help-inline">'.$required.'</span>';
			if(!isset($this->form_parameters['form_class']))	
				$this->elements_html .= "</p>";
    }
    
    /**
     * themeple_form::check_validation_element()
     * 
     * @param mixed $id
     * @param mixed $element
     * @return
     */
    function check_validation_element($id, $element)
		{	
			if(isset($_POST) && count($_POST) && isset($_POST[$id]))
			{
				switch ($element['check'])
				{
					case 'is_empty':
					
						if(!empty($_POST[$id])) return "valid";
							
					break;
					
					case 'must_empty':
					
						if(isset($_POST[$id]) && $_POST[$id] == "") return "valid";
							
					break; 
					
					case 'is_email':
					
						$this->autoresponder[] = $id;
						if(preg_match("!^\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$!", urldecode($_POST[$id]))) return "valid";
							
					break; 
					
					case 'is_number':
					
						if(preg_match("!^(\d)*$!", urldecode($_POST[$id]))) return "valid";
							
					break; 
					
					case 'is_phone':
					
						if(preg_match("!^(\d|\s|\-|\/|\(|\)|\[|\]|e|x|t|ension|\.|\+|\_|\,|\:|\;)*$!", urldecode($_POST[$id]))) return "valid";
							
					break; 
					
					
				
				}
				
				$this->check_submit = false;
				return "error";
			}
   }
   
   /**
    * themeple_form::send()
    * 
    * @return
    */
   function send()
		{
			$new_post = array();
            
			foreach ($_POST as $key => $post) 
			{
				$new_post[str_replace('themeple_','',$key)] = $post;
			}

			
			$mymail 	= empty($this->form_parameters['myemail']) ? $new_post['myemail'] : $this->form_parameters['myemail'];
			$myblogname = empty($this->form_parameters['myblogname']) ? $new_post['myblogname'] : $this->form_parameters['myblogname'];
			$subject 	= empty($new_post['subject']) ? "New Message" : $new_post['subject'];
			
			$default_from = parse_url(home_url());
			
			
			//set the email adress
			$from = "no-reply@wp-message.com";
			$usermail = false;
			
			if(!empty($default_from['host'])) $from = "no-reply@".$default_from['host'];
			
			if(!empty($this->autoresponder[0]))
			{
				$from = $_POST[$this->autoresponder[0]];
				$usermail = true;
			}
			else
			{
				$email_variations = array( 'e-mail', 'email', 'mail' );
				
				foreach($email_variations as $key)
				{
					foreach ($new_post as $current_key => $current_post)
					{
						if( strpos($current_key, $key) !== false)
						{
							$from = $new_post[$current_key];
							$usermail = true;
							break;
						}
						
					}
					
					if($usermail == true) break;
				}
			}

			$to = urldecode( $mymail );
			$from = urldecode( $from );
			$subject = urldecode( $subject  . " (sent by themeple_contact_form".$myblogname.")" );
			$message = "";
			
			
			foreach($this->form_elements as $key => $element)
			{
				
				if(!empty($new_post[str_replace(" ", "_", preg_replace("[^A-Za-z]", "" ,$key))]))
				{
					
						if($element['type'] == 'textarea') $message .= "<br/>";
						$message .= $element['label'].": ".nl2br(urldecode($new_post[str_replace(" ", "_", preg_replace("[^A-Za-z]", "" ,$key))]))."<br/>";
						if($element['type'] == 'textarea') $message .= "<br/>";
					
				}
			}
			
			
			$header  = 'MIME-Version: 1.0' . "\r\n";
			$header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$header .= 'From:'. $from . " \r\n";
			if(!wp_mail($to, $subject, $message, $header)){
				$this->errors = true;
				return false;
			}

			if($usermail && !empty($this->form_parameters['autoresponder']))
			{
				$header  = 'MIME-Version: 1.0' . "\r\n";
				$header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				$header .= 'From:'. urldecode( $this->form_parameters['autoresponder_email']) . " \r\n";
				$message = nl2br($this->form_parameters['autoresponder'])."<br/><br/><br/><strong>Your Message:</strong><br/><br/>".$message;
				if(!wp_mail($from, $this->form_parameters['autoresponder_subject'], $message, $header)){
					$this->errors = true;
					return false;
				}
			}
			
			return true;
			
			
			
    }
    /**
     * themeple_form::display_form()
     * 
     * @return
     */
    function display_form($echo = false)
		{
			$success = '<div id="ajaxresponse"></div>';
		
			if($this->check_submit && $this->send())
			{
				$success = '<div id="ajaxresponse">'.$this->form_parameters['success'].'</div>';
			}
			else
			{
				$this->output .= $this->elements_html;
				$this->output .= '<p class="perspective"><input type="submit"  value="'.esc_attr($this->form_parameters['submit']).'" class="'.esc_attr($this->form_parameters['submit_class']).' normal default" /></p>';
				if($this->errors){
					$success = '<div id="ajaxresponse">Errors while sending email. Please try again later.</div>';
				}
			}

			
			$this->output .= '</form>'.$success;
			if($echo )
                echo $this->output;
            return $this->output;
    }
    
    function create_elements($elements)
		{
			$this->form_elements = $elements;
		
			foreach($elements as $key => $element)
			{
				
			
				if(isset($element['type']) && method_exists($this, $element['type']))
				{
					$this->$element['type']('themeple_'.$key, $element);
				}
			}
    }
         
    
    
}

?>