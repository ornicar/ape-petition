<?
/**
 * LetsCod
 * 
 * @author Elie Andraos
 * @version 1.6.7
 */


 /*
  * function that returns the plugin info defined in the plugins classes.
  * I had to this because they are defined outside the class and the class should be included
  * to get them, as symfony autoloads the classes automatically, including them throws a redaclaration class error,
  * therefore the necessity of this function
  * 
  * Be aware of any classes update, this function should be also updated.
  */
  function getPluginInfo($plugin)
  {
  	$_pluginInfo = array(NULL => '');
  	
  	switch($plugin)
  	{
  		case "abv":
  			$_pluginInfo = array(
														  'name'=>'Abv',
														  'version'=>'1.0.0',
														  'description'=>"Get the contacts from a Abv account",
														  'base_version'=>'1.6.5',
														  'type'=>'email',
														  'check_url'=>'http://www.abv.bg/'
														 );
			  break;
  		case "aol":
  			$_pluginInfo = array(
														  'name'=>'AOL',
														  'version'=>'1.4.8',
														  'description'=>"Get the contacts from an AOL account",
														  'base_version'=>'1.6.3',
														  'type'=>'email',
														  'check_url'=>'http://webmail.aol.com'
												    );
				break;
  		case "apropo":
  			$_pluginInfo = array(
														  'name'=>'Apropo',
														  'version'=>'1.0.0',
														  'description'=>"Get the contacts from a Apropo account",
														  'base_version'=>'1.6.5',
														  'type'=>'email',
														  'check_url'=>'http://amail.apropo.ro/index.php'
													  );
        break;
  		case "azet":
  			$_pluginInfo = array(
														  'name'=>'Azet',
														  'version'=>'1.0.0',
														  'description'=>"Get the contacts from a Azet account",
														  'base_version'=>'1.6.5',
														  'type'=>'email',
														  'check_url'=>'http://www.email.azet.sk/'
													  );
      break;
  		case "badoo":
  			$_pluginInfo = array(
														  'name'=>'Badoo',
														  'version'=>'1.0.0',
														  'description'=>"Get the contacts from a badoo.com account",
														  'base_version'=>'1.6.7',
														  'type'=>'social',
														  'check_url'=>'http://www.badoo.com/'
													  );
			 break;
  		case "bebo":
  			$_pluginInfo=array(
				  'name'=>'Bebo',
				  'version'=>'1.0.0',
				  'description'=>"Get the contacts from a Bebo account",
				  'base_version'=>'1.6.3',
				  'type'=>'social',
				  'check_url'=>'http://www.bebo.com/'
				);
			break;
  		case "bigstring":
  			break;
  		case "brazencareerist":
  			break;
  		case "care2":
  			break;
  		case "clevergo":
  			break;
  		case "cyworld":
  			break;
  		case "doramail":
  			break;
  		case "eons":
  			break;
  		case "evite":
  			break;
  		case "facebook":
  			$_pluginInfo = array(
														  'name'=>'Facebook',
														  'version'=>'1.0.8',
														  'description'=>"Get the contacts from a Facebook account",
														  'base_version'=>'1.6.3',
														  'type'=>'social',
														  'check_url'=>'http://www.facebook.com/'
														);
  			break;
  		case "faces":
  			break;
  		case "famiva":
  			break;
  		case "fastmail":
  			break;
  		case "fdcareer":
  			break;
  		case "flickr":
  			break;
  		case "flingr":
  			break;
  		case "flixster":
  			break;
  		case "fm5":
  			break;
  		case "friendfeed":
  			break;
  		case "friendster":
  			break;
  		case "gawab":
  			break;
  		case "gmail":
  			$_pluginInfo = array(
														  'name'=>'GMail',
														  'version'=>'1.4.1',
														  'description'=>"Get the contacts from a GMail account",
														  'base_version'=>'1.6.3',
														  'type'=>'email',
														  'check_url'=>'http://google.com'
													  );
  			break;
  		case "gmx_net":
  			break;
  		case "hi5":
  			break;
  		case "hotmail":
  			$_pluginInfo = array(
														  'name'=>'Live/Hotmail',
														  'version'=>'1.5.2',
														  'description'=>"Get the contacts from a Windows Live/Hotmail account",
														  'base_version'=>'1.6.7',
														  'type'=>'email',
														  'check_url'=>'http://mail.live.com'
													  );
  			break;
  		case "hushmail":
  			break;
  		case "hyves":
  			break;
  		case "inbox":
  			break;
  		case "indiatimes":
  			break;
  		case "interia":
  			break;
  		case "katamail":
  			break;
  		case "kincafe":
  			break;
  		case "konnects":
  			break;
  		case "lastfm":
  			break;
  		case "libero":
  			break;
  		case "linkedin":
  			break;
  		case "livejournal":
  			break;
  		case "lovento":
  			break;
  		case "lycos":
  			break;
  		case "mail_com":
  			break;
  		case "mail_in":
  			break;
  		case "mail_ru":
  			break;
  		case "mevio":
  			break;
  		case "motortopia":
  			break;
  		case "multiply":
  			break;
  		case "mycatspace":
  			break;
  		case "mydogspace":
  			break;
  		case "mynet":
  			break;
  		case "myspace":
  			break;
  		case "netaddress":
  			break;
  		case "nz11":
  			break;
  		case "operamail":
  			break;
  		case "orkut":
  			break;
  		case "prefspot":
  			break;
  		case "plaxo":
  			break;
  		case "plazes":
  			break;
  		case "plurk":
  			break;
  		case "popstarmail":
  			break;
  		case "rambler":
  			break;
  		case "rediff":
  			break;
  		case "sapo":
  			break;
  		case "skyrock":
  			break;
  		case "tagged":
  			break;
  		case "terra":
  			break;
  		case "twitter":
  			break;
  		case "uk2":
  			break;
  		case "vimeo":
  			break;
  		case "twitter":
  		  break;
  		case "walla":
  			break;
  		case "web_de":
  			break;
  		case "wpl":
  			break;
  		case "xanga":
  			break;
  		case "xing":
  			break;
  		case "xuqa":
  			break;
  		case "yahoo":
  			$_pluginInfo = array(
														  'name'=>'Yahoo!',
														  'version'=>'1.4.1',
														  'description'=>"Get the contacts from a Yahoo! account",
														  'base_version'=>'1.6.3',
														  'type'=>'email',
														  'check_url'=>'http://mail.yahoo.com'
													  );
  			break;
  		case "yandex":
  			break;
  		case "zapak":
  			break;
  		default:
  			$_pluginInfo = array(NULL => '');
  			break;
  		
  		
  			
  	}
  	
  	return $_pluginInfo;
  }
  
  
  /*
   * function that returns the type of the plugin
   * @params plugins, provider
   * @return string
   */
  function getPluginType($plugins,$provider)
  {
  	if (isset($plugins['email'][$provider])) 
  	   return "email";
    elseif (isset($plugins['social'][$provider])) 
       return "social";
    else
      return NULL;
  }
  
  
?>