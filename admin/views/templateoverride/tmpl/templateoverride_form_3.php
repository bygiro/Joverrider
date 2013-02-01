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

<fieldset id="override_file" class="fieldsform">
	<legend><?php echo $actionText .' - '. JText::_( "JOVERRIDER_OVERRIDE_FILE" );?></legend>
		<p class="itemselected"><?php echo $this->templateoverride->overridefile ;?></p>
	<table class="admintable joverrider">
		<tr>
			<td colspan="2" align="center">
				<a class="joverrider_button green" href="#" onclick="loadfile2(); return false;"><?php echo JText::_( "JOVERRIDER_LOAD_FILE" ); ?></a>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="filename_override">
					<?php echo JText::_( "JOVERRIDER_FIELD_FILENAME_OVERRIDE" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.form.input.text', array(
												'dataKey' => 'filename_override',
												'dataObject' => $this->templateoverride,
												'size' => "32",
												'domClass' => "validate[required]",
												'required' => true
												));
				?>
			</td>
		</tr>
		<tr>
			<td align="right" class="key">
				<label for="file_content">
					<?php echo JText::_( "JOVERRIDER_FIELD_FILE_CONTENT" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.form.input.textarea', array(
												'dataKey' => 'file_content',
												'dataObject' => $this->templateoverride,
												'cols' => "80",
												'rows' => "19",
												'domClass' => "validate[required] textcontent",
												'required' => true
												));
				?>
			</td>
		</tr>


	</table>
</fieldset>
