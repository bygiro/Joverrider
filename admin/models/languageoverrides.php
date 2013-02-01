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

require_once(JPATH_ADMIN_JOVERRIDER .DS.'classes'.DS.'jmodel.list.php');


/**
 * Joverrider Component Languageoverrides Model
 *
 * @package		Joomla
 * @subpackage	Joverrider
 *
 */
class JoverriderModelLanguageoverrides extends JoverriderModelList
{
	var $_name_sing = 'languageoverride';



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
				'lang_hack_id', 'a.lang_hack_id',
				'_lang_hack_id_name', '_lang_hack_id_.name',
				'lang_group', 'a.lang_group',
				'constant', 'a.constant',
				'lang_client', 'a.lang_client',
				'lang_code', 'a.lang_code',
				'publish', 'a.publish',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'lang_hack_id' => 'int',
			'lang_group' => 'string',
			'lang_client' => 'string',
			'lang_code' => 'string',
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
	 * Method to build a the query string for the Languageoverride
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

			. ' FROM `#__joverrider_languageoverrides` AS a '

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
					.	' , _lang_hack_id_.name AS `_lang_hack_id_name`'
					.	' , _lang_hack_id_.description AS `_lang_hack_id_description`'

			. $this->_buildQuerySelect()

			. ' FROM `#__joverrider_languageoverrides` AS a '
					.	' LEFT JOIN `#__joverrider_hacks` AS _lang_hack_id_ ON _lang_hack_id_.id = a.lang_hack_id'

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
			//search_search : search on Constant + Text
			$search_search = $this->getState('search.search');
			$this->_addSearch('search', 'a.constant', 'like');
			$this->_addSearch('search', 'a.text', 'like');
			if (($search_search != '') && ($search_search_val = $this->_buildSearch('search', $search_search)))
				$where[] = $search_search_val;

			$filter_lang_hack_id = $this->getState('filter.lang_hack_id');
			if ($filter_lang_hack_id != '')		$where[] = "a.lang_hack_id = " . (int)$filter_lang_hack_id . "";

			$filter_lang_group = $this->getState('filter.lang_group');
			if ($filter_lang_group != '')		$where[] = "a.lang_group = " . $db->Quote($filter_lang_group);

			$filter_lang_client = $this->getState('filter.lang_client');
			if ($filter_lang_client != '')		$where[] = "a.lang_client = " . $db->Quote($filter_lang_client);

			$filter_lang_code = $this->getState('filter.lang_code');
			if ($filter_lang_code != '')		$where[] = "a.lang_code = " . $db->Quote($filter_lang_code);

			$filter_publish = $this->getState('filter.publish');
			if ($filter_publish != '')		$where[] = "a.publish = " . $db->Quote($filter_publish);


		}


		return parent::_buildQueryWhere($where);
	}

	function _buildQueryOrderBy($order = array(), $pre_order = 'a.constant')
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
