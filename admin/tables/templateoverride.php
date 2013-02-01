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
defined('_JEXEC') or die('Restricted access');


/**
* Joverrider Table class
*
* @package		Joomla
* @subpackage	Joverrider
*
*/
class TableTemplateoverride extends JTable
{

	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var string
	 */
	var $attribs = null;

	/**
	 * @var int
	 */
	var $ov_hack_id = null;
	/**
	 * @var string
	 */
	var $ov_desc = null;
	/**
	 * @var string
	 */
	var $ov_client = null;
	/**
	 * @var string
	 */
	var $template = null;
	/**
	 * @var string
	 */
	var $ov_type = null;
	/**
	 * @var string
	 */
	var $ov_element = null;
	/**
	 * @var string
	 */
	var $view_name = null;
	/**
	 * @var string
	 */
	var $layout_type = null;
	/**
	 * @var string
	 */
	var $filename = null;
	/**
	 * @var string
	 */
	var $filename_override = null;
	/**
	 * @var string
	 */
	var $file_content = null;
	/**
	 * @var bool
	 */
	var $publish = null;






	/**
	* Constructor
	*
	* @param object Database connector object
	*
	*/
	function __construct(& $db)
	{
		parent::__construct('#__joverrider_templateoverrides', 'id', $db);
	}




	/**
	* Overloaded bind function
	*
	* @acces public
	* @param array $hash named array
	* @return null|string	null is operation was satisfactory, otherwise returns an error
	* @see JTable:bind
	*
	*/
	function bind($src, $ignore = array())
	{

		if (isset($src['attribs']) && is_array($src['attribs']))
		{
			$registry = new JRegistry;
			$registry->loadArray($src['attribs']);
			$src['attribs'] = (string) $registry;
		}

		return parent::bind($src, $ignore);
	}

	/**
	 * Overloaded check method to ensure data integrity
	 *
	 * @access public
	 * @return boolean True on success
	 * @see JTable:check
	 */
	function check()
	{
		$valid = true;

		$filter = new JFilterInput(array(), array(), 0, 0);
		$this->ov_hack_id = $filter->clean($this->ov_hack_id, 'INT');
		$this->ov_desc = $filter->clean($this->ov_desc, 'STRING');
		$this->ov_client = $filter->clean($this->ov_client, 'INT'); 
		$this->template = $filter->clean($this->template, 'STRING');
		$this->ov_type = $filter->clean($this->ov_type, 'STRING');
		$this->ov_element = $filter->clean($this->ov_element, 'STRING');
		$this->view_name = $filter->clean($this->view_name, 'STRING');

		$this->filename = $filter->clean($this->filename, 'STRING');
		$this->filename_override = $filter->clean($this->filename_override, 'STRING');
		$this->file_content = JoverriderHelper::stringfix($this->file_content); 
		$this->publish = $filter->clean($this->publish, 'BOOL');




		if ($this->publish === null)
			$this->publish = 0;



		if (($this->ov_client === null) || ($this->ov_client === '')){
			JError::raiseWarning(2001, JText::sprintf("JOVERRIDER_VALIDATOR_IS_REQUESTED_PLEASE_RETRY", JText::_("JOVERRIDER_FIELD_LOCATION")));
			$valid = false;
		}

		if (($this->template === null) || ($this->template === '')){
			JError::raiseWarning(2001, JText::sprintf("JOVERRIDER_VALIDATOR_IS_REQUESTED_PLEASE_RETRY", JText::_("JOVERRIDER_FIELD_DESTINATION_TEMPLATE")));
			$valid = false;
		}

		if (($this->ov_type === null) || ($this->ov_type === '')){
			JError::raiseWarning(2001, JText::sprintf("JOVERRIDER_VALIDATOR_IS_REQUESTED_PLEASE_RETRY", JText::_("JOVERRIDER_FIELD_OVERRIDE_TYPE")));
			$valid = false;
		}

		if (($this->ov_element === null) || ($this->ov_element === '')){
			JError::raiseWarning(2001, JText::sprintf("JOVERRIDER_VALIDATOR_IS_REQUESTED_PLEASE_RETRY", JText::_("JOVERRIDER_FIELD_ELEMENT")));
			$valid = false;
		}

		if ((($this->view_name === null) || ($this->view_name === '')) && (($this->ov_type == 'component') || ($this->ov_type == 'menu'))){ 
			JError::raiseWarning(2001, JText::sprintf("JOVERRIDER_VALIDATOR_IS_REQUESTED_PLEASE_RETRY", JText::_("JOVERRIDER_FIELD_VIEW_NAME")));
			$valid = false;
		}

		if (($this->filename === null) || ($this->filename === '')){
			JError::raiseWarning(2001, JText::sprintf("JOVERRIDER_VALIDATOR_IS_REQUESTED_PLEASE_RETRY", JText::_("JOVERRIDER_FIELD_FILENAME")));
			$valid = false;
		}

		if (($this->filename_override === null) || ($this->filename_override === '')){
			JError::raiseWarning(2001, JText::sprintf("JOVERRIDER_VALIDATOR_IS_REQUESTED_PLEASE_RETRY", JText::_("JOVERRIDER_FIELD_FILENAME_OVERRIDE")));
			$valid = false;
		}

		if (($this->file_content === null) || ($this->file_content === '')){
			JError::raiseWarning(2001, JText::sprintf("JOVERRIDER_VALIDATOR_IS_REQUESTED_PLEASE_RETRY", JText::_("JOVERRIDER_FIELD_FILE_CONTENT")));
			$valid = false;
		}
		
		// check type of override: core or alternative
		$root = JPATH_SITE . DS;
		if($this->ov_client == 1){
			$root = JPATH_SITE . DS . basename(JPATH_ADMINISTRATOR);
		}
		switch($this->ov_type){
			case 'component':
			case 'menu':
				$path = JPath::clean($root . DS . 'components' . DS . $this->ov_element . DS . 'views' . DS . $this->view_name . DS . 'tmpl' . DS . $this->filename_override);
			break;
			case 'module':
				$path = JPath::clean($root . DS . 'modules' . DS . $this->ov_element . DS . 'tmpl' . DS . $this->filename_override);
			break;
			case 'system':
				//$startingPath = JPath::clean($root . DS . 'modules' . DS . $element );
			break;
		}
		if(file_exists($path)){
			$this->layout_type = 'core';
		} else {
			$this->layout_type = 'alternative';
		}
		
		


		return $valid;
	}
}
