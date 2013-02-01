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


jimport('joomla.application.component.model');
require_once(JPATH_ADMIN_JOVERRIDER .DS.'classes'.DS.'jmodel.item.php');

/**
 * Joverrider Component Templateoverride Model
 *
 * @package		Joomla
 * @subpackage	Joverrider
 *
 */
class JoverriderModelTemplateoverride extends JoverriderModelItem
{
	var $_name_plur = 'templateoverrides';
	var $params;



	/**
	 * Constructor
	 *
	 */
	function __construct()
	{
		parent::__construct();
		$this->_modes = array_merge($this->_modes, array(''));

	}

	/**
	 * Method to initialise the templateoverride data
	 *
	 * @access	private
	 * @return	boolean	True on success
	 */
	function _initData()
	{
		if (empty($this->_data))
		{
			//Default values shown in the form for new item creation
			$data = new stdClass();

			$data->id = 0;
			$data->attribs = null;
			$data->ov_hack_id = JRequest::getInt('filter_ov_hack_id', $this->getState('filter.ov_hack_id'));
			$data->ov_desc = null;
			$data->ov_client = JRequest::getVar('filter_ov_client', $this->getState('filter.ov_client'));
			$data->template = JRequest::getVar('filter_template', $this->getState('filter.template'));
			$data->ov_type = JRequest::getVar('filter_ov_type', $this->getState('filter.ov_type'));
			$data->ov_element = JRequest::getVar('filter_ov_element', $this->getState('filter.ov_element'));
			$data->view_name = JRequest::getVar('filter_view_name', $this->getState('filter.view_name'));
			$data->layout_type = JRequest::getVar('filter_layout_type', $this->getState('filter.layout_type'));
			$data->filename = JRequest::getVar('filter_filename', $this->getState('filter.filename'));
			$data->filename_override = null;
			$data->file_content = null;
			$data->publish = null;

			$this->_data = $data;

			return (boolean) $this->_data;
		}
		return true;
	}


	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return	void
	 * @since	1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication();
		$session = JFactory::getSession();

		if ($filter_ov_hack_id = $app->getUserState($this->context.'.filter.ov_hack_id'))
			$this->setState('filter.ov_hack_id', $filter_ov_hack_id, null, 'int');

		if ($filter_ov_client = $app->getUserState($this->context.'.filter.ov_client'))
			$this->setState('filter.ov_client', $filter_ov_client, null, 'varchar');

		if ($filter_template = $app->getUserState($this->context.'.filter.template'))
			$this->setState('filter.template', $filter_template, null, 'varchar');

		if ($filter_ov_type = $app->getUserState($this->context.'.filter.ov_type'))
			$this->setState('filter.ov_type', $filter_ov_type, null, 'varchar');

		if ($filter_ov_element = $app->getUserState($this->context.'.filter.ov_element'))
			$this->setState('filter.ov_element', $filter_ov_element, null, 'varchar');

		if ($filter_view_name = $app->getUserState($this->context.'.filter.view_name'))
			$this->setState('filter.view_name', $filter_view_name, null, 'varchar');

		if ($filter_layout_type = $app->getUserState($this->context.'.filter.layout_type'))
			$this->setState('filter.layout_type', $filter_layout_type, null, 'varchar');

		if ($filter_publish = $app->getUserState($this->context.'.filter.publish'))
			$this->setState('filter.publish', $filter_publish, null, 'cmd');

		if ($search_search = $app->getUserState($this->context.'.search.search'))
			$this->setState('search.search', $search_search, null, 'varchar');



