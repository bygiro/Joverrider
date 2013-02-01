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
	<legend><?php echo $actionText .' - '. JText::_( "JOVERRIDER_FIELD_DETAILS" );?></legend>

	<table class="admintable">

		<tr>
			<td align="right" class="key">
				<label for="lang_hack_id">
					<?php echo JText::_( "JOVERRIDER_FIELD_HACK_NAME" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.form.input.ajax', array(
												'dataKey' => 'lang_hack_id',
												'dataObject' => $this->languageoverride,
												'ajaxContext' => 'joverrider.hacks.ajax.select4',
												'ajaxVars' => array('values' => array(
													$this->languageoverride->lang_hack_id
														))
												));
				?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="lang_group">
					<?php echo JText::_( "JOVERRIDER_FIELD_GROUP" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.form.input.text', array(
												'dataKey' => 'lang_group',
												'dataObject' => $this->languageoverride,
												'size' => "32",
												'domClass' => ""
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
				<?php echo JDom::_('html.form.input.text', array(
												'dataKey' => 'constant',
												'dataObject' => $this->languageoverride,
												'size' => "32",
												'domClass' => "validate[required]",
												'required' => true
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
				<?php echo JDom::_('html.form.input.textarea', array(
												'dataKey' => 'text',
												'dataObject' => $this->languageoverride,
												'cols' => "80",
												'rows' => "5",
												'domClass' => "textcontent"
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
				<?php echo JDom::_('html.form.input.select', array(
												'dataKey' => 'lang_code',
												'dataObject' => $this->languageoverride,
												'list' => $this->lists['select']['lang_code']->list,
												'listKey' => 'value',
												'labelKey' => 'text',
												'nullLabel' => "",
												'domClass' => "validate[required]",
												'required' => true
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
				<?php echo JDom::_('html.form.input.select', array(
												'dataKey' => 'lang_client',
												'dataObject' => $this->languageoverride,
												'list' => $this->lists['select']['lang_client']->list,
												'listKey' => 'value',
												'labelKey' => 'text',
												'nullLabel' => "",
												'domClass' => "validate[required]",
												'required' => true
												));
				?>
			</td>
		</tr>


	</table>
</fieldset>
