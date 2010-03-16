<?php

class GetContactsForm extends sfForm
{
 
  public function configure()
  {  
  	
  	 /**********************************
     *    Widget Schema Definition     *
     ***********************************/
		$this->setWidgets(array(
			'email'       => new sfWidgetFormInput(array(), array("class" => "email")),
		  'password'    => new sfWidgetFormInputPassword(),
		  'provider'    => new sfWidgetFormSelect(array('choices' => self::getProviders())),
			));
			
		$this->widgetSchema->setLabels(array(
			'email'      => 'Email address',
			'password'   => 'Password',
			'provider'   => 'Provider'
			));

	  $this->setDefaults(array(
	   'email' => 'Your Email Here' 
	  ));
	  
	  $this->widgetSchema->setFormFormatterName('table'); 
    $this->widgetSchema->setNameFormat('openInviter[%s]');
	  
    
    
    /*************************************
     *   Validator Schema Definition     *
     *************************************/	  
	  $this->setValidators(array(
		    'email'   => new sfValidatorEmail(
			                     array('required' => true), 
			                     array('required' => 'Email address is required',
			                           'invalid' =>  'Email address is invalid.')
	                   ),
	                   
	     'password' => new sfValidatorString( 
                            array('required' => true),
                            array('required' => 'The password is required')
                     ),
                                        
      'provider' => new sfValidatorChoice(array('choices' => array_keys(self::validateProviders())))
    ));
    
		

    /*************************************
     *   POST Validation Schema          *
     *************************************/  
    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'checkProviderLogin')))
    );

	}
	
	
	
	public function getProviders()
	{
		$inviter =new LetscodOpenInviter();
    return $inviter->getPlugins();
	}
	
	public function validateProviders()
	{
		$output = array();
		$inviter =new LetscodOpenInviter();
		$providers = $inviter->getPlugins();
		foreach($providers as $type => $val)
		  foreach($val as $key => $value)
		    $output[$key] = $value;
		
		return $output;
	}
	
    public function checkProviderLogin($validator, $values)
    {
    	
    	if(LetscodOpenInviter::isValidEmail($values['email']) && $values['password'])
    	{
	      $inviter =new LetscodOpenInviter();
	      $inviter->startPlugin($values['provider']);
	      $internal = $inviter->getInternalError();
	      
	      if ($internal == 1)        
	        throw new sfValidatorError($validator, 'You have to configure OpenInviter before using it');
	      elseif ($internal == 2)        
	        throw new sfValidatorError($validator, 'You have to define your message before using openInviter');
	      elseif (!$inviter->login($values['email'],$values['password']))
	        throw new sfValidatorError($validator, 'Login failed. Please check the email and password you have provided and try again later');
	      elseif (false===$contacts=$inviter->getMyContacts())
	        throw new sfValidatorError($validator, 'Unable to get contacts.');
	      
	      
	      // everything is fine,return the clean values
	      return $values;
    	}
    }
}
?>