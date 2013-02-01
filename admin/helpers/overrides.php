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

class JoverriderOverrides {
	
	var $app;
	var $doc;
	var $config;	
	var $db;
	var $client;
	var $onlyDefault;
	var $syncWay;
	var $templateOverrides;
	var $joverriderTemplateOverrides;
	var $logError;
	var $logData;
	var $logInfo;
	var $tasktype;
	var $logReport;
	var $result;
	
    function __construct($testmode = 1) {
		$this->app = JFactory::getApplication();
		$this->db  = JFactory::getDBO();
		$this->doc = JFactory::getDocument();
		$this->config = JComponentHelper::getParams('com_joverrider');
		$this->logErrors = '';
		$this->logData = '';
		$this->logInfo = '';
		$this->logReport = '';
		$this->result = '';
		
		
	}
	
	function publishTmplOverride($item, $publish){

			if($item->publish != $publish){
				$paths = JoverriderHelper::createOverridePaths($item);
				$structure = $paths->overridefile;
				$destination = $structure . DS . $item->filename_override;
				
				// check template folder if PUBLISH
				if($publish == 1){
					if(file_exists($destination)){
						$this->logErrors .= "ERROR - Override id: ".$item->id." - NOT PUBLISHED - file already exists, I suggest you to firstly synchronize joverrider with your joomla system<br />";
					} elseif (file_exists($structure)) {
						$ok = 1;
						
					} else {
						// To create the nested structure, the $recursive parameter to mkdir() must be specified.
						if (!mkdir($structure, 0644, true)) {
							$this->logErrors .= "ERROR - Can not create the folder structure: $structure.<br />";
						} else {
							$this->logData .= "Override folder structure created: $structure<br />";
							$ok = 1;
						}
					}

					if($ok){
						if(file_put_contents($destination, $item->file_content)){
							chmod($destination, 0744);
							$this->logData .= "New override file created: $destination<br />";
							$cid2publish[] = $d;
						} else {
							$this->logErrors .= "ERROR - Can not create $destination<br />";	
						}			
					}					
				} else {
					// unpublish task
					if(!unlink($destination)){
						$this->logErrors .= "ERROR - Can not delete the override file $destination .<br />";
					} else {
						$this->logData .= "deleted the override file: $destination<br />";
					}					
				}
				// remove empty folders
				JoverriderHelper::removeEmptySubfolders(dirname($structure));
						
				// check for index.html
				JoverriderHelper::recursive_check_index_exist(dirname($structure));				
			} else {
				
				$this->logData .= "Override id: ". $item->id ." already unpublished";
				if($item->publish){
					$this->logData .= "Override id: ". $item->id ." already published";
				}
			}	
	
		$this->tasktype = 'Template Override Publish';
		$this->report();
	
		// write log of the task
		$config = JComponentHelper::getParams('com_joverrider');
		if($config->get("use_log")){		
			// write log of the task
			JoverriderHelper::writeLog('tmpl', 'publish', $this->result, $this->logReport);
		}
		
		if($this->logErrors != ''){
			return false;
		}
		
		return true;
	}
	
	function synchronizeTemplateOverrides($client = 2, $onlyDefault = 0, $syncWay = 0){

		$this->client = $client; // administrator or site? $client = 2 means BOTH clients	
		$this->onlyDefault = $onlyDefault; // all the templates or just the default
		$this->syncWay = $syncWay; // overwrite the joverrider DB/backup folder or the template folder?
		
		
		// get the folders, and view layouts in the TEMPLATE/html folder
		$this->templateOverrides = $this->getTemplateOverrides();

		// synchronize the templates overrides and return the result		
		$this->syncOverrides();
	
		
		$this->tasktype = 'Template Override Synchronization';
		$this->info();
		$this->report();
	
		// write log of the task
		$config = JComponentHelper::getParams('com_joverrider');
		if($config->get("use_log")){		
			// write log of the task
			JoverriderHelper::writeLog('tmpl', 'sync', $this->result, $this->logReport);
		}		
	}
	
	function getTemplateOverrides() {
		$templates = JoverriderHelper::getAllTemplates($this->client, $this->onlyDefault);
				
		$arr = array();
		foreach($templates as $tmpl){
			
			$root = JPATH_SITE;
			if ($tmpl->client_id){
				$root = JPATH_SITE . DS . basename(JPATH_ADMINISTRATOR) ;
			}
			
			$startingPath = JPath::clean($root . DS . 'templates' . DS . $tmpl->template . DS . 'html');
			
			$iterator = JoverriderHelper::findpaths($startingPath);
		
			foreach ($iterator as $path) {
				
				if (is_file($path->__toString()) AND basename($path->__toString()) != "index.html"){
					
					$relativePath = JoverriderHelper::getRelativePath($path->__toString(), $tmpl->client_id);
					
					$el = new stdClass;
					$el->ov_client = $tmpl->client_id;
					$el->template = $tmpl->template;
					$el->default_template = $tmpl->home;	
					
					$array_path = explode( DS , $relativePath );
					$el->filename_override = basename($relativePath);
					$el->filename = basename($relativePath);
					$el->ov_type = $this->checkType($array_path[3], $el->filename_override);
					
					
					if($el->ov_type == 'component' OR $el->ov_type == 'menu'){
						$el->ov_element = $array_path[3];
						$el->view_name = $array_path[4];
					} elseif($el->ov_type == 'module') {
						$el->ov_element = $array_path[3];
						$el->view_name = 'n/a';
					} else {
						$el->ov_element = 'n/a';
						$el->view_name = 'n/a';
					}
					
					$el->publish = 1;
					
					$arr[] = $el;
				}
			}
		}

        return $arr;		
	}
	
