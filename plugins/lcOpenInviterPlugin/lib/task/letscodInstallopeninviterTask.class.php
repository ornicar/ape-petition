<?php
/**
 * LetsCod
 * 
 * @author Elie Andraos
 * @version 1.6.7
 */

class letscodInstallopeninviterTask extends sfBaseTask
{
	private $logs = "", $seperator = "    ", $break = "\n\r";
	
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'letscod';
    $this->name             = 'install-open-inviter';
    $this->briefDescription = 'This task configures and install open inviter';
    $this->detailedDescription = <<<EOF
The [letscod:install-open-inviter|INFO] task does things.
Call it with:

  [php symfony letscod:install-open-inviter|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();
    
    include dirname(__FILE__)."/../openInviter/config.php";
    
    // start log
    $this->logSection('start', 'This task make take a while, please be patient!');
    $this->logs .= 'start...This task make take a while, please be patient!'.$this->break;
    
    $misConfiguration = false;
    // check username and private key
    if(!letscodInstallopeninviterTask::checkUsernameAndPrivateKey($openinviter_settings)) $misConfiguration = true;
    // check php version
    if(!letscodInstallopeninviterTask::checkPHPVersion()) $misConfiguration = true;
    // check dom support
    if(!letscodInstallopeninviterTask::checkDOMSupport()) $misConfiguration = true;
    // check transport type
    if(!letscodInstallopeninviterTask::checkTransportType()) $misConfiguration = true;
    // check Permissions
    if(!letscodInstallopeninviterTask::checkPermissions()) $misConfiguration = true;

    include dirname(__FILE__)."/../openInviter/openinviter.php";
    include dirname(__FILE__)."/../openInviter/letscodpostinstall.class.php";
    
    $inviter=new OpenInviter();
    $checker=new LetscodPostInstall();
    
    $checker->settings=$inviter->settings;
		$checker->service_user='postInstall';
		$checker->service_pass='postInstall';
		$checker->service='postInstall';
		
		// check OpenInviter software version
    letscodInstallopeninviterTask::checkOpenInviterVersion($checker,$inviter);
    // check plugins 
    letscodInstallopeninviterTask::checkPlugins($checker, $inviter);
    
    //everything ok
    if(!$misConfiguration)
    {
    	letscodInstallopeninviterTask::writeInstallationFile();
    	letscodInstallopeninviterTask::writeLogFile();
    }
    
  }
  
  
  public function checkUsernameAndPrivateKey($openinviter_settings)
  {
  	if(empty($openinviter_settings['username']) OR empty($openinviter_settings['private_key']))
  	{
  		$this->logSection("Checking username and private key....NOT OK!", "Username or private key missing");
  		$this->logs .= "Checking username and private key....NOT OK!".$this->seperator."Username or private key missing".$this->break;
  	   return false;
  	}
  	else
  	{
  		$this->logSection("Checking username and private key....OK!", "Username or private key valid");
  		$this->logs .= "Checking username and private key....OK!".$this->seperator."Username or private key valid".$this->break;
  	   return true;
  	}
  }
  
  public function checkPHPVersion()
  {
  	if (version_compare(PHP_VERSION, '5.0.0', '<'))
  	{
  		$this->logSection("Checking PHP version....NOT OK!","OpenInviter requires PHP5, your server has PHP ".PHP_VERSION." installed");
  		$this->logs .= "Checking PHP version....NOT OK!".$this->seperator."OpenInviter requires PHP5, your server has PHP ".PHP_VERSION." installed".$this->break;
  		return false;
  	}
  	else
  	{
  		$this->logSection("Checking PHP version....OK!", "PHP5 is installed on your server");
  		$this->logs .= "Checking PHP version....OK!".$this->seperator."PHP5 is installed on your server".$this->break;
  		return true;
  	}
  }
  
  public function checkDOMSupport()
  {
  	if (!extension_loaded('dom') OR !class_exists('DOMDocument'))
  	{
  		$this->logSection("Checking DOM support....NOT OK!", "OpenInviter will not run correctly on this system");
  		$this->logs .= "Checking DOM support....NOT OK!".$this->seperator."OpenInviter will not run correctly on this system".$this->break;
  		return false;
  	}
  	else
  	{
  		$this->logSection("Checking DOM support....OK!", "OpenInviter will run correctly on this system");
  		$this->logs .= "Checking DOM support....OK!".$this->seperator."OpenInviter will run correctly on this system".$this->break;
  		return true;
  	}
  }
  
  public function checkTransportType()
  {
  	$transport='curl';
  	if (!extension_loaded('curl') OR !function_exists('curl_init'))
	  {
	     $transport='wget';
	     passthru("wget --version",$return_var);
	     if ($return_var!=0)
	     {
	       $this->logSection("Checking Transport type....NOT OK!", "Neither libcurl nor wget is installed. You will not be able to use OpenInviter.");
	       $this->logs .= "Checking Transport type....NOT OK!".$this->seperator."Neither libcurl nor wget is installed. You will not be able to use OpenInviter.".$this->break;
	       return false;
	     }
	     else 
	     {
	     	 $this->logSection("Checking Transport type....OK!", "wget is installed. Using Wget to handle requests.");
	     	 $this->logs .= "Checking Transport type....OK!".$this->seperator."wget is installed. Using Wget to handle requests.".$this->break;
	     	 return true;
	     }
	  }
	  else 
	  {
	  	$this->logSection("Checking Transport type....OK!", "libcurl is installed. Using cURL to handle requests.");
	  	$this->logs .= "Checking Transport type....OK!".$this->seperator."libcurl is installed. Using cURL to handle requests.".$this->break;
	  	return true;
	  }
	  //if ($openinviter_settings['transport']!=$transport) { $rewrite_config=true;$openinviter_settings['transport']=$transport; }
  }
  
