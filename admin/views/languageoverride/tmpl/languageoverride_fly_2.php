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
				<label for="lang_group">
					<?php echo JText::_( "JOVERRIDER_FIELD_GROUP" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly.enum', array(
												'dataKey' => 'lang_group',
												'dataObject' => $this->languageoverride,
												'list' => $this->lists['enum']['languageoverrides.lang_group'],
												'listKey' => 'value',
												'labelKey' => 'text'
												));
				?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="constant">
					<?php echo JText::_( "JOVERRIDER_FIELD_CONSTANT" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly', array(
												'dataKey' => 'constant',
												'dataObject' => $this->languageoverride
												));
				?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="text">
					<?php echo JText::_( "JOVERRIDER_FIELD_TEXT" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly', array(
												'dataKey' => 'text',
												'dataObject' => $this->languageoverride
												));
				?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="lang_code">
					<?php echo JText::_( "JOVERRIDER_FIELD_LANGUAGE" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly.enum', array(
												'dataKey' => 'lang_code',
												'dataObject' => $this->languageoverride,
												'list' => $this->lists['enum']['languageoverrides.lang_code'],
												'listKey' => 'value',
												'labelKey' => 'text'
												));
				?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="lang_client">
					<?php echo JText::_( "JOVERRIDER_FIELD_LOCATION" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly.enum', array(
												'dataKey' => 'lang_client',
												'dataObject' => $this->languageoverride,
												'list' => $this->lists['enum']['languageoverrides.lang_client'],
												'listKey' => 'value',
												'labelKey' => 'text'
												));
				?>
			</td>
		</tr>


	</table>
</fieldset>