	function checkType($string, $filename){
		$beginning = substr( $string , 0 , 4 );
		
		switch ($beginning) {
			case 'com_':
				if ($filename != "index.html" AND JoverriderHelper::findExtension($filename) == 'php'){
					$type = 'component';
				} else {
					$type = 'menu';
				}
				
			break;
			
			case 'mod_':
				$type = 'module';
			break;
			
			default:
				$type = 'system';
			break;
				
		}
		
		return $type;
	}

	function checkDbOverrides($LiveOv){
		$db = $this->db;
		$model = JModel::getInstance('templateoverride', 'JoverriderModel');
				
		$query = "SELECT * "
		.	" FROM #__joverrider_templateoverrides "
		.	"WHERE ov_client = ". $LiveOv->ov_client
		.	" AND template = ". $db->quote($LiveOv->template)
		.	" AND ov_type = ". $db->quote($LiveOv->ov_type)
		.	" AND ov_element = ". $db->quote($LiveOv->ov_element)
		.	" AND view_name = ". $db->quote($LiveOv->view_name)
		.	" AND filename_override = ". $db->quote($LiveOv->filename_override);
		
		$db->setQuery($query);

		$DbOv = $db->loadObject();

		$paths = JoverriderHelper::createOverridePaths($LiveOv);
		$LiveOv->file_content = JoverriderHelper::stringfix(file_get_contents($paths->overridefile . DS . $LiveOv->filename_override));
		
		if($DbOv){
			// let's synchronize
			if($this->syncWay == 1){ //overwrite joomla template folders
				// delete the file and publish the joverrider override
				if(!unlink($paths->overridefile . DS . $LiveOv->filename_override)){
					$this->logErrors .= "ERROR - Can not delete the override file ". $paths->overridefile . DS . $LiveOv->filename_override ." .<br />";
				} else {
					$this->logData .= "ADDED the override file: ". $paths->overridefile . DS . $LiveOv->filename_override ."<br />";
				}

				if($DbOv->publish == 1){
					// publish override
					$msg = $model->publish((array)$DbOv->id, 1);

					$this->logErrors .= $msg->error;
					$this->logData .= $msg->logdata;					
				}
			} else {
				// set values from LiveOv
				$DbOv->file_content = $LiveOv->file_content;
				
				// save Override into DB and set publish
				if(!$model->save($DbOv)){
					$this->logErrors .= "ERROR - Can not add the new override file into JOVERRIDER DB ". $paths->overridefile . DS . $LiveOv->filename_override ."<br />";
				} else {
					$this->logData .= "ADDED new override into DB: ". $paths->overridefile . DS . $LiveOv->filename_override ."<br />";
				}					
			}
		} elseif ($this->syncWay == 0){
			// add new override in DB
			// set publish = 1 and save Override into DB
			$LiveOv->publish = 1;
			if(!$model->save($LiveOv)){
				$this->logErrors .= "ERROR - Can not add the new override file into JOVERRIDER DB ". $paths->overridefile . DS . $LiveOv->filename_override ."<br />";
			} else {
				$this->logData .= "ADDED new override into DB: ". $paths->overridefile . DS . $LiveOv->filename_override ."<br />";
			}			
		} elseif($this->syncWay == 1){
			if(!unlink($paths->overridefile . DS . $LiveOv->filename_override)){
				$this->logErrors .= "ERROR - Can not delete the override file ". $paths->overridefile . DS . $LiveOv->filename_override ."<br />";
			} else {
				$this->logData .= "DELETED the override file: ". $paths->overridefile . DS . $LiveOv->filename_override ."<br />";
			}			
		}
	}
	
	function syncOverrides() {
		
		foreach($this->templateOverrides as $LiveOv){
			if($LiveOv->ov_element != 'n/a'){
				$this->checkDbOverrides($LiveOv);
			}
		}

		$rootsite = JPATH_SITE . DS . 'templates' . DS . 'html';
		$rootadmin = JPATH_SITE . DS . basename(JPATH_ADMINISTRATOR) . DS . 'templates' . DS . 'html';
		
		// remove empty folders
		JoverriderHelper::removeEmptySubfolders($rootsite);
		JoverriderHelper::removeEmptySubfolders($rootadmin);
				
		// check for index.html
		JoverriderHelper::recursive_check_index_exist($rootsite);
		JoverriderHelper::recursive_check_index_exist($rootadmin);
	}

	function info(){
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
			$sync = 'Joomla override files';
		}
		
		$info .= "<tr><td>Client:</td><td>". $client ."</td></tr>";
		$info .= "<tr><td>Only default template:</td><td>". $this->onlyDefault ."</td></tr>";
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