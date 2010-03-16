<?php
/**
 * LetsCod
 * 
 * @author Elie Andraos
 * @version 1.6.7
 */


class LetscodOpenInviter extends OpenInviter
{
	
	  public function __construct()
		{
		  parent::__construct();
		}


		// overriding the function startPlugin 
	  public function startPlugin($plugin_name)
		{
			//error throuwn in GetContactsForm.class.php
			if (!file_exists(dirname(__FILE__)."/installation-complete.dat"))
				$this->internalError = 1;
			elseif(!self::checkMessageConfig())
			  $this->internalError = 2;
			elseif (file_exists(dirname(__FILE__)."/plugins/{$plugin_name}.php"))
				{
					$ok=true;
					if (!class_exists($plugin_name)) include_once(dirname(__FILE__)."/plugins/{$plugin_name}.php");
					$this->plugin=new $plugin_name();
		    	$this->plugin->settings=$this->settings;
		    	$this->plugin->base_version=$this->getVersion();
		    	$this->plugin->base_path=dirname(__FILE__);
				}
			else
				$this->internalError="Invalid service provider";
		}
	
		
		
    public function getPlugins()
    {
	    $plugins=array();$array_file=array();
	    $dir=dirname(__FILE__)."/plugins";
	    if (is_dir($dir)) 
	        if ($op=opendir($dir))
	          { 
	            while (false!==($file=readdir($op))) 
	            {
	            	$wishlist = sfConfig::get("app_lcOpenInviter_wish-list");
	            	if(isset($wishlist))
	            	{
		            	if(is_array($wishlist['providers']) && count($wishlist['providers']) > 0)
		            	  $wishlist = $wishlist['providers'];
		            	
		            	 if(self::checkWishList($wishlist))
		            	    $plugins_list = $wishlist;
		            	 else
		            	    $plugins_list = self::getDefaultWishList();
	            	}
	            	else
	            	  $plugins_list =  self::getDefaultWishList();
	            	  
	              $plugin_key = str_replace('.php','',$file);
	            	if( in_array($plugin_key, $plugins_list)) $array_file[$plugin_key] = $plugin_key;
	            }
	            closedir($op);
	          }

	    if (count($array_file)>0) 
	    {
	      sort($array_file);
	      foreach($array_file as $key=>$val)
	        {
	             $_pluginInfo = getPluginInfo($val);
	             if ($this->checkVersion($_pluginInfo['base_version']))
	              $plugins[$_pluginInfo['type']][$val] = $val;
	        }
	    }
	    if (count($plugins)>0) return $plugins;
	    else return false;
    }
    
    
    public function getDefaultWishList()
    {
    	return array("hotmail" => "hotmail", "yahoo" => "yahoo","gmail" => "gmail");
    }
    
    // check if the app.yml configuration list are valid
    // @return boolean
    public function checkWishList($wishlist)
    {
    	$dir=dirname(__FILE__)."/plugins";
      if (is_dir($dir)) 
          if ($op=opendir($dir)) 
              while (false!==($file=readdir($op)))
              {
              	$plugin = str_replace('.php','',$file);
                if( in_array($plugin, $wishlist))
                    return true;
              }
              
      return false;
    }
    
    
    public function checkMessageConfig()
    {
    	$message = sfConfig::get("app_lcOpenInviter_message");
    	if(isset($message))
    		if (!isset($message['subject']) || !isset($message['body']) || !isset($message['footer']))
    		  return false;
    		else
    		  return true;
    	else
    	 return false;
    }
    
    public static function isValidEmail($email)
    {
      return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email);
    }
	
}
	
	
?>
