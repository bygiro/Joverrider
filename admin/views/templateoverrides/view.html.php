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
class JoverriderViewTemplateoverrides extends JView
{
	/*
	 * Define here the default list limit
	 */
	protected $_default_limit = null;

	function display($tpl = null)
	{
		$app = JFactory::getApplication();
		$config = JFactory::getConfig();

		$option	= JRequest::getCmd('option');
		$view	= JRequest::getCmd('view');
		$layout = $this->getLayout();



		switch($layout)
		{
			case 'default':

				$fct = "display_" . $layout;
				$this->$fct($tpl);
				break;
		}

	}
	function display_default($tpl = null)
	{
		$app = JFactory::getApplication();
		$option	= JRequest::getCmd('option');

		$user 	= JFactory::getUser();

		$access = JoverriderHelper::getACL();
		$state		= $this->get('State');

		$document	= &JFactory::getDocument();
		$document->title = $document->titlePrefix . JText::_("JOVERRIDER_LAYOUT_TEMPLATE_OVERRIDES") . $document->titleSuffix;

		// Get data from the model
		$model 		= $this->getModel();
		$model->activeAll();
		$model->active('predefined', 'default');





		$items		= $model->getItems();

		$total		= $this->get( 'Total');
		$pagination = $this->get( 'Pagination' );

		
		$root = JPATH_SITE . DS;
		if($templateoverride->ov_client){
			$root = JPATH_SITE . DS . basename(JPATH_ADMINISTRATOR);
		}
		
		switch($templateoverride->ov_type){
			case 'component':
			case 'menu':
				$startingPath = JPath::clean($root . DS . 'components' . DS . $templateoverride->ov_element);
			break;
			
			case 'module':			
				$startingPath = JPath::clean($root . DS . 'modules' . DS . $templateoverride->ov_element);
			break;
			
			case 'system':
				//$startingPath = JPath::clean($root . DS . 'modules' . DS . $override->ov_element );
			break;
		}	
				
		
		// table ordering
		$lists['order'] = $model->getState('list.ordering');
		$lists['order_Dir'] = $model->getState('list.direction');

		$lists['enum']['templateoverrides.ov_client'] = JoverriderHelper::enumList('templateoverrides', 'ov_client');

		$lists['enum']['templateoverrides.template'] = JoverriderHelper::enumListTemplate(0, $templateoverride->ov_client); 

		$lists['enum']['templateoverrides.ov_type'] = JoverriderHelper::enumList('templateoverrides', 'ov_type');

		$lists['enum']['templateoverrides.ov_element'] = JoverriderHelper::enumListElement(0, null, $startingPath); 

		$lists['enum']['templateoverrides.view_name'] = JoverriderHelper::enumListViewName(0, $startingPath . DS . 'views'); 

		$lists['enum']['templateoverrides.layout_type'] = JoverriderHelper::enumList('templateoverrides', 'layout_type');

		$lists['enum']['templateoverrides.filename'] = JoverriderHelper::enumList('templateoverrides', 'filename');

		// Toolbar
		jimport('joomla.html.toolbar');
		$bar = & JToolBar::getInstance('toolbar');
		
		$bar->appendButton( 'link', 'controlpanel', JText::_('JOVERRIDER_VIEW_CONTROL_PANEL'), 'index.php?option=com_joverrider&view=hacks&layout=default', false);
		if ($access->get('core.create')){
			$bar->appendButton( 'Standard', "synchronize", "JTOOLBAR_SYNCHRONIZE", "synchronize", false);
			JToolBarHelper::divider();
			$bar->appendButton( 'Standard', "copy", "JTOOLBAR_CLONEITEMS", "cloneItems", true);
		}		
		
		if ($access->get('core.create'))
			$bar->appendButton( 'Standard', "new", "JTOOLBAR_NEW", "new", false);
		if ($access->get('core.edit') || $access->get('core.edit.own'))
			$bar->appendButton( 'Standard', "edit", "JTOOLBAR_EDIT", "edit", true);
		if ($access->get('core.delete') || $access->get('core.delete.own'))
			$bar->appendButton( 'Standard', "delete", "JTOOLBAR_DELETE", "delete", true);

		if ($access->get('core.edit.state'))
			$bar->appendButton( 'Standard', "publish", "JTOOLBAR_PUBLISH", "publish", true);
		if ($access->get('core.edit.state'))
			$bar->appendButton( 'Standard', "unpublish", "JTOOLBAR_UNPUBLISH", "unpublish", true);
 
		if ($access->get('core.admin'))
			$bar->appendButton( 'Popup', 'options', JText::_('JTOOLBAR_OPTIONS'), 'index.php?option=com_config&view=component&component=' . $option . '&path=&tmpl=component');



		//Filters
		//Hack > Name
		$model_ov_hack_id = JModel::getInstance('hacks', 'JoverriderModel');
		$this->filters['ov_hack_id'] = new stdClass();
		$this->filters['ov_hack_id']->list = $model_ov_hack_id->getItems();
		$this->filters['ov_hack_id']->value = $model->getState("filter.ov_hack_id");

		//Location
		$this->filters['ov_client'] = new stdClass();
		$this->filters['ov_client']->list = $lists['enum']['templateoverrides.ov_client'];
		array_unshift($this->filters['ov_client']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FILTER_NULL_LOCATION")));
		$this->filters['ov_client']->value = $model->getState("filter.ov_client");

		//Destination Template
		$this->filters['template'] = new stdClass();
		$this->filters['template']->list = $lists['enum']['templateoverrides.template'];
		array_unshift($this->filters['template']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FILTER_NULL_DESTINATION_TEMPLATE")));
		$this->filters['template']->value = $model->getState("filter.template");

		//Override type
		$this->filters['ov_type'] = new stdClass();
		$this->filters['ov_type']->list = $lists['enum']['templateoverrides.ov_type'];
		array_unshift($this->filters['ov_type']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FILTER_NULL_OVERRIDE_TYPE")));
		$this->filters['ov_type']->value = $model->getState("filter.ov_type");

		//Element
		$this->filters['ov_element'] = new stdClass();
		$this->filters['ov_element']->list = $lists['enum']['templateoverrides.ov_element'];
		array_unshift($this->filters['ov_element']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FILTER_NULL_ELEMENT")));
		$this->filters['ov_element']->value = $model->getState("filter.ov_element");

		//View name
		$this->filters['view_name'] = new stdClass();
		$this->filters['view_name']->list = $lists['enum']['templateoverrides.view_name'];
		array_unshift($this->filters['view_name']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FILTER_NULL_VIEW_NAME")));
		$this->filters['view_name']->value = $model->getState("filter.view_name");

		//Layout type
		$this->filters['layout_type'] = new stdClass();
		$this->filters['layout_type']->list = $lists['enum']['templateoverrides.layout_type'];
		array_unshift($this->filters['layout_type']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FILTER_NULL_LAYOUT_TYPE")));
		$this->filters['layout_type']->value = $model->getState("filter.layout_type");

		//Publish
		$this->filters['publish'] = new stdClass();
		$this->filters['publish']->value = $model->getState("filter.publish");

		//search : search on Description + Filename + Filename override
		$this->filters['search'] = new stdClass();
		$this->filters['search']->value = $model->getState("search.search");



		$config	= JComponentHelper::getParams( 'com_joverrider' );

		$this->assignRef('user',		JFactory::getUser());
		$this->assignRef('access',		$access);
		$this->assignRef('state',		$state);
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);
		$this->assignRef('config',		$config);

		parent::display($tpl);
	}





}