  public function checkPermissions()
  {
  	 $cookie_path='/tmp';
  	 if(!is_writable("{$cookie_path}"))
     {
        $cookie_path = realpath(session_save_path());
        if (strpos ($cookie_path, ";") !== FALSE)
          $cookie_path = substr ($cookie_path, strpos ($cookie_path, ";")+1);
        if (empty($cookie_path)) 
          $cookie_path=realpath('/tmp');
        if (!is_writable("{$cookie_path}"))
        {
          $this->logSection("Checking Permissions....NOT OK!", "The {$cookie_path} folder is not writable. You will have to manually define a location for logs and temporary files in config.php");
          $this->logs .= "Checking Permissions....NOT OK!".$this->seperator."The {$cookie_path} folder is not writable. You will have to manually define a location for logs and temporary files in config.php".$this->break;
          return false;
        }
        else 
        {
        	$this->logSection("Checking Permissions....OK!", "{$cookie_path} is writable. Using {$cookie_path} to store cookie files and logs");
        	$this->logs .= "Checking Permissions....OK!".$this->seperator."{$cookie_path} is writable. Using {$cookie_path} to store cookie files and logs".$this->break;
          return true;
        }
    }
    else
    {
    	$this->logSection("Checking Permissions....OK!", "{$cookie_path} is writable. Using {$cookie_path} to store cookie files and logs");
    	$this->logs .= "Checking Permissions....OK!".$this->seperator."{$cookie_path} is writable. Using {$cookie_path} to store cookie files and logs".$this->break;
      return true;
    }
    
    //if ($openinviter_settings['cookie_path']!=$cookie_path) { $rewrite_config=true;$openinviter_settings['cookie_path']=$cookie_path; }
  }
  
  
  public function checkOpenInviterVersion($checker, $inviter)
  {
		  $xml=$checker->checkVersion();
			libxml_use_internal_errors(true);
			$parsed_xml=simplexml_load_string($xml);
			libxml_use_internal_errors(false);
			if (!$parsed_xml)
			{
					$this->logSection("Checking OpenInviter version....NOT OK!", "Could not connect to openinviter.com server");
					$this->logs .= "Checking OpenInviter version....NOT OK!".$this->seperator."Could not connect to openinviter.com server".$this->break;
				  return false;
			}
			else
			{
				  $server_version=(string)$parsed_xml;
				  $version=$inviter->getVersion();
				  if (!$inviter->checkVersion($server_version))
				  {
				  	$this->logSection("Checking OpenInviter version....NOT OK!", "You are using OpenInviter {$version} but version {$server_version} is available for download");
				  	$this->logs .= "Checking OpenInviter version....NOT OK!".$this->seperator."You are using OpenInviter {$version} but version {$server_version} is available for download".$this->break;
				  	return false;
				  }
				  else 
				  {
				  	 $this->logSection("Checking OpenInviter version....OK!", "Your OpenInviter software is up-to-date");
				  	 $this->logs .= "Checking OpenInviter version....OK!".$this->seperator."Your OpenInviter software is up-to-date".$this->break;
				  	 return true;
				  }
			}
	}
	
	public function checkPlugins($checker, $inviter)
	{
	  $plugins=$inviter->getPlugins();
		foreach ($plugins as $type=>$dummy)
		  foreach ($dummy as $plugin=>$details)
		  {		  
		    if ($checker->check($details['check_url']))
		    {
		    	$this->logSection("Checking {$details['name']}....OK!" ,     "This plugin is working correctly on your system");
		    	$this->logs .= "Checking {$details['name']}....OK!".$this->seperator."This plugin is working correctly on your system".$this->break;
		    }
		    else
		    {
		      $this->logSection("Checking {$details['name']}....NOT OK!" , "This plugin might not work correctly on your system");
		      $this->logs .= "Checking {$details['name']}....NOT OK!".$this->seperator."This plugin might not work correctly on your system".$this->break;
		    }
		  }
	}
	
	public function writeInstallationFile()
	{
		$fileName = sfConfig::get('sf_plugins_dir')."/lcOpenInviterPlugin/lib/openInviter/installation-complete.dat";
    $handle = fopen($fileName, "w");
    if ($handle)
    {
      fwrite($handle, "1\n");
      fclose($handle);
      $this->logSection("Installation complete....OK!" ,     "File written");
    }
	}
	
	public function writeLogFile()
	{
	  $fileName = sfConfig::get('sf_plugins_dir')."/lcOpenInviterPlugin/lib/openInviter/installation-logs.txt";
	  $now  = date("F j Y G:i");
	  $data = $now." installation logs:".$this->break.$this->break.$this->logs;
    $handle = fopen($fileName, "w");
    if ($handle)
    {
      fwrite($handle, $data);
      fclose($handle);
      $this->logSection("Installation complete....OK!" ,     "Logs written");
    }
	}
  
}
