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


?>

<fieldset class="fieldsfly">
	<table class="admintable">

		<tr>
			<td align="right" class="key">
				<label for="ov_client">
					<?php echo JText::_( "JOVERRIDER_FIELD_LOCATION" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly.enum', array(
												'dataKey' => 'ov_client',
												'dataObject' => $this->templateoverride,
												'list' => $this->lists['enum']['templateoverrides.ov_client'],
												'listKey' => 'value',
												'labelKey' => 'text'
												));
				?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="template">
					<?php echo JText::_( "JOVERRIDER_FIELD_DESTINATION_TEMPLATE" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly.enum', array(
												'dataKey' => 'template',
												'dataObject' => $this->templateoverride,
												'list' => $this->lists['enum']['templateoverrides.template'],
												'listKey' => 'value',
												'labelKey' => 'text'
												));
				?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="ov_type">
					<?php echo JText::_( "JOVERRIDER_FIELD_OVERRIDE_TYPE" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly.enum', array(
												'dataKey' => 'ov_type',
												'dataObject' => $this->templateoverride,
												'list' => $this->lists['enum']['templateoverrides.ov_type'],
												'listKey' => 'value',
												'labelKey' => 'text'
												));
				?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="ov_element">
					<?php echo JText::_( "JOVERRIDER_FIELD_ELEMENT" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly.enum', array(
												'dataKey' => 'ov_element',
												'dataObject' => $this->templateoverride,
												'list' => $this->lists['enum']['templateoverrides.ov_element'],
												'listKey' => 'value',
												'labelKey' => 'text'
												));
				?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="view_name">
					<?php echo JText::_( "JOVERRIDER_FIELD_VIEW_NAME" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly.enum', array(
												'dataKey' => 'view_name',
												'dataObject' => $this->templateoverride,
												'list' => $this->lists['enum']['templateoverrides.view_name'],
												'listKey' => 'value',
												'labelKey' => 'text'
												));
				?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="layout_type">
					<?php echo JText::_( "JOVERRIDER_FIELD_LAYOUT_TYPE" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly.enum', array(
												'dataKey' => 'layout_type',
												'dataObject' => $this->templateoverride,
												'list' => $this->lists['enum']['templateoverrides.layout_type'],
												'listKey' => 'value',
												'labelKey' => 'text'
												));
				?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="filename">
					<?php echo JText::_( "JOVERRIDER_FIELD_FILENAME" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly.enum', array(
												'dataKey' => 'filename',
												'dataObject' => $this->templateoverride,
												'list' => $this->lists['enum']['templateoverrides.filename'],
												'listKey' => 'value',
												'labelKey' => 'text'
												));
				?>
			</td>
		</tr>


	</table>
</fieldset>