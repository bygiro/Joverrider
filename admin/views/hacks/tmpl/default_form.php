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

defined('_JEXEC') or die('Restricted access');
$arr = JoverriderHelper::enumListLangCode(1);
$languages = JoverriderHelper::makeOptions($arr, '', '- All languages -');
?>

<fieldset class="fieldsform">
<table class="admintable joverrider">
		<tr>
			<td align="right" class="key">
				<label for="sync_what">
					<?php echo JText::_( "JOVERRIDER_FIELD_SYNC_WHAT" ); ?> :
				</label>
			</td>
			<td>
			<select class="inputbox" style="float:left;" name="sync_what" id="sync_what">
				<option selected="selected" value="">- Select -</option>
				<option value="tmpl_ov"><?php echo JText::_( "JOVERRIDER_LAYOUT_TEMPLATE_OVERRIDES" ); ?></option>
				<option value="lang_ov"><?php echo JText::_( "JOVERRIDER_VIEW_LANGUAGE_OVERRIDES" ); ?></option>
			</select>
			</td>
			<td>
				<?php echo JText::_( "JOVERRIDER_FIELD_SYNC_WHAT_INFO" ); ?>
			</td>
		</tr>
		<tbody id="lang_form" style="display: none">
		<tr>
			<td align="right" class="key">
				<label for="default">
					<?php echo JText::_( "JOVERRIDER_ENUM_LANGUAGEOVERRIDES_LANG_CLIENT_CLIENT" ); ?> :
				</label>
			</td>
			<td>
			<select class="inputbox" style="float:left;" name="client" id="client">
				<option selected="selected" value="0"><?php echo JText::_( "JOVERRIDER_ENUM_LANGUAGEOVERRIDES_LANG_CLIENT_SITE" ); ?></option>
				<option value="1"><?php echo JText::_( "JOVERRIDER_ENUM_LANGUAGEOVERRIDES_LANG_CLIENT_ADMINISTRATOR" ); ?></option>
				<option value="2"><?php echo JText::_( "JOVERRIDER_ENUM_LANGUAGEOVERRIDES_LANG_CLIENT_BOTH" ); ?></option>
			</select>
			</td>
			<td>
				<?php echo JText::_( "JOVERRIDER_FIELD_CLIENT_INFO" ); ?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="language">
					<?php echo JText::_( "JOVERRIDER_FIELD_LANGUAGE" ); ?> :
				</label>
			</td>
			<td>
			<select name="language">
			<?php echo $languages;?>
			</select>
			</td>
			<td>
				<?php echo JText::_( "JOVERRIDER_FIELD_LANGUAGE_INFO" ); ?>			
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="syncWay">
					<?php echo JText::_( "JOVERRIDER_FIELD_SYNCWAY" ); ?> :
				</label>
			</td>
			<td>
			<select class="inputbox" style="float:left;" name="syncWay" id="syncWay">
				<option selected="selected" value="0"><?php echo JText::_( "JOVERRIDER_FIELD_SYNCWAY_JOVERRIDER" ); ?></option>
				<option value="1"><?php echo JText::_( "JOVERRIDER_FIELD_SYNCWAY_OVERRIDE_FILES" ); ?></option>
			</select>			
			</td>
			<td>
				<?php echo JText::_( "JOVERRIDER_FIELD_SYNCWAY_INFO" ); ?>
			</td>
		</tr>
		</tbody>
		<tbody id="tmpl_form" style="display: none">
			<td align="right" class="key">
				<label for="default">
					<?php echo JText::_( "JOVERRIDER_ENUM_LANGUAGEOVERRIDES_LANG_CLIENT_CLIENT" ); ?> :
				</label>
			</td>
			<td>
			<select class="inputbox" style="float:left;" name="client" id="client">
				<option selected="selected" value="0"><?php echo JText::_( "JOVERRIDER_ENUM_LANGUAGEOVERRIDES_LANG_CLIENT_SITE" ); ?></option>
				<option value="1"><?php echo JText::_( "JOVERRIDER_ENUM_LANGUAGEOVERRIDES_LANG_CLIENT_ADMINISTRATOR" ); ?></option>
				<option value="2"><?php echo JText::_( "JOVERRIDER_ENUM_LANGUAGEOVERRIDES_LANG_CLIENT_BOTH" ); ?></option>
			</select>
			</td>
			<td>
				<?php echo JText::_( "JOVERRIDER_FIELD_CLIENT_INFO" ); ?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="onlyDefault">
					<?php echo JText::_( "JOVERRIDER_FIELD_ONLYDEFAULT" ); ?> :
				</label>
			</td>
			<td>
			<fieldset id="onlyDefault" class="radio radio_wrapper inputbox " style="float:left;">
				<input id="onlyDefault_0" type="radio" value="0" name="onlyDefault"><label for="onlyDefault_0"><?php echo JText::_( "JNO" ); ?></label>
				<input id="onlyDefault_1" checked="checked" type="radio" value="1" name="onlyDefault"><label for="onlyDefault_1"><?php echo JText::_( "JYES" ); ?></label>
			</fieldset>			
			</td>
			<td>
				<?php echo JText::_( "JOVERRIDER_FIELD_ONLYDEFAULT_INFO" ); ?>			
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="syncWay">
					<?php echo JText::_( "JOVERRIDER_FIELD_SYNCWAY" ); ?> :
				</label>
			</td>
			<td>
			<select class="inputbox" style="float:left;" name="syncWay" id="syncWay">
				<option selected="selected" value="0"><?php echo JText::_( "JOVERRIDER_FIELD_SYNCWAY_JOVERRIDER" ); ?></option>
				<option value="1"><?php echo JText::_( "JOVERRIDER_FIELD_SYNCWAY_TEMPLATES_FOLDER" ); ?></option>
			</select>			
			</td>
			<td>
				<?php echo JText::_( "JOVERRIDER_FIELD_SYNCWAY_INFO" ); ?>
			</td>
		</tr>
		</tbody>
</table>
<p style="text-align: center; margin: 20px 0;">
	<a id="sync_button" href="#" class="joverrider_button green" onclick="Joomla.submitbutton('synchronize')"><?php echo JText::_("JTOOLBAR_SYNCHRONIZE"); ?></a>
</p>
</fieldset>
