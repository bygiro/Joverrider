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
	<table class="admintable joverrider">

		<tr>
			<td align="right" class="key">
				<label for="filename_override">
					<?php echo JText::_( "JOVERRIDER_FIELD_FILENAME_OVERRIDE" ); ?> :
				</label>
			</td>
			<td>
				<?php echo JDom::_('html.fly', array(
												'dataKey' => 'filename_override',
												'dataObject' => $this->templateoverride
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
<textarea rows="17" class="fly_code" disabled="disabled"><?php echo $this->templateoverride->file_content;?></textarea>
			</td>
		</tr>


	</table>
</fieldset>