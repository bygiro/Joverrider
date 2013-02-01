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

require_once(JPATH_ADMIN_JOVERRIDER .DS.'classes'.DS.'jmodel.list.php');


/**
 * Joverrider Component Templateoverrides Model
 *
 * @package		Joomla
 * @subpackage	Joverrider
 *
 */
class JoverriderModelTemplateoverrides extends JoverriderModelList
{
	var $_name_sing = 'templateoverride';



	/**
	 * Constructor
	 *
	 */
	function __construct($config = array())
	{
		//Define the sortables fields (in lists)
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'ov_hack_id', 'a.ov_hack_id',
				'_ov_hack_id_name', '_ov_hack_id_.name',
				'ov_client', 'a.ov_client',
				'template', 'a.template',
				'ov_type', 'a.ov_type',
				'ov_element', 'a.ov_element',
				'view_name', 'a.view_name',
				'layout_type', 'a.layout_type',
				'filename', 'a.filename',
				'filename_override', 'a.filename_override',
				'publish', 'a.publish',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'ov_hack_id' => 'int',
			'ov_client' => 'string',
			'template' => 'string',
			'ov_type' => 'string',
			'ov_element' => 'string',
			'view_name' => 'string',
			'layout_type' => 'string',
			'publish' => 'bool'
				));

		//Define the filterable fields
		$this->set('search_vars', array(
			'search' => 'varchar'
				));



		parent::__construct($config);


	}




	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 *
	 * @return	string		A store id.
	 * @since	1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.










		return parent::getStoreId($id);
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
			case 'default': return $this->_buildQuery_default(); break;

		}



		$query = ' SELECT a.*'

			. $this->_buildQuerySelect()

			. ' FROM `#__joverrider_templateoverrides` AS a '

			. $this->_buildQueryJoin() . ' '

			. $this->_buildQueryWhere()


			. $this->_buildQueryOrderBy()
			. $this->_buildQueryExtra()
		;

		return $query;
	}

	function _buildQuery_default()
	{

		$query = ' SELECT a.*'
					.	' , _ov_hack_id_.name AS `_ov_hack_id_name`'
					.	' , _ov_hack_id_.description AS `_ov_hack_id_description`'

			. $this->_buildQuerySelect()

			. ' FROM `#__joverrider_templateoverrides` AS a '
					.	' LEFT JOIN `#__joverrider_hacks` AS _ov_hack_id_ ON _ov_hack_id_.id = a.ov_hack_id'

			. $this->_buildQueryJoin() . ' '

			. $this->_buildQueryWhere()


			. $this->_buildQueryOrderBy()
			. $this->_buildQueryExtra()
		;

		return $query;
	}



	function _buildQueryWhere($where = array())
	{
		$app = JFactory::getApplication();
		$db= JFactory::getDBO();
		$acl = JoverriderHelper::getAcl();


		if (isset($this->_active['filter']) && $this->_active['filter'])
		{
			$filter_ov_hack_id = $this->getState('filter.ov_hack_id');
			if ($filter_ov_hack_id != '')		$where[] = "a.ov_hack_id = " . (int)$filter_ov_hack_id . "";

			$filter_ov_client = $this->getState('filter.ov_client');
			if ($filter_ov_client != '')		$where[] = "a.ov_client = " . $db->Quote($filter_ov_client);

			$filter_template = $this->getState('filter.template');
			if ($filter_template != '')		$where[] = "a.template = " . $db->Quote($filter_template);

			$filter_ov_type = $this->getState('filter.ov_type');
			if ($filter_ov_type != '')		$where[] = "a.ov_type = " . $db->Quote($filter_ov_type);

			$filter_ov_element = $this->getState('filter.ov_element');
			if ($filter_ov_element != '')		$where[] = "a.ov_element = " . $db->Quote($filter_ov_element);

			$filter_view_name = $this->getState('filter.view_name');
			if ($filter_view_name != '')		$where[] = "a.view_name = " . $db->Quote($filter_view_name);

			$filter_layout_type = $this->getState('filter.layout_type');
			if ($filter_layout_type != '')		$where[] = "a.layout_type = " . $db->Quote($filter_layout_type);

			$filter_publish = $this->getState('filter.publish');
			if ($filter_publish != '')		$where[] = "a.publish = " . $db->Quote($filter_publish);

			//search_search : search on Description + Filename + Filename override
			$search_search = $this->getState('search.search');
			$this->_addSearch('search', 'a.ov_desc', 'like');
			$this->_addSearch('search', 'a.filename', 'like');
			$this->_addSearch('search', 'a.filename_override', 'like');
			if (($search_search != '') && ($search_search_val = $this->_buildSearch('search', $search_search)))
				$where[] = $search_search_val;


		}


		return parent::_buildQueryWhere($where);
	}

	function _buildQueryOrderBy($order = array(), $pre_order = 'a.ov_hack_id')
	{

		return parent::_buildQueryOrderBy($order, $pre_order);
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
		$acl = JoverriderHelper::getAcl();
		if (!isset($this->_data))
			return;

		// Convert the parameter fields into objects.
		foreach ($this->_data as &$item)
		{

			$item->params->set('access-view', true);

			if ($acl->get('core.edit'))
				$item->params->set('access-edit', true);

			if ($acl->get('core.delete'))
				$item->params->set('access-delete', true);


		}

	}

}
