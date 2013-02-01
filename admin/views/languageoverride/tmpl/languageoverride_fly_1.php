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


?>

<fieldset class="fieldsfly">
	<table class="admintable">

		<tr>
			<td align="right" class="key">
				<label for="lang_hack_id">
					<?php echo JText::_( "JOVERRIDER_FIELD_HACK_ID" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly', array(
												'dataKey' => 'lang_hack_id',
												'dataObject' => $this->languageoverride
												));
				?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="_lang_hack_id_name">
					<?php echo JText::_( "JOVERRIDER_FIELD_HACK_NAME_1" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly', array(
												'dataKey' => '_lang_hack_id_name',
												'dataObject' => $this->languageoverride,
												'route' => array('view' => 'hack','layout' => 'hack','cid[]' => $this->item->lang_hack_id)
												));
				?>
			</td>
		</tr>


	</table>
</fieldset>