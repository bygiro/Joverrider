<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V1.5.2   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.4.0
* @package		Joverrider
* @subpackage	Languageoverrides
* @copyright	2012 - Girolamo Tomaselli
* @author		Girolamo Tomaselli - http://bygiro.com - girotomaselli@gmail.com
* @license		GPLv2 or later
*
* /!\  Joomla! is free software.
* This version may have been modified pursuant to the GNU General Public License,
* and as distributed it includes or is derivative of works licensed under the
* GNU General Public License or other free or open source software licenses.
*
*             .oooO  Oooo.     See COPYRIGHT.php for copyright notices and details.
*             (   )  (   )
* -------------\ (----) /----------------------------------------------------------- +
*               \_)  (_/
*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
if(!defined('DS')) define('DS',DIRECTORY_SEPARATOR);

@define('JPATH_ADMIN_JOVERRIDER', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_joverrider');
@define('JPATH_SITE_JOVERRIDER', JPATH_SITE . DS . 'components' . DS . 'com_joverrider');
@define('JQUERY', 'BETA');

//Shortcut to include component libraries
if (!function_exists('cimport')){
	function cimport($namespace, $option = 'com_joverrider', $className = null){
		//Check if class already exists
		if (($className) && class_exists($className))
			return;
		@require_once JPATH_ADMINISTRATOR .DS. 'components' .DS. $option . DS . str_replace(".", DS, $namespace) . '.php';
	}
}

require_once(JPATH_ADMIN_JOVERRIDER .DS.'helpers'.DS.'helper.php');
JHTML::_("behavior.framework");

// Set the table directory
JTable::addIncludePath(JPATH_ADMIN_JOVERRIDER . DS . 'tables');

//Document title
$document	= &JFactory::getDocument();
$document->titlePrefix = "Joverrider - ";
$document->titleSuffix = "";

if (defined('JDEBUG') && count($_POST))
	$_SESSION['Joverrider']['$_POST'] = $_POST;

//FILE INDIRECT ACCESS
$task	= JRequest::getVar('task');
if ($task == 'file')
{
	require_once(JPATH_ADMIN_JOVERRIDER .DS. "classes" .DS. "file.php");
	JoverriderFile::returnFile();
}


if ($task == 'browse')
{
	JoverriderHelper::browserFiles();
}

if ($task == 'loadfile')
{
	JoverriderHelper::loadfilecontent();
}
// to do: merge loadfile + loadfile2
if ($task == 'loadfile2')
{
	$result = JoverriderHelper::loadfile2();
	echo json_encode($result);
	jexit();	
}

if ($task == 'loadviews')
{
	$result = JoverriderHelper::loadviews('options');
	echo $result;
	jexit();
}

if ($task == 'searchstring')
{
	$result = JoverriderLangOverride::search();
	echo json_encode($result);
	jexit();	
}

if ($task == 'refreshstrings')
{
	$result = JoverriderLangOverride::refreshStrings();
	echo json_encode($result);
	jexit();	
}



$view = JRequest::getCmd( 'view');
$layout = JRequest::getCmd( 'layout');

$mainMenu = true;

switch ($view)
{

		case 'hacks' :



        	$controllerName = "hacks";

		break;
		case 'logs' :
		case 'activity' :



        	$controllerName = "logs";

		break;
		case 'templateoverrides' :
		case 'templateoverride' :



        	$controllerName = "templateoverrides";

		break;
		case 'languageoverrides' :
		case 'languageoverride' :



        	$controllerName = "languageoverrides";

		break;

		default:
			$view = 'hacks';
			$layout = 'default';

			JRequest::setVar( 'view', $view);
			JRequest::setVar( 'layout', $layout);
			$controllerName = "hacks";
			break;
}


if ($mainMenu)
{
		JSubMenuHelper::addEntry(JText::_("JOVERRIDER_VIEW_CONTROL_PANEL"), 'index.php?option=com_joverrider&view=hacks&layout=default', ($view == 'hacks' && $layout == 'default'));
		JSubMenuHelper::addEntry(JText::_("JOVERRIDER_VIEW_HACKS"), 'index.php?option=com_joverrider&view=hacks&layout=hacks', ($view == 'hacks' && $layout == 'hacks'));
		JSubMenuHelper::addEntry(JText::_("JOVERRIDER_VIEW_TEMPLATE_OVERRIDES"), 'index.php?option=com_joverrider&view=templateoverrides', ($view == 'templateoverrides'));
		JSubMenuHelper::addEntry(JText::_("JOVERRIDER_VIEW_LANGUAGE_OVERRIDES"), 'index.php?option=com_joverrider&view=languageoverrides', ($view == 'languageoverrides'));
		JSubMenuHelper::addEntry(JText::_("JOVERRIDER_VIEW_LOGS"), 'index.php?option=com_joverrider&view=logs', ($view == 'logs'));

}

require_once(JPATH_ADMIN_JOVERRIDER .DS.'classes'.DS.'jcontroller.php');
if ($controllerName)
	require_once( JPATH_ADMIN_JOVERRIDER .DS.'controllers'.DS.$controllerName.'.php' );

$controllerName = 'JoverriderController'.$controllerName;




// Create the controller
$controller = new $controllerName();

// Perform the Request task
$controller->execute( JRequest::getCmd('task') );

// Redirect if set by the controller
$controller->redirect();

