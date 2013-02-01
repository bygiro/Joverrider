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

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


/**
 * Joverrider Templateoverrides Controller
 *
 * @package		Joomla
 * @subpackage	Joverrider
 *
 */
class JoverriderControllerTemplateoverrides extends JoverriderController
{
	var $ctrl = 'templateoverrides';
	var $singular = 'templateoverride';

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
		//Hack > Name
		$filter_ov_hack_id = $app->getUserState( $this->context . ".filter.ov_hack_id");
		if ($filter_ov_hack_id) $vars["filter_ov_hack_id"] = $filter_ov_hack_id;

		//Location
		$filter_ov_client = $app->getUserState( $this->context . ".filter.ov_client");
		if ($filter_ov_client) $vars["filter_ov_client"] = $filter_ov_client;

		//Destination Template
		$filter_template = $app->getUserState( $this->context . ".filter.template");
		if ($filter_template) $vars["filter_template"] = $filter_template;

		//Override type
		$filter_ov_type = $app->getUserState( $this->context . ".filter.ov_type");
		if ($filter_ov_type) $vars["filter_ov_type"] = $filter_ov_type;

		//Element
		$filter_ov_element = $app->getUserState( $this->context . ".filter.ov_element");
		if ($filter_ov_element) $vars["filter_ov_element"] = $filter_ov_element;

		//View name
		$filter_view_name = $app->getUserState( $this->context . ".filter.view_name");
		if ($filter_view_name) $vars["filter_view_name"] = $filter_view_name;

		//Layout type
		$filter_layout_type = $app->getUserState( $this->context . ".filter.layout_type");
		if ($filter_layout_type) $vars["filter_layout_type"] = $filter_layout_type;

		//Publish
		$filter_publish = $app->getUserState( $this->context . ".filter.publish");
		if ($filter_publish) $vars["filter_publish"] = $filter_publish;

		//Description
		$filter_ov_desc = $app->getUserState( $this->context . ".filter.ov_desc");
		if ($filter_ov_desc) $vars["filter_ov_desc"] = $filter_ov_desc;



		JRequest::setVar( 'cid', 0 );
		JRequest::setVar( 'view'  , 'templateoverride');
		JRequest::setVar( 'layout', 'templateoverride' );

		$this->setRedirect(JoverriderHelper::urlRequest($vars));
	}

	function edit()
	{
		//Check Component ACL
		if (!$this->can(array('core.edit', 'core.edit.own'), JText::_("JTOOLBAR_EDIT")))
			return;

		$model = $this->getModel('templateoverride');
		$item = $model->getItem();

		//Check Item ACL
		if (!$this->can('access-edit', JText::_("JTOOLBAR_EDIT"), $item->params))
			return;

		$vars = array();
		JRequest::setVar( 'view'  , 'templateoverride');
		JRequest::setVar( 'layout', 'templateoverride' );

		$this->setRedirect(JoverriderHelper::urlRequest($vars));
	}

	function delete()
	{
		if (!$this->can(array('core.delete', 'core.delete.own'), JText::_("JTOOLBAR_DELETE")))
			return;

		// Check for request forgeries
		JRequest::checkToken() or JRequest::checkToken('get') or jexit( 'Invalid Token' );


		$model = $this->getModel('templateoverride');
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
			JRequest::setVar( 'view'  , 'templateoverrides');
			JRequest::setVar( 'layout', 'default' );
			JRequest::setVar( 'cid', null );

		}

		$this->setRedirect(JoverriderHelper::urlRequest($vars));

	}

	function apply()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('templateoverride');
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

		// allow raw 
		$post['file_content'] = JRequest::getVar('file_content', '', 'post', 'string', JREQUEST_ALLOWRAW);
		
		if ($cid = parent::_apply($post))
		{
			$vars = array();
			JRequest::setVar( 'view'  , 'templateoverride');
			JRequest::setVar( 'layout', 'templateoverride' );

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

		$model = $this->getModel('templateoverride');
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
		$post['file_content'] = JRequest::getVar('file_content', '', 'post' , 'STRING', JREQUEST_ALLOWRAW);

		if ($cid = parent::_save($post))
		{
			$vars = array();
			JRequest::setVar( 'view'  , 'templateoverrides');
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
		JRequest::setVar( 'view'  , 'templateoverrides');
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


		$model = $this->getModel('Templateoverride');
		$templateoverride = $model->getItem();


		if ($templateoverride->id == 0)
		{
			$msg = JText::_( 'ERROR' );
			$this->setRedirect(JoverriderHelper::urlRequest(), $msg);
			return;
		}

		$data = array("publish" => is_null($templateoverride->publish)?1:!$templateoverride->publish);
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
		$onlyDefault  = JRequest::getVar('onlyDefault', 1);
		$syncWay  = JRequest::getVar('syncWay', 0);

		// import with the helper
		$sync = new JoverriderOverrides();
		$sync->synchronizeTemplateOverrides($client, $onlyDefault, $syncWay);
		
		// write log of the task
	//	JoverriderHelper::writeLog($sync->result, $sync->logReport);
			
		$app->enqueueMessage($sync->result);		
		$vars = array();
		JRequest::setVar( 'view'  , 'templateoverrides');
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
			$model = $this->getModel('templateoverride');
			$msg = $model->publish($cid, 1);
		}

		$app->enqueueMessage($msg->logErrors . $msg->logData);
		
		$vars = array();
		JRequest::setVar( 'view'  , 'templateoverrides');
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
			$model = $this->getModel('templateoverride');
			$msg = $model->publish($cid, 0);
		}

		$app->enqueueMessage($msg->logErrors . $msg->logData);
		
		$vars = array();
		JRequest::setVar( 'view'  , 'templateoverrides');
		JRequest::setVar( 'layout', 'default' );
		JRequest::setVar( 'cid', null );

		$this->setRedirect(JoverriderHelper::urlRequest($vars));


	}

	function cloneItems()
	{
		// Check for request forgeries
		JRequest::checkToken() or JRequest::checkToken('get') or jexit( 'Invalid Token' );

		if (!$this->can('core.create', JText::_("JTOOLBAR_CLONEITEMS")))
				return;
				
        $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
        if (empty($cid))
			$cid = JRequest::getVar( 'cid', array(), 'get', 'array' );

        JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseWarning(500, JText::sprintf( "JOVERRIDER_ALERT_PLEASE_MAKE_A_SELECTION_FROM_THE_LIST_TO", strtolower(JText::_("PUBLISH")) ) );
		} else {

			$model = $this->getModel('templateoverride');
			$msg = $model->cloneItem($cid);
			if (!$msg){
				JError::raiseWarning( 1000, JText::_("ERROR") );	
			}
						
			$vars = array();
			JRequest::setVar( 'view'  , 'templateoverrides');
			JRequest::setVar( 'layout', 'default' );
			JRequest::setVar( 'cid', null );

			$this->setRedirect(JoverriderHelper::urlRequest($vars), $msg);
		}
	}	





}
