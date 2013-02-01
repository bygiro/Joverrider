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
class JoverriderViewLanguageoverride extends JView
{
	function display($tpl = null)
	{
		$layout = $this->getLayout();
		switch($layout)
		{
			case 'languageoverride':

				$fct = "display_" . $layout;
				$this->$fct($tpl);
				break;
		}

	}
	function display_languageoverride($tpl = null)
	{
		$access = JoverriderHelper::getACL();

		$model	= $this->getModel();
		$model->activeAll();
		$model->active('predefined', 'languageoverride');

		$document	= &JFactory::getDocument();
		$document->title = $document->titlePrefix . JText::_("JOVERRIDER_LAYOUT_LANGUAGE_OVERRIDE") . $document->titleSuffix;

		$document->addScript(JURI::root().'/administrator/components/com_joverrider/js/searchstrings.js');

		$state	= $this->get('State');

		// Check whether the cache has to be refreshed
		$cached_time = JFactory::getApplication()->getUserState('joverrider.language.cachedtime', 0);
		if(time() - $cached_time > 60 * 5)
		{
			$state->set('cache_expired', true);
		}

		// Add strings for translations in Javascript
		JText::script('JOVERRIDER_VIEW_OVERRIDE_NO_RESULTS');
		
		$lists = array();

		//get the languageoverride
		$languageoverride	= $model->getItem();
		$isNew		= ($languageoverride->id < 1);

		//For security, execute here a redirection if not authorized to enter a form
		if (($isNew && !$access->get('core.create'))
		|| (!$isNew && !$languageoverride->params->get('access-edit')))
		{
				JError::raiseWarning(403, JText::sprintf( "JERROR_ALERTNOAUTHOR") );
				JoverriderHelper::redirectBack();
		}


		$lists['enum']['languageoverrides.lang_group'] = JoverriderHelper::enumList('languageoverrides', 'lang_group');

		$lists['enum']['languageoverrides.lang_code'] = JoverriderHelper::enumListLangCode();

		$lists['enum']['languageoverrides.lang_client'] = JoverriderHelper::enumList('languageoverrides', 'lang_client');

		//Group
		$lists['select']['lang_group'] = new stdClass();
		$lists['select']['lang_group']->list = $lists['enum']['languageoverrides.lang_group'];
		array_unshift($lists['select']['lang_group']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FIELD_NULL_GROUP")));
		$lists['select']['lang_group']->value = $languageoverride->lang_group;

		//Language
		$lists['select']['lang_code'] = new stdClass();
		$lists['select']['lang_code']->list = $lists['enum']['languageoverrides.lang_code'];
		array_unshift($lists['select']['lang_code']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FIELD_NULL_LANGUAGE")));
		$lists['select']['lang_code']->value = $languageoverride->lang_code;

		//Location
		$lists['select']['lang_client'] = new stdClass();
		$lists['select']['lang_client']->list = $lists['enum']['languageoverrides.lang_client'];
		array_unshift($lists['select']['lang_client']->list, array("value"=>"", "text" => JText::_("JOVERRIDER_FIELD_NULL_LOCATION")));
		$lists['select']['lang_client']->value = $languageoverride->lang_client;

		// Toolbar
		jimport('joomla.html.toolbar');
		$bar = & JToolBar::getInstance('toolbar');
		if ($access->get('core.edit') || $access->get('core.edit.own'))
			$bar->appendButton( 'Standard', "apply", "JTOOLBAR_APPLY", "apply", false);
		if ($access->get('core.edit') || ($isNew && $access->get('core.create') || $access->get('core.edit.own')))
			$bar->appendButton( 'Standard', "save", "JTOOLBAR_SAVE", "save", false);
		if (!$isNew && ($access->get('core.delete') || $languageoverride->params->get('access-delete')))
			$bar->appendButton( 'Standard', "delete", "JTOOLBAR_DELETE", "delete", false);
		$bar->appendButton( 'Standard', "cancel", "JTOOLBAR_CANCEL", "cancel", false, false );




		$config	= JComponentHelper::getParams( 'com_joverrider' );

		JRequest::setVar( 'hidemainmenu', true );

		$this->assignRef('user',		JFactory::getUser());
		$this->assignRef('access',		$access);
		$this->assignRef('lists',		$lists);
		$this->assignRef('state',		$state);
		$this->assignRef('languageoverride',		$languageoverride);
		$this->assignRef('config',		$config);
		$this->assignRef('isNew',		$isNew);

		parent::display($tpl);
	}




}