		parent::populateState();
	}


	/**
	 * Method to build a the query string for the Templateoverride
	 *
	 * @access public
	 * @return integer
	 */
	function _buildQuery()
	{

		if (isset($this->_active['predefined']))
		switch($this->_active['predefined'])
		{
			case 'templateoverride': return $this->_buildQuery_templateoverride(); break;

		}



			$query = 'SELECT a.*'
					. 	$this->_buildQuerySelect()

					.	' FROM `#__joverrider_templateoverrides` AS a'
					. 	$this->_buildQueryJoin()

					. 	$this->_buildQueryWhere()

					.	'';

		return $query;
	}

	function _buildQuery_templateoverride()
	{

			$query = 'SELECT a.*'
					.	' , _ov_hack_id_.name AS `_ov_hack_id_name`'
					. 	$this->_buildQuerySelect()

					.	' FROM `#__joverrider_templateoverrides` AS a'
					.	' LEFT JOIN `#__joverrider_hacks` AS _ov_hack_id_ ON _ov_hack_id_.id = a.ov_hack_id'
					. 	$this->_buildQueryJoin()

					. 	$this->_buildQueryWhere()

					.	'';

		return $query;
	}



	function _buildQueryWhere($where = array())
	{
		$app = JFactory::getApplication();
		$acl = JoverriderHelper::getAcl();

		$where[] = 'a.id = '.(int) $this->_id;



		return parent::_buildQueryWhere($where);
	}

	/**
	 * Method to update templateoverride in mass
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function update($cids, $data)
	{
		foreach($cids as $cid)
		{
			if ($cid == 0)
				continue;
			$data['id'] = $cid;
			if (!$this->save($data))
				return false;
		}
		return true;
	}

	/**
	 * Method to save the templateoverride
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function save($data)
	{

		$row = $this->getTable();



		//Convert data from a stdClass
		if (is_object($data)){
			if (get_class($data) == 'stdClass')
				$data = JArrayHelper::fromObject($data);
		}

		//Current id if unspecified
		if ($data['id'] != null)
			$id = $data['id'];
		else if (($this->_id != null) && ($this->_id > 0))
			$id = $this->_id;


		//Load the current object, in order to process an update
		if (isset($id))
			$row->load($id);


		// Bind the form fields to the joverrider table
		$ignore = array();
		if (!$row->bind($data, $ignore)) {
			JError::raiseWarning(1000, $this->_db->getErrorMsg());
			return false;
		}





		// Make sure the joverrider table is valid
		if (!$row->check()) {
			JError::raiseWarning(1000, $this->_db->getErrorMsg());
			return false;
		}



		// Store the joverrider table to the database
		if (!$row->store())
        {
			JError::raiseWarning(1000, $this->_db->getErrorMsg());
			return false;
		}



		$this->_id = $row->id;
		$this->_data = $row;



		return true;
	}
	/**
	 * Method to delete a templateoverride
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function delete($cid = array())
	{
		$result = false;

		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );

			$query = 'DELETE FROM `#__joverrider_templateoverrides`'
				. ' WHERE id IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				JError::raiseWarning(1000, $this->_db->getErrorMsg());
				return false;
			}



		}

		return true;
	}
	/**
	 * Method to Convert the parameter fields into objects.
	 *
	 * @access public
	 * @return void
	 */
	protected function populateParams()
	{
		parent::populateParams();

		if (!isset($this->_data))
			return;

		$item = $this->_data;
		$acl = JoverriderHelper::getAcl();

		$item->params->set('access-view', true);

		if ($acl->get('core.edit'))
			$item->params->set('access-edit', true);

		if ($acl->get('core.delete'))
			$item->params->set('access-delete', true);



	}

	
	function publish($cid = array(), $publish = 1)
	{
		$publish_msg = ' Unpublished';
		if($publish){
			$publish_msg = ' Published';
		}
		$user 	= JFactory::getUser();
		$cid2publish = array();
		$message = new stdClass;
		$message->logErrors = '';
		$message->logData = '';
		foreach($cid as $d){
			// get data and check the publish state
			$item = $this->getItem($d);

			if($item->publish != $publish){
				$tmplOv = new JoverriderOverrides();
				if($tmplOv->publishTmplOverride($item, $publish)){
					$message->logData .= 'Template override id: ' . $d . $publish_msg .'<br />';
					$cid2publish[] = $d;
				} else {
					$message->logErrors .= 'ERROR - Template override id: ' . $d . '<br />';
				}
			} else {
				
				if($item->publish){
					$message->logData .= 'Template override id: ' . $d . ' already published<br />';
				} else {
					$message->logData .= 'Template override id: ' . $d . ' already unpublished<br />';
				}
			}
		}
		
		if (count( $cid2publish ))
		{
			JArrayHelper::toInteger($cid2publish);
			$cids = implode( ',', $cid2publish );

			$query = 'UPDATE #__joverrider_templateoverrides'
				. ' SET `publish` = '.(int) $publish
				. ' WHERE id IN ( '.$cids.' )'


			;
			$this->_db->setQuery( $query );
			if (!$this->_db->query()) {
				JError::raiseWarning(1000, $this->_db->getErrorMsg());
				return false;
			}		
		}

		return $message;
	}
	
	function cloneItem($ids)
	{
		$result = '';
		$error = '';
		foreach($ids as $tid)
		{
			$item = $this->getItem($tid);			
			
			$item->id = 0;
			$item->publish = 0;
			$item->ov_desc = 'Copy Of: ' . $item->ov_desc;
				
			if (!$this->save($item)) {
				$result .= 'FAILED: Cannot clone the template override ID '.$tid;
			} else {
				$result .= "SUCCESSFUL: template override ID ". $tid ." - CLONED!<br />";
			}
			
		}
		
		return $result;
	}

	/**
	 * Method to cascad delete templateoverrides items
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function integrityDelete($key, $cid = array())
	{

		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );
			$query = 'SELECT id FROM #__joverrider_templateoverrides'
				. " WHERE `" . $key . "` IN ( " . $cids . " )";
			$this->_db->setQuery( $query );

			$list = $this->_getList($query);

			$cidsDelete = array();
			if (count($list) > 0)
				foreach($list as $item)
					$cidsDelete[] = $item->id;

			return $this->delete($cidsDelete);

		}

		return true;
	}
	
	function integrityPublish($key, $cid = array(), $publish)
	{

		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );
			$query = 'SELECT id FROM #__joverrider_templateoverrides'
				. " WHERE `" . $key . "` IN ( " . $cids . " )";
			$this->_db->setQuery( $query );

			$list = $this->_getList($query);

			$cidsPublish = array();
			if (count($list) > 0)
				foreach($list as $item)
					$cidsPublish[] = $item->id;

			return $this->publish($cidsPublish, $publish);

		}

		return true;
	}	
	




}