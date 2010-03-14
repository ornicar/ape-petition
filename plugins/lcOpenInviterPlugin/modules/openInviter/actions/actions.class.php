<?php

/**
 * openInviter actions.
 *
 * @package    letscod
 * @subpackage openInviter
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class openInviterActions extends sfActions
{
  public function preExecute()
  {
    require_once sfConfig::get('sf_plugins_dir')."/lcOpenInviterPlugin/lib/helper/openInviterHelper.php";
    $this->inviter  = new LetscodOpenInviter();
    $this->plugins  = $this->inviter->getPlugins();
  }
  

  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new GetContactsForm(); 
  }
  
  
  public function executeShow(sfWebRequest $request)
  {   
    if ($this->getRequest()->isMethod('post'))
    {
       $this->form = new GetContactsForm();
       $params = $request->getParameter('openInviter');
       $this->form->bind($params);
       if ($this->form->isValid())
       {
          $this->inviter->startPlugin($params['provider']);
          $this->inviter->login($params['email'],$params['password']);
          if ($this->inviter->showContacts()) 
            $get_contacts = $this->inviter->getMyContacts();
           
          // contacts found   
          foreach($get_contacts as $email => $name)
          	 $contacts[$email] = $name." (".$email.")";
          
          $options = array ( "contacts"  =>  $contacts,
                             "email"     =>  $params['email'],
                             "password"  =>  $params['password'],
                             "provider"  =>  $params['provider'],
                             "plugType"  =>  getPluginType($this->plugins, $params['provider']),
                             "sessionId" =>  $this->inviter->plugin->getSessionID()                           
                            );

          //putting the options in a session
          $this->getUser()->setAttribute('show_inviter_options', $options);
          return $this->redirect('openInviter/invite');
       }
       else
        $this->setTemplate('index');
    }

    
  }
  
  
  public function executeInvite(sfWebRequest $request)
  {
  	$options = $this->getUser()->getAttribute('show_inviter_options');
    $this->form = new ShowContactsForm(array(), $options);
    
  	if ($this->getRequest()->isMethod('post'))
  	{
  		$params = $request->getParameter('showInviter');
  		$this->form->bind($params);
  		if ($this->form->isValid())
  		{
  			//Send the invitations
  			$msg = sfConfig::get("app_lcOpenInviter_message");
        $message = array(
                    'subject'    => $msg['subject'],
                    'body'       => $msg['body'],
                    'attachment' => " \n\r Attached message: \n\r".$params['message']
                );
                
  			$selected_contacts = $params['contacts'];
  			$this->inviter->startPlugin($params['provider']);
  			$this->inviter->login($params['email'],$params['password']);
  			$sendMessage = $this->inviter->sendMessage($params['sessionId'],$message, $selected_contacts);
        $this->inviter->logout();
        
	  		if ($sendMessage === -1)
	      {
	        $message_subject = $params['email']." ".$message['subject'];
	        $message_body    = $message['body'].$message['attachment']." \n\r\n\r".$msg['footer']; 
	        $headers         = "From: {$params['email']}";

	        foreach ($selected_contacts as $i => $email)
	          mail($email,$message_subject,$message_body,$headers);
	        
	        $this->getUser()->setAttribute('sent', 1);
	        $this->redirect('openInviter/sent');
	       }
	      elseif ($sendMessage===false)
	        $this->getUser()->setAttribute('sent', 0);
  		
  		}
  		else
  		{
  			//var_dump($this->form->renderGlobalErrors()); 
        //foreach ($this->form as $key => $field)
          // echo $key.'->'.$field->renderError();
  		   //die('form not valid');
  		}
  	}
  }
  
   public function executeSent(sfWebRequest $request)
   {
   	  $this->sent = $this->getUser()->getAttribute('sent');
   }
   
   

}