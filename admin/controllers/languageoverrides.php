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


/**
 * Joverrider Languageoverrides Controller
 *
 * @package		Joomla
 * @subpackage	Joverrider
 *
 */
class JoverriderControllerLanguageoverrides extends JoverriderController
{
	var $ctrl = 'languageoverrides';
	var $singular = 'languageoverride';

	function __construct($config = array())
	{

		parent::__construct($config);

		$layout = JRequest::getCmd('layout');
		$render	= JRequest::getCmd('render');

		$this->context = strtolower('com_' . $this->getName() . '.' . $this->ctrl
					. ($layout?'.' . $layout:'')
					. ($render?'.' . $render:'')
					);

		$app = JFactory::getApplication();
		$this->registerTask( 'new',  'new_' );
		$this->registerTask( 'apply',  'apply' );






	}

	function display( )
	{



		parent::display();

		if (!JRequest::getCmd('option',null, 'get'))
		{
			//Kill the post and rebuild the url
			$this->setRedirect(JoverriderHelper::urlRequest());
			return;
		}

	}

	function new_()
	{
		if (!$this->can('core.create', JText::_("JTOOLBAR_NEW")))
			return;

		$vars = array();
		//Predefine fields depending on filters values
		$app = JFactory::getApplication();
		//Constant
		$filter_constant = $app->getUserState( $this->context . ".filter.constant");
		if ($filter_constant) $vars["filter_constant"] = $filter_constant;

		//Hack > Name
		$filter_lang_hack_id = $app->getUserState( $this->context . ".filter.lang_hack_id");
		if ($filter_lang_hack_id) $vars["filter_lang_hack_id"] = $filter_lang_hack_id;

		//Group
		$filter_lang_group = $app->getUserState( $this->context . ".filter.lang_group");
		if ($filter_lang_group) $vars["filter_lang_group"] = $filter_lang_group;

		//Location
		$filter_lang_client = $app->getUserState( $this->context . ".filter.lang_client");
		if ($filter_lang_client) $vars["filter_lang_client"] = $filter_lang_client;

		//Language
		$filter_lang_code = $app->getUserState( $this->context . ".filter.lang_code");
		if ($filter_lang_code) $vars["filter_lang_code"] = $filter_lang_code;

		//Publish
		$filter_publish = $app->getUserState( $this->context . ".filter.publish");
		if ($filter_publish) $vars["filter_publish"] = $filter_publish;



		JRequest::setVar( 'cid', 0 );
		JRequest::setVar( 'view'  , 'languageoverride');
		JRequest::setVar( 'layout', 'languageoverride' );

		$this->setRedirect(JoverriderHelper::urlRequest($vars));
	}

	function edit()
	{
		//Check Component ACL
		if (!$this->can(array('core.edit', 'core.edit.own'), JText::_("JTOOLBAR_EDIT")))
			return;

		$model = $this->getModel('languageoverride');
		$item = $model->getItem();

		//Check Item ACL
		if (!$this->can('access-edit', JText::_("JTOOLBAR_EDIT"), $item->params))
			return;

		$vars = array();
		JRequest::setVar( 'view'  , 'languageoverride');
		JRequest::setVar( 'layout', 'languageoverride' );

		$this->setRedirect(JoverriderHelper::urlRequest($vars));
	}

	function delete()
	{
		if (!$this->can(array('core.delete', 'core.delete.own'), JText::_("JTOOLBAR_DELETE")))
			return;

		// Check for request forgeries
		JRequest::checkToken() or JRequest::checkToken('get') or jexit( 'Invalid Token' );


		$model = $this->getModel('languageoverride');
		$item = $model->getItem();

		//Check Item ACL
		if (!$this->can('access-delete', JText::_("JTOOLBAR_DELETE"), $item->params))
			return;


        $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
        if (empty($cid))
			$cid = JRequest::getVar( 'cid', array(), 'get', 'array' );

		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseWarning(500, JText::sprintf( '_ALERT_PLEASE_MAKE_A_SELECTION_FROM_THE_LIST_TO', strtolower(JText::_("DELETE")) ) );
			$this->setRedirect(JoverriderHelper::urlRequest());
			return;
		}

		$vars = array();
		if (parent::_delete($cid))
		{
			JRequest::setVar( 'view'  , 'languageoverrides');
			JRequest::setVar( 'layout', 'default' );
			JRequest::setVar( 'cid', null );

		}

