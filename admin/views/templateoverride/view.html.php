<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V1.5.2   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.4.0
* @package		Joverrider
* @subpackage	Templateoverrides
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



// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Joverrider component
 *
 * @static
 * @package		Joomla
 * @subpackage	Templateoverrides
 *
 */
class JoverriderViewTemplateoverride extends JView
{
	function display($tpl = null)
	{
		$layout = $this->getLayout();
		switch($layout)
		{
			case 'templateoverride':

				$fct = "display_" . $layout;
				$this->$fct($tpl);
				break;
		}

	}
	function display_templateoverride($tpl = null)
	{
		$app = JFactory::getApplication();
		$option	= JRequest::getCmd('option');

		$user 	= JFactory::getUser();

		$access = JoverriderHelper::getACL();

		$model	= $this->getModel();
		$model->activeAll();
		$model->active('predefined', 'templateoverride');

		$document	= &JFactory::getDocument();
		$document->title = $document->titlePrefix . JText::_("JOVERRIDER_LAYOUT_TEMPLATE_OVERRIDE") . $document->titleSuffix;




		$lists = array();

		//get the templateoverride
		$templateoverride	= $model->getItem();
		$isNew		= ($templateoverride->id < 1);

		//For security, execute here a redirection if not authorized to enter a form
		if (($isNew && !$access->get('core.create'))
		|| (!$isNew && !$templateoverride->params->get('access-edit')))
		{
				JError::raiseWarning(403, JText::sprintf( "JERROR_ALERTNOAUTHOR") );
				JoverriderHelper::redirectBack();
		}

		
		$paths = JoverriderHelper::createOverridePaths($templateoverride);
		$templateoverride->overridefile = JPath::clean($paths->overridefile . DS . $templateoverride->filename);
		$templateoverride->item2override = JPath::clean($paths->item2override . DS . $templateoverride->filename);
		if(!$isNew){
			$file_source = JoverriderHelper::loadfile2($templateoverride->overridefile);
			$templateoverride->filename_source = $file_source->filecontent;
		}
		$root = JPATH_SITE . DS;
		if($templateoverride->ov_client){
			$root = JPATH_SITE . DS . basename(JPATH_ADMINISTRATOR);
		}
		
		switch($templateoverride->ov_type){
			case 'component':
				$startingPath = JPath::clean($root . DS . 'components' . DS . $templateoverride->ov_element);
				$lists['enum']['templateoverrides.view_name'] = JoverriderHelper::enumListViewName(1, $startingPath . DS . 'views');
				$lists['enum']['templateoverrides.filename'] = JoverriderHelper::enumListFilename('php', $startingPath . DS . 'views' . DS . $templateoverride->view_name . DS . 'tmpl');

			break;
			
			case 'menu':
				$startingPath = JPath::clean($root . DS . 'components' . DS . $templateoverride->ov_element);
				$lists['enum']['templateoverrides.view_name'] = JoverriderHelper::enumListViewName(1, $startingPath . DS . 'views');
				$lists['enum']['templateoverrides.filename'] = JoverriderHelper::enumListFilename('xml', $startingPath . DS . 'views' . DS . $templateoverride->view_name . DS . 'tmpl');
			break;
			
			case 'module':
				$lists['enum']['templateoverrides.view_name'] = JoverriderHelper::enumList('templateoverrides', 'ov_type');
				
				$startingPath = JPath::clean($root . DS . 'modules' . DS . $templateoverride->ov_element);
				$lists['enum']['templateoverrides.filename'] = JoverriderHelper::enumListFilename('php', $startingPath . DS . 'tmpl');

			break;
			
			case 'system':
				//$startingPath = JPath::clean($root . DS . 'modules' . DS . $override->ov_element );
			break;
			
			default:
				$lists['enum']['templateoverrides.view_name'] = JoverriderHelper::enumList('templateoverrides', 'ov_type');
				$lists['enum']['templateoverrides.filename'] = JoverriderHelper::enumList('templateoverrides', 'filename');
			break;
		}	
		

		$lists['enum']['templateoverrides.ov_client'] = JoverriderHelper::enumList('templateoverrides', 'ov_client');

		$lists['enum']['templateoverrides.template'] = JoverriderHelper::enumListTemplate(1, $templateoverride->ov_client); 

		$lists['enum']['templateoverrides.ov_type'] = JoverriderHelper::enumList('templateoverrides', 'ov_type');
		
		$lists['enum']['templateoverrides.ov_element'] = JoverriderHelper::enumListElement(1, $templateoverride->ov_type, $startingPath); 

		$lists['enum']['templateoverrides.layout_type'] = JoverriderHelper::enumList('templateoverrides', 'layout_type');

		//Location
		$lists['select']['ov_client'] = new stdClass();
		$lists['select']['ov_client']->list = $lists['enum']['templateoverrides.ov_client'];
		array_unshift($lists['select']['ov_client']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FIELD_NULL_LOCATION")));
		$lists['select']['ov_client']->value = $templateoverride->ov_client;

		//Destination Template
		$lists['select']['template'] = new stdClass();
		$lists['select']['template']->list = $lists['enum']['templateoverrides.template'];
		array_unshift($lists['select']['template']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FIELD_NULL_DESTINATION_TEMPLATE")));
		$lists['select']['template']->value = $templateoverride->template;

		//Override type
		$lists['select']['ov_type'] = new stdClass();
		$lists['select']['ov_type']->list = $lists['enum']['templateoverrides.ov_type'];
		array_unshift($lists['select']['ov_type']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FIELD_NULL_OVERRIDE_TYPE")));
		$lists['select']['ov_type']->value = $templateoverride->ov_type;

		//Element
		$lists['select']['ov_element'] = new stdClass();
		$lists['select']['ov_element']->list = $lists['enum']['templateoverrides.ov_element'];
		array_unshift($lists['select']['ov_element']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FIELD_NULL_ELEMENT")));
		$lists['select']['ov_element']->value = $templateoverride->ov_element;

		//View name
		$lists['select']['view_name'] = new stdClass();
		$lists['select']['view_name']->list = $lists['enum']['templateoverrides.view_name'];
		array_unshift($lists['select']['view_name']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FIELD_NULL_VIEW_NAME")));
		$lists['select']['view_name']->value = $templateoverride->view_name;

		//Filename
		$lists['select']['filename'] = new stdClass();
		$lists['select']['filename']->list = $lists['enum']['templateoverrides.filename'];
		array_unshift($lists['select']['filename']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FIELD_NULL_FILENAME")));
		$lists['select']['filename']->value = $templateoverride->filename;

		// Toolbar
		jimport('joomla.html.toolbar');
		$bar = & JToolBar::getInstance('toolbar');
		if ($access->get('core.edit') || $access->get('core.edit.own'))
			$bar->appendButton( 'Standard', "apply", "JTOOLBAR_APPLY", "apply", false);
		if ($access->get('core.edit') || ($isNew && $access->get('core.create') || $access->get('core.edit.own')))
			$bar->appendButton( 'Standard', "save", "JTOOLBAR_SAVE", "save", false);
		if (!$isNew && ($access->get('core.delete') || $templateoverride->params->get('access-delete')))
			$bar->appendButton( 'Standard', "delete", "JTOOLBAR_DELETE", "delete", false);
		$bar->appendButton( 'Standard', "cancel", "JTOOLBAR_CANCEL", "cancel", false, false );




		$config	= JComponentHelper::getParams( 'com_joverrider' );

		JRequest::setVar( 'hidemainmenu', true );

		$this->assignRef('user',		JFactory::getUser());
		$this->assignRef('access',		$access);
		$this->assignRef('lists',		$lists);
		$this->assignRef('templateoverride',		$templateoverride);
		$this->assignRef('config',		$config);
		$this->assignRef('isNew',		$isNew);

		parent::display($tpl);
	}




}