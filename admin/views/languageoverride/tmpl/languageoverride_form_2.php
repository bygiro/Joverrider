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

defined('_JEXEC') or die('Restricted access');



$isNew		= ($this->languageoverride->id < 1);
$actionText = $isNew ? JText::_( "JOVERRIDER_NEW" ) : JText::_( "JOVERRIDER_EDIT" );
?>

		<fieldset class="fieldsform">
	<legend><?php echo $actionText .' - '. JText::_( "JOVERRIDER_SEARCH_CONSTANT" );?></legend>
			<span class="readonly">A language string is composed of two parts: a specific language constant and its value.<br />For example, in the string:<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COM_CONTENT_READ_MORE="Read more: "<br />'<u>COM_CONTENT_READ_MORE</u>' is the constant and '<u>Read more: </u>' is the value.<br />You have to use the specific language constant in order to create an override of the value.<br />Therefore, you can search for the constant or the value you want to change with the search field below.<br />By clicking on the desired result the correct constant will automatically be inserted into the form.</span>
			<div class="clr"></div>
				<span id="refresh-status" class="overrider-spinner">
					Please wait while the cache is recreated. If you have many languages installed it may even take some minutes, be patient, please.
				</span>
				<span id="refresh-result"></span>				
				<br />
					<input type="text" id="searchstring" value="" class="inputbox" size="50"/>					
					<button type="submit" onclick="searchStrings();return false;">Search</button>
					<button type="submit" onclick="refreshStrings();return false;">create / refresh the strings list</button>
				<br />
					<label class="hasTip" title="Search for::Here you can select whether you want to search for constant names or the values (thus the actual texts).">Search for:</label>
					&nbsp;&nbsp;
					<label for="searchtype0">Constant</label>
					<input type="radio" id="searchtype0" name="searchtype" value="constant"/></td>							
					&nbsp;&nbsp;&nbsp;&nbsp;
					<label for="searchtype1">Value</label>
					<input type="radio" id="searchtype1" name="searchtype" value="value" checked="checked"/></td>
		</fieldset>
		<fieldset id="results-container" class="adminform">
			<legend>Search Results</legend>
			<div id="results"></div>
			<span id="more-results">
				<a class="joverrider_button blue" href="javascript:searchStrings(startinglimit);">
					More Results</a>
			</span>
		</fieldset>

</fieldset>
