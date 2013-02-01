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



// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Joverrider component
 *
 * @static
 * @package		Joomla
 * @subpackage	Languageoverrides
 *
 */
class JoverriderViewLanguageoverrides extends JView
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
		$document->title = $document->titlePrefix . JText::_("JOVERRIDER_LAYOUT_LANGUAGE_OVERRIDES") . $document->titleSuffix;

		// Get data from the model
		$model 		= $this->getModel();
		$model->activeAll();
		$model->active('predefined', 'default');





		$items		= $model->getItems();

		$total		= $this->get( 'Total');
		$pagination = $this->get( 'Pagination' );

		// table ordering
		$lists['order'] = $model->getState('list.ordering');
		$lists['order_Dir'] = $model->getState('list.direction');

		$lists['enum']['languageoverrides.lang_group'] = JoverriderHelper::enumListGroup();

		$lists['enum']['languageoverrides.lang_code'] = JoverriderHelper::enumListLangCode();

		$lists['enum']['languageoverrides.lang_client'] = JoverriderHelper::enumList('languageoverrides', 'lang_client');

		// Toolbar
		jimport('joomla.html.toolbar');
		$bar = & JToolBar::getInstance('toolbar');
		
		$bar->appendButton( 'link', 'controlpanel', JText::_('JOVERRIDER_VIEW_CONTROL_PANEL'), 'index.php?option=com_joverrider&view=hacks&layout=default', false);

		if ($access->get('core.create')){
			$bar->appendButton( 'Standard', "synchronize", "JTOOLBAR_SYNCHRONIZE", "synchronize", false);
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
		//search : search on Constant + Text
		$this->filters['search'] = new stdClass();
		$this->filters['search']->value = $model->getState("search.search");

		//Hack > Name
		$model_lang_hack_id = JModel::getInstance('hacks', 'JoverriderModel');
		$this->filters['lang_hack_id'] = new stdClass();
		$this->filters['lang_hack_id']->list = $model_lang_hack_id->getItems();
		$this->filters['lang_hack_id']->value = $model->getState("filter.lang_hack_id");

		//Group
		$this->filters['lang_group'] = new stdClass();
		$this->filters['lang_group']->list = $lists['enum']['languageoverrides.lang_group'];
		array_unshift($this->filters['lang_group']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FILTER_NULL_GROUP")));
		$this->filters['lang_group']->value = $model->getState("filter.lang_group");

		//Location
		$this->filters['lang_client'] = new stdClass();
		$this->filters['lang_client']->list = $lists['enum']['languageoverrides.lang_client'];
		array_unshift($this->filters['lang_client']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FILTER_NULL_LOCATION")));
		$this->filters['lang_client']->value = $model->getState("filter.lang_client");

		//Language
		$this->filters['lang_code'] = new stdClass();
		$this->filters['lang_code']->list = $lists['enum']['languageoverrides.lang_code'];
		array_unshift($this->filters['lang_code']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FILTER_NULL_LANGUAGE")));
		$this->filters['lang_code']->value = $model->getState("filter.lang_code");

		//Publish
		$this->filters['publish'] = new stdClass();
		$this->filters['publish']->value = $model->getState("filter.publish");



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