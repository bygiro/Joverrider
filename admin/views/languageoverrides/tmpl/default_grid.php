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

<div id="sync_form" class="reveal-modal">
	<?php echo $this->loadTemplate('form'); ?>
	<a class="close-reveal-modal"><span style="font-size: 25px; color: #000000;">&#215;</span></a>
</div>
<div class="grid_wrapper">
	<table id='grid' class='adminlist' cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'NUM' ); ?>
			</th>

			<?php if ($this->access->get('core.edit.own') || $this->access->get('core.edit')): ?>
            <th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
			<?php endif; ?>

			<th style="text-align:center">
				<?php echo JHTML::_('grid.sort',  "ID", 'a.id', $this->state->get('list.direction'), $this->state->get('list.ordering') ); ?>
			</th>

			<?php if ($this->access->get('core.edit.own') || $this->access->get('core.edit')): ?>
			<th style="text-align:center">
				<?php echo JText::_("JTOOLBAR_EDIT"); ?>
			</th>
			<?php endif; ?>

			<th style="text-align:center">
				<?php echo JHTML::_('grid.sort',  "JOVERRIDER_FIELD_GROUP", 'a.lang_group', $this->state->get('list.direction'), $this->state->get('list.ordering') ); ?>
			</th>

			<th style="text-align:center">
				<?php echo JHTML::_('grid.sort',  "JOVERRIDER_FIELD_CONSTANT", 'a.constant', $this->state->get('list.direction'), $this->state->get('list.ordering') ); ?>
			</th>

			<th style="text-align:left">
				<?php echo JText::_("JOVERRIDER_FIELD_TEXT"); ?>
			</th>

			<th style="text-align:center">
				<?php echo JHTML::_('grid.sort',  "JOVERRIDER_FIELD_LOCATION", 'a.lang_client', $this->state->get('list.direction'), $this->state->get('list.ordering') ); ?>
			</th>

			<th style="text-align:center">
				<?php echo JHTML::_('grid.sort',  "JOVERRIDER_FIELD_LANGUAGE", 'a.lang_code', $this->state->get('list.direction'), $this->state->get('list.ordering') ); ?>
			</th>

			<th style="text-align:center">
				<?php echo JHTML::_('grid.sort',  "JOVERRIDER_FIELD_PUBLISH", 'a.publish', $this->state->get('list.direction'), $this->state->get('list.ordering') ); ?>
			</th>

			<?php if ($this->access->get('core.delete.own') || $this->access->get('core.delete')): ?>
			<th>
				<?php echo JText::_("JTOOLBAR_DELETE"); ?>
			</th>
			<?php endif; ?>



		</tr>
	</thead>

	<tbody>
	<?php
	$k = 0;

	for ($i=0, $n=count( $this->items ); $i < $n; $i++):

		$row = &$this->items[$i];

$tooltip = '<table class="tooltip_process">
			<tr>
				<td class="key">'. JText::_("JOVERRIDER_FIELD_HACK_ID") .':</td>
				<td class="value">'. $row->lang_hack_id .'</td>
			</tr>
			<tr>
				<td class="key">'. JText::_("JOVERRIDER_FIELD_HACK_NAME") .':</td>
				<td class="value">'. $row->_lang_hack_id_name .'</td>
			</tr>
			<tr>
				<td class="key">'. JText::_("JOVERRIDER_FIELD_HACK_DESCRIPTION") .':</td>
				<td class="value">'. $row->_lang_hack_id_description .'</td>
			</tr>
		</table>' ;

		?>

		<tr class="<?php echo "row$k"; ?> hasTip" title='<?php echo str_replace('\'', '\\',str_replace('\\', '\\\\',$tooltip)); ?>'>

			<td class='row_id'>
				<?php echo $this->pagination->getRowOffset( $i ); ?>
            </td>

			<?php if ($this->access->get('core.edit.own') || $this->access->get('core.edit')): ?>
			<td>
				<?php echo JDom::_('html.grid.checkedout', array(
											'dataObject' => $row,
											'num' => $i
												));
				?>

			</td>
			<?php endif; ?>

            <td style="text-align:center">
				<?php echo $row->id; ?>
			</td>

			<?php if ($this->access->get('core.edit.own') || $this->access->get('core.edit')): ?>
            <td style="text-align:center">
				<?php if ($row->params->get('access-edit')): ?>
					<?php echo JDom::_('html.grid.task', array(
											'num' => $i,
											'task' => "edit",
											'label' => "JTOOLBAR_EDIT",
											'view'	=> "icon"
												));
					?>
				<?php endif; ?>
			</td>
			<?php endif; ?>

            <td style="text-align:center">
				<?php echo JDom::_('html.fly.enum', array(
												'dataKey' => 'lang_group',
												'dataObject' => $row,
												'list' => $this->lists['enum']['languageoverrides.lang_group'],
												'listKey' => 'value',
												'labelKey' => 'text'
												));
				?>
			</td>

            <td style="text-align:center">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => 'constant',
												'dataObject' => $row
												));
				?>
			</td>

            <td style="text-align:left">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => 'text',
												'dataObject' => $row
												));
				?>
			</td>

            <td style="text-align:center">
				<?php echo JDom::_('html.fly.enum', array(
												'dataKey' => 'lang_client',
												'dataObject' => $row,
												'list' => $this->lists['enum']['languageoverrides.lang_client'],
												'listKey' => 'value',
												'labelKey' => 'text'
												));
				?>
			</td>

            <td style="text-align:center">
				<?php echo JDom::_('html.fly.enum', array(
												'dataKey' => 'lang_code',
												'dataObject' => $row,
												'list' => $this->lists['enum']['languageoverrides.lang_code'],
												'listKey' => 'value',
												'labelKey' => 'text'
												));
				?>
			</td>
			
			<?php if ($this->access->get('core.edit.state') || $this->access->get('core.view.own')): ?>
            <td style="text-align:center">
				<?php echo JDom::_('html.grid.publish', array(
										'dataKey' => 'publish',
										'dataObject' => $row,
										'num' => $i
											));
				?>
			</td>
			<?php endif; ?>

			<?php if ($this->access->get('core.delete.own') || $this->access->get('core.delete')): ?>
            <td>
				<?php if ($row->params->get('access-delete')): ?>
					<?php echo JDom::_('html.grid.task', array(
											'num' => $i,
											'task' => "delete",
											'label' => "JTOOLBAR_DELETE",
											'view'	=> "icon"
												));
					?>
				<?php endif; ?>
			</td>
			<?php endif; ?>



		</tr>
		<?php
		$k = 1 - $k;

	endfor;
	?>
	</tbody>
	</table>




</div>

<?php echo JDom::_('html.pagination', null, $this->pagination);?>


