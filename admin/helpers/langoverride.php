<?php
/**
* @version		1.0
* @package		Joverrider
* @copyright	2012 - Girolamo Tomaselli
* @author		Girolamo Tomaselli - http://bygiro.com - girotomaselli@gmail.com
* @license		GNU/GPL

* This version may have been modified pursuant to the GNU General Public License,
* and as distributed it includes or is derivative of works licensed under the
* GNU General Public License or other free or open source software licenses.
*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class JoverriderLangOverride {
	var $client;
	var $language;
	var $syncWay;
	var $logErrors;
	var $logData;
	var $logInfo;
	var $tasktype;
	var $logReport;
	var $result;
	
	function search(){
		$db  = JFactory::getDBO();
		$data = json_decode(JRequest::getVar('search_data'));
		$limitstart = $data->more;
		
		$searchstring = $db->quote('%' . $data->searchfor . '%');
		if ($data->searchtype == 'constant'){
			$where = 'WHERE constant LIKE '. $searchstring;
		} else {
			$where = 'WHERE string LIKE '. $searchstring;
		}
	
		$select = "SELECT constant, string, file ";
		$from = "FROM #__overrider ";
		
		$query = $select . $from . $where;
		
		// Consider the limitstart according to the 'more' parameter and load the results
		$db->setQuery($query, $limitstart, 10);
		$results->data->results = $db->loadObjectList();
	
		$i = 0;
		foreach ($results->data->results as $res){
			$results->data->results[$i]->lang = substr(basename($res->file), 0, 5);
			
			$findAdmin = strpos($res->file, 'administrator');			
			$results->data->results[$i]->client = 'administrator'; 
			if ($findAdmin === false) {
				$results->data->results[$i]->client = 'site';
			}
			$i++;
		}
		
		// Check whether there are more results than already loaded
		$select2 = 'SELECT COUNT(id) ';
		$query2 = $select2 . $from . $where;
		
		$db->setQuery($query2);
			if ($db->loadResult() > $limitstart + 10){
			// If this is set a 'More Results' link will be displayed in the view
			$results->data->more = $limitstart + 10;
		}
		
		return $results;
	}
	
	function refreshStrings(){
		set_time_limit(0);
		ignore_user_abort(true);

		$db  = JFactory::getDBO();
		$app = JFactory::getApplication();

		$app->setUserState('joverrider.language.cachedtime', null);
	
		$adminFiles = self::getLangFiles('administrator');
		$clientFiles = self::getLangFiles('site');
	
		// Empty the database cache first
		$db->setQuery('TRUNCATE TABLE #__overrider');
		$db->query();

		// Create the insert query
		$query = "INSERT INTO #__overrider (constant, string, file) VALUES ";

		$files = array_merge($clientFiles, $adminFiles);
		// Parse all found ini files and add the strings to the database cache
		foreach ($files as $file)
		{
			$strings = self::parseFile($file);
			$items = count($strings);
			if ($strings && $items){
				$i = 1;
				foreach ($strings as $key => $string)
				{
					$query2 = '('. $db->quote($key).','.$db->quote($string).','.$db->quote(JPath::clean($file)) .')';
					if($i < $items){
						$query2 .= ',';
					}
					$i++;
				}

				$db->setQuery($query . $query2);
				if (!$db->query()){
					$msg->message = ($db->getErrorMsg());
				}
			}
		}

		// Update the cached time
		$app->setUserState('joverrider.language.cachedtime', time());
		$msg->message = 'List of all the languages strings CREATED.';
		return $msg;
	}

	function getLangFiles($client, $language = null){
		$base = constant('JPATH_'.strtoupper($client));
		
		$languages = array();
		
		if(!$language){
			$foldersinpath = JFolder::folders($base.'/language/', $filter = '.', false, false);
			foreach($foldersinpath as $langFolder){
				$languages[] = basename($langFolder);
			}
		} else {
			$languages[] = $language;
		}
		
		$files = array();
		foreach ($languages as $language){
			$path = $base.'/language/' . $language;

			// Parse common language directory
			if(JFolder::exists($path))
			{
				$files = array_merge($files, JFolder::files($path, $language.'.*ini$', false, true));
			}

			// Parse language directories of components
			$files = array_merge($files, JFolder::files($base.'/components', $language.'.*ini$', 3, true));

			// Parse language directories of modules
			$files = array_merge($files, JFolder::files($base.'/modules', $language.'.*ini$', 3, true));

			// Parse language directories of templates
			$files = array_merge($files, JFolder::files($base.'/templates', $language.'.*ini$', 3, true));

			// Parse language directories of plugins
			$files = array_merge($files, JFolder::files(JPATH_PLUGINS, $language.'.*ini$', 3, true));
		}
		
		return $files;
	}
	
	function parseFile($filename){
		jimport('joomla.filesystem.file');

		if (!JFile::exists($filename))
		{
			return array();
		}

		// Capture hidden PHP errors from the parsing
		$version			= phpversion();
		$php_errormsg	= null;
		$track_errors	= ini_get('track_errors');
		ini_set('track_errors', true);

		if ($version >= '5.3.1')
		{
			$contents = file_get_contents($filename);
			$contents = str_replace('_QQ_', '"\""', $contents);
			$strings 	= @parse_ini_string($contents);

			if ($strings === false)
			{
				return array();
			}
		}
		else
		{
			$strings = @parse_ini_file($filename);

			if ($strings === false)
			{
				return array();
			}

			if ($version == '5.3.0' && is_array($strings))
			{
				foreach ($strings as $key => $string)
				{
					$strings[$key] = str_replace('_QQ_', '"', $string);
				}
			}
		}

		return $strings;
	}

	function publishLangOverride($data, $publish = 1){
		$app = JFactory::getApplication();

		$client = JPATH_SITE;
		if($data->lang_client){
			$client = JPATH_ADMINISTRATOR;
		}
		// Parse the override.ini file in oder to get the keys and strings
		$filename	= $client . '/language/overrides/' . $data->lang_code . '.override.ini';

		if(!file_exists($filename)){
			if (!JFile::write($filename)){
				$this->logErrors .= "ERROR - Can not write the new override file: $filename <br />";
			}
		}
		$strings	= self::parseFile($filename);

		foreach ($strings as $key => $string) {
			$strings[$key] = str_replace('"', '"_QQ_"', $string);
			
			if($key == $data->constant){
				unset($strings[$key]);			
			}

		}
		
		if($publish == 1){
			$strings = array($data->constant => $data->text) + $strings;
			$this->tasktype = "Template override Publish";
		} else {
			$this->tasktype = "Template override Unpublish";
		}

		// Write override.ini file with the strings
		$registry = new JRegistry();
		$registry->loadObject($strings);

		if (!JFile::write($filename, $registry->toString('INI')))
		{
			$this->logErrors .= "ERROR - Can not write the new override file: $filename <br />";
		}

		
		$this->report();
		
		$config = JComponentHelper::getParams('com_joverrider');
		if($config->get("use_log")){		
			// write log of the task
			JoverriderHelper::writeLog('lang', 'publish', $this->result, $this->logReport);
		}		

		return true;
	}

	function synchronizeLangOverrides($client = 2, $language = null, $syncWay = 0){
		set_time_limit(0);
		ignore_user_abort(true);
		
		$this->client = $client; // administrator or site? $client = 2 means BOTH clients	
		$this->language = $language; // all the templates or just the default
		$this->syncWay = $syncWay; // overwrite the joverrider DB/backup folder or the template folder?
		
		$languages = array();
		if($language){
			$languages[] = $language;
		} else {
			$languages = JoverriderHelper::enumListLangCode(1);
		}
		
		foreach($languages as $lang){
			// get the folders, and view layouts in the TEMPLATE/html folder
			if($client == 2){
				$this->langOverrides = $this->getLangOverrides(1, $lang);
			} else {
				$this->langOverrides = $this->getLangOverrides($client, $lang);
			}
			
			// synchronize the templates overrides and return the result	
			foreach($this->langOverrides as $LiveOv){
				$this->checkDbOverrides($LiveOv);
			}
		}
		
		if($client == 2){
			self::synchronizeLangOverrides($client = 0, $language, $syncWay);
		}
		
		$this->tasktype = "Override Synchronization";
		$this->info();
		$this->report();
		
		$config = JComponentHelper::getParams('com_joverrider');
		if($config->get("use_log")){		
			// write log of the task
			JoverriderHelper::writeLog('lang', 'sync', $this->result, $this->logReport);
		}
	}

	function getLangOverrides($client, $lang) {		
		$arr = array();

		$filename = JPATH_SITE .'/language/overrides/'. $lang .'.override.ini';
		if($client){
			$filename = JPATH_ADMINISTRATOR .'/language/overrides/'. $lang .'.override.ini';			
		}
		
		$overrides = array();

		// to do: merge the sitefile and adminfile task
		if(file_exists($filename)){
			$strings = self::parseFile($filename);
			
			foreach ($strings as $key => $string) {
				$strings[$key] = str_replace('"', '"_QQ_"', $string);

				$el = new stdClass;
				$el->lang_group = '';
				$el->constant = $key;
				$el->text = $string;
				$el->lang_code = $lang;
				$el->lang_client = $client;
				$el->file = $filename;
				$el->publish = 1;
					
				$overrides[] = $el;
			}
		}

        return $overrides;		
	}	
	
	function checkDbOverrides($LiveOv){
		$db = JFactory::getDBO();
		$model = JModel::getInstance('languageoverride', 'JoverriderModel');
				
		$query = "SELECT * "
		.		" FROM #__joverrider_languageoverrides "
		. 		"WHERE constant = ". $db->quote($LiveOv->constant)
		.		" AND lang_code = ". $db->quote($LiveOv->lang_code)
		.		" AND lang_client = ". $db->quote($LiveOv->lang_client);

		$db->setQuery($query);

		$DbOv = $db->loadObject();
			
		if($DbOv){
			
			// let's synchronize
			if($this->syncWay == 1){ //overwrite joomla language override file
				if($DbOv->publish){
					JoverriderLangOverride::publishLangOverride($DbOv, 1);
				} else {
					JoverriderLangOverride::publishLangOverride($DbOv, 0);			
				}
			} else { // overwrite the joverrider DB
				$DbOv->text = $LiveOv->text;
				$DbOv->publish = 1;
				
				// save into Joverrider DB
				$model->save($DbOv);				
			}
		} else {
			if ($this->syncWay == 1){
				// add new override in DB
				// set publish = 1 and save it
				JoverriderLangOverride::publishLangOverride($LiveOv, 0);		
			} else {
				unset($LiveOv->file);
				if(!$model->save($LiveOv)){
					$this->logErrors .= "ERROR - Can not add the new override string: ". $LiveOv->constant ." into JOVERRIDER DB<br />";
				} else {
					$this->logData .= "ADDED new override string: ". $LiveOv->constant ." into DB<br />";
				}
			}
		}
	}
	
	function info() {
		$info = '';
		switch($this->client){
			case 0:
				$client = 'Site';
			break;
			
			case 1:
				$client = 'administrator';
			break;
			
			case 2:
				$client = 'Site & Administrator';
			break;
			
			default:
				$client = 'Undefined';
			break;
		}
		
		$sync = 'Joverrider DB';
		if($this->syncWay == 1){
			$sync = 'Joomla Override Files';
		}
		
		$info .= "<tr><td>Client:</td><td>". $client ."</td></tr>";
		$info .= "<tr><td>Only default template:</td><td>". $this->language ."</td></tr>";
		$info .= "<tr><td>Sync overwrite direction :</td><td>". $sync ."</td></tr>";

		$this->logInfo = $info;
	}	
	
	function report(){
		if ($this->logErrors == ''){
			$this->result = "successful";
		} else {
			$this->result = "failed";
		}
				
		$color = 'red';
		if ($this->result == 'successful'){
			$color = 'green';
		}
		
		$this->logReport = '<table style="width:100%"><tr><td style="text-align: center; border: 1px solid '. $color .';" colspan="2"><span style="font-size: 16px; color: '. $color .'; font-weight: bold;">'. $this->result .'</span> - Task: '. $this->tasktype .'</td></tr>';
		$this->logReport .= $this->logInfo;
		$this->logReport .= "<tr><td>Execution Info:</td><td>". $this->logData ."</td></tr>";
		$this->logReport .= "<tr><td>Errors:</td><td>". $this->logErrors ."</td></tr>";
		$this->logReport .= "</table><br />";	
	}		
}