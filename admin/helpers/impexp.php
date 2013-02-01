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

class ImportExport{
	var $app;
	var $doc;
	var $config;
	var $tempFolder;
	var $db;
	var $logData;
	var $logErrors;
	var $logReport;
	var $result;
	
    function __construct() {
		$this->app = JFactory::getApplication();
		$this->doc = JFactory::getDocument();
		$this->config = JComponentHelper::getParams('com_joverrider');
		$this->db = JFactory::getDBO();
		$this->operationsFolder = JPath::clean( JPATH_SITE . DS . $this->config->get('upload_dir_operations_data_file') . DS );
		$this->logData = '';
		$this->logErrors = '';
		$this->logReport = '';
		$this->result = 'undefined';
	}
			
	function string2File($filename, $string, $opId){
		
		$content = base64_decode($string);
		$structure = dirname($filename);
		
		if (!file_exists($structure)) {
			if (!mkdir($structure, 0644, true)){
				$this->logErrors .= "ERROR - Can not create the folder: $structure<br />";	
			} else {
				if (!file_exists($structure . DS . 'index.html')){
					file_put_contents($structure . DS . 'index.html', 'What are you doing?!');
				}
			}
		}

		$realname = JoverriderHelper::getRealFilename(basename($filename));
		$newFilename = JoverriderHelper::makeOperationFilename($realname, $opId);
		$newfile =  $structure . DS . $newFilename;		
		
		if(file_put_contents($newfile, $content)){
			chmod($filename, 0744);
		} else {
			$this->logErrors .= "ERROR - Can not create the $filename<br />";	
		}
	}
	
	function getJoverriderVer(){
		$db = $this->db;
		$query = "SELECT manifest_cache "
		.		 " FROM #__extensions"
		.		 " WHERE type = 'component' AND element = 'com_joverrider'";
		
		$db->setQuery($query);
		$result = $db->loadObject();
		$data = json_decode($result->manifest_cache);

		return $data->version;
	}
		
	// IMPORT	
	function importFile($file){
		$db = $this->db;
		$data = file_get_contents($file);
		
		$hacks = unserialize($data);
		foreach($hacks as $hack){
			// $skip = array('total_tmpl','total_lang','total_operations','operations', 'tmpl_overrides', 'lang_overrides', 'processes', 'data_file', 'data_file_content', 'search_key', 'replacement', 'file_content');
			$hackmodel = JModel::getInstance('hack', 'JoverriderModel');
			
			If($hackmodel->save($hack)){
				$newHackid = $hackmodel->_id;
				$this->logData .= "Imported a new hack id: $newHackid<br />";
			} else {
				$this->logErrors .= 'Error: I cannot save the hack: ' . $hack->name . ' into the DB';
			}
			
			
			if($newHackid){
			
				// import template overrides
				foreach($hack->tmpl_overrides as $tmpl){
					$tmpl->ov_hack_id = $newHackid;
					$tmpl->file_content = base64_decode($tmpl->file_content);
							
					$tmplmodel = JModel::getInstance('templateoverride', 'JoverriderModel');
	
					If($tmplmodel->save($tmpl)){
						$this->logData .= "Imported a new template override id: ". $tmplmodel->_id . "<br />";
					} else {
						$this->logErrors .= 'Error: I cannot import the template override with this description: ' . $tmpl->ov_desc . ' into the DB';
					}					
				}

				// import Language overrides
				foreach($hack->lang_overrides as $lang){
					$lang->lang_hack_id = $newHackid;
							
					$langmodel = JModel::getInstance('languageoverride', 'JoverriderModel');
	
					If($langmodel->save($lang)){
						$this->logData .= "Imported a new language override id: ". $langmodel->_id ."<br />";
					} else {
						$this->logErrors .= 'Error: I cannot import the language override with this constant: ' . $lang->constant . ' into the DB';
					}					
				}				

			}
		}
		
		$this->report();

		if($this->config->get("use_log")){		
			// write log of the task
			JoverriderHelper::writeLog('hack', 'impexp', $this->result, $this->logReport);
		}		
		return true;
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
		
		$this->logReport = '<table style="width:100%"><tr><td style="text-align: center; border: 1px solid '. $color .';" colspan="2"><span style="font-size: 16px; color: '. $color .'; font-weight: bold;">'. $this->result .'</span> - Task: Import Hacks</td></tr>';
		$this->logReport .= "<tr><td>Execution Info:</td><td>". $this->logData ."</td></tr>";
		$this->logReport .= "<tr><td>Errors:</td><td>". $this->logErrors ."</td></tr>";
		$this->logReport .= "</table><br />";	
	}	
}