		$this->setRedirect(JoverriderHelper::urlRequest($vars));

	}

	function apply()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('languageoverride');
		$item = $model->getItem();

		if ($model->getId() == 0)
		{	//New item

			if (!$this->can('core.create', JText::_("JTOOLBAR_APPLY")))
				return;

		}
		else
		{	//Existing item
			if (!$this->can(array('core.edit', 'core.edit.own'), JText::_("JTOOLBAR_APPLY")))
				return;

			//Check Item ACL
			if (!$this->can('access-edit', JText::_("JTOOLBAR_APPLY"), $item->params))
				return;
		}


		$post	= JRequest::get('post');
		$post['id'] = $model->getId();



		if ($cid = parent::_apply($post))
		{
			$vars = array();
			JRequest::setVar( 'view'  , 'languageoverride');
			JRequest::setVar( 'layout', 'languageoverride' );

			$this->setRedirect(JoverriderHelper::urlRequest($vars));
		}
		else
			//Keep the post and stay on page
			parent::display();


	}



	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('languageoverride');
		$item = $model->getItem();

		if ($model->getId() == 0)
		{	//New item

			if (!$this->can('core.create', JText::_("JTOOLBAR_SAVE")))
				return;

		}
		else
		{	//Existing item
			if (!$this->can(array('core.edit', 'core.edit.own'), JText::_("JTOOLBAR_SAVE")))
				return;

			//Check Item ACL
			if (!$this->can('access-edit', JText::_("JTOOLBAR_SAVE"), $item->params))
				return;
		}


		$post	= JRequest::get('post');
		$post['id'] = $model->getId();

		// allow raw 
		$post['text'] = JRequest::getVar('text', '', 'post', 'string', JREQUEST_ALLOWRAW);

		if ($cid = parent::_save($post))
		{
			$vars = array();
			JRequest::setVar( 'view'  , 'languageoverrides');
			JRequest::setVar( 'layout', 'default' );
			JRequest::setVar( 'cid', null );

			$this->setRedirect(JoverriderHelper::urlRequest($vars));
		}
		else
			//Keep the post and stay on page
			parent::display();

	}

	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );


		$vars = array();
		JRequest::setVar( 'view'  , 'languageoverrides');
		JRequest::setVar( 'layout', 'default' );
		JRequest::setVar( 'cid', null );

		$this->setRedirect(JoverriderHelper::urlRequest($vars));

	}

	function toggle_publish()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		if (!$this->can(array('core.edit', 'core.edit.own'), JText::_("JTOOLBAR_EDIT")))
			return;


		$model = $this->getModel('Languageoverride');
		$languageoverride = $model->getItem();


		if ($languageoverride->id == 0)
		{
			$msg = JText::_( 'ERROR' );
			$this->setRedirect(JoverriderHelper::urlRequest(), $msg);
			return;
		}

		$data = array("publish" => is_null($languageoverride->publish)?1:!$languageoverride->publish);
        $this->_save($data);

		$this->setRedirect(JoverriderHelper::urlRequest());

	}


	function synchronize()
	{
		if (!$this->can('core.edit.state', JText::_("JTOOLBAR_SYNCHRONIZE")))
			return;

		// Check for request forgeries
		JRequest::checkToken() or JRequest::checkToken('get') or jexit( 'Invalid Token' );
		
		$app = JFactory::getApplication();
		
		$client  = JRequest::getVar('client', 0);
		$language  = JRequest::getVar('language');
		$syncWay  = JRequest::getVar('syncWay', 0);

		// import with the helper
		$sync = new JoverriderLangOverride();
		$sync->synchronizeLangOverrides($client, $language, $syncWay);
					
		$app->enqueueMessage($sync->result);		
		$vars = array();
		JRequest::setVar( 'view'  , 'languageoverrides');
		JRequest::setVar( 'layout', 'default' );
		JRequest::setVar( 'cid', null );

		$this->setRedirect(JoverriderHelper::urlRequest($vars));
	}

	function publish()
	{
		$app = JFactory::getApplication();
		if (!$this->can('core.edit.state', JText::_("JTOOLBAR_PUBLISH")))
			return;

		// Check for request forgeries
		JRequest::checkToken() or JRequest::checkToken('get') or jexit( 'Invalid Token' );
		
        $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
        if (empty($cid))
			$cid = JRequest::getVar( 'cid', array(), 'get', 'array' );

        JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseWarning(500, JText::sprintf( "JOVERRIDER_ALERT_PLEASE_MAKE_A_SELECTION_FROM_THE_LIST_TO", strtolower(JText::_("PUBLISH")) ) );
		}
		else
		{
			// publish
			$model = $this->getModel('languageoverride');
			$msg = $model->publish($cid, 1);
		}

		$app->enqueueMessage($msg->logErrors . $msg->logData);
		
		$vars = array();
		JRequest::setVar( 'view'  , 'languageoverrides');
		JRequest::setVar( 'layout', 'default' );
		JRequest::setVar( 'cid', null );

		$this->setRedirect(JoverriderHelper::urlRequest($vars));
	}

	function unpublish()
	{
		$app = JFactory::getApplication();
		if (!$this->can('core.edit.state', JText::_("JTOOLBAR_UNPUBLISH")))
			return;

		// Check for request forgeries
		JRequest::checkToken() or JRequest::checkToken('get') or jexit( 'Invalid Token' );
		
        $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
        if (empty($cid))
			$cid = JRequest::getVar( 'cid', array(), 'get', 'array' );

        JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseWarning(500, JText::sprintf( "JOVERRIDER_ALERT_PLEASE_MAKE_A_SELECTION_FROM_THE_LIST_TO", strtolower(JText::_("UNPUBLISH")) ) );
		}
		else
		{
			// unpublish
			$model = $this->getModel('languageoverride');
			$msg = $model->publish($cid, 0);
		}

		$app->enqueueMessage($msg->logErrors . $msg->logData);
		
		$vars = array();
		JRequest::setVar( 'view'  , 'languageoverrides');
		JRequest::setVar( 'layout', 'default' );
		JRequest::setVar( 'cid', null );

		$this->setRedirect(JoverriderHelper::urlRequest($vars));


	}	


}