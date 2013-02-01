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
defined('_JEXEC') or die('Restricted access');


/**
* Joverrider Table class
*
* @package		Joomla
* @subpackage	Joverrider
*
*/
class TableLanguageoverride extends JTable
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
	var $lang_hack_id = null;
	/**
	 * @var string
	 */
	var $lang_group = null;
	/**
	 * @var string
	 */
	var $constant = null;
	/**
	 * @var string
	 */
	var $text = null;
	/**
	 * @var string
	 */
	var $lang_code = null;
	/**
	 * @var string
	 */
	var $lang_client = null;
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
		parent::__construct('#__joverrider_languageoverrides', 'id', $db);
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
		$this->lang_hack_id = $filter->clean($this->lang_hack_id, 'INT');
		$this->lang_group = $filter->clean($this->lang_group, 'STRING');
		$this->constant = $filter->clean($this->constant, 'STRING');
	//	
		$this->lang_code = $filter->clean($this->lang_code, 'STRING');
		$this->lang_client = $filter->clean($this->lang_client, 'STRING');
		$this->publish = $filter->clean($this->publish, 'BOOL');




		if ($this->publish === null)
			$this->publish = 0;



		if (($this->constant === null) || ($this->constant === '')){
			JError::raiseWarning(2001, JText::sprintf("JOVERRIDER_VALIDATOR_IS_REQUESTED_PLEASE_RETRY", JText::_("JOVERRIDER_FIELD_CONSTANT")));
			$valid = false;
		}

		if (($this->lang_code === null) || ($this->lang_code === '')){
			JError::raiseWarning(2001, JText::sprintf("JOVERRIDER_VALIDATOR_IS_REQUESTED_PLEASE_RETRY", JText::_("JOVERRIDER_FIELD_LANGUAGE")));
			$valid = false;
		}

		if (($this->lang_client === null) || ($this->lang_client === '')){
			JError::raiseWarning(2001, JText::sprintf("JOVERRIDER_VALIDATOR_IS_REQUESTED_PLEASE_RETRY", JText::_("JOVERRIDER_FIELD_LOCATION")));
			$valid = false;
		}




		return $valid;
	}
}
