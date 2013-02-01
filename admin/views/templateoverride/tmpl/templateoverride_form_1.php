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



$isNew		= ($this->templateoverride->id < 1);
$actionText = $isNew ? JText::_( "JOVERRIDER_NEW" ) : JText::_( "JOVERRIDER_EDIT" );
?>

<fieldset class="fieldsform">
	<legend><?php echo $actionText .' - '. JText::_( "JOVERRIDER_FIELD_DETAILS" );?></legend>

	<table class="admintable">

		<tr>
			<td align="right" class="key">
				<label for="ov_hack_id">
					<?php echo JText::_( "JOVERRIDER_FIELD_HACK_NAME" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.form.input.ajax', array(
												'dataKey' => 'ov_hack_id',
												'dataObject' => $this->templateoverride,
												'ajaxContext' => 'joverrider.hacks.ajax.select3',
												'ajaxVars' => array('values' => array(
													$this->templateoverride->ov_hack_id
														))
												));
				?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="ov_desc">
					<?php echo JText::_( "JOVERRIDER_FIELD_DESCRIPTION" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.form.input.textarea', array(
												'dataKey' => 'ov_desc',
												'dataObject' => $this->templateoverride,
												'cols' => "80",
												'rows' => "3"
												));
				?>
			</td>
		</tr>


	</table>
</fieldset>
