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

defined('_JEXEC') or die('Restricted access'); ?>

<script language="javascript" type="text/javascript">
<!--


function resetFilters()
{
	if (typeof(jQuery) != 'undefined')
	{
		jQuery('.filters :input').val('');

	/* TODO : Uncomment this if you want that the reset action proccess also on sorting values
		jQuery('#filter_order').val('');
		jQuery('#filter_orderDir').val('');
	*/
		document.adminForm.submit();
		return;
	}

//Deprecated
	if ($('filter_ov_hack_id') != null)
	    $('filter_ov_hack_id').value='';
	if ($('filter_ov_client') != null)
	    $('filter_ov_client').value='';
	if ($('filter_template') != null)
	    $('filter_template').value='';
	if ($('filter_ov_type') != null)
	    $('filter_ov_type').value='';
	if ($('filter_ov_element') != null)
	    $('filter_ov_element').value='';
	if ($('filter_view_name') != null)
	    $('filter_view_name').value='';
	if ($('filter_layout_type') != null)
	    $('filter_layout_type').value='';
	if ($('filter_publish') != null)
	    $('filter_publish').value='';
	if ($('filter_search') != null)
	    $('filter_search').value='';


/* TODO : Uncomment this if you want that the reset action proccess also on sorting values
	if ($('filter_order') != null)
	    $('filter_order').value='';
	if ($('filter_orderDir') != null)
	    $('filter_orderDir').value='';
*/

	document.adminForm.submit();
}

-->
</script>


<fieldset id="filters" class="filters">
	<legend><?php echo JText::_( "JSEARCH_FILTER_LABEL" ); ?></legend>



	<div style="float:right;">
		<div style="float:left">
			<!-- SEARCH : filter_search : search on Description + Filename + Filename override  -->

				<div class='search filter filter_search'>

					<?php echo JDom::_('html.form.input.search', array(
											'domID' => 'filter_search',
											'dataKey' => 'filter_search',
											'dataValue' => $this->filters['search']->value
												));


						?>
				</div>


		</div>
		<div style="float:left">
				<div class="filter filter_buttons">
					<button onclick="this.form.submit();"><?php echo(JText::_("JSEARCH_FILTER_SUBMIT")); ?></button>
					<button onclick="resetFilters()"><?php echo(JText::_("JSEARCH_FILTER_CLEAR")); ?></button>
				</div>
		</div>
	</div>

	<div>
		<div style="float:left">
			<!-- SELECT : Hack > Name  -->

				<div class='filter filter_ov_hack_id'>
		
					<?php echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_ov_hack_id',
											'dataValue' => $this->filters['ov_hack_id']->value,
											'list' => $this->filters['ov_hack_id']->list,
											'labelKey' => 'name',
											'nullLabel' => "JOVERRIDER_FILTER_NULL_HACK",
											'submitEventName' => 'onchange'
												));

						?>
				</div>



		</div>
		<div style="float:left">
			<!-- SELECT : Location  -->

					<div class='filter filter_ov_client'>
			
						<?php echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_ov_client',
											'dataValue' => $this->filters['ov_client']->value,
											'list' => $this->filters['ov_client']->list,
											'listKey' => 'value',
											'labelKey' => 'text',
											'submitEventName' => 'onchange'
												));

						?>

					</div>


		</div>
		<div style="float:left">
			<!-- SELECT : Destination Template  -->

					<div class='filter filter_template'>
			
						<?php echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_template',
											'dataValue' => $this->filters['template']->value,
											'list' => $this->filters['template']->list,
											'listKey' => 'value',
											'labelKey' => 'text',
											'submitEventName' => 'onchange'
												));

						?>

					</div>


		</div>
		<div style="float:left">
			<!-- SELECT : Override type  -->

					<div class='filter filter_ov_type'>
			
						<?php echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_ov_type',
											'dataValue' => $this->filters['ov_type']->value,
											'list' => $this->filters['ov_type']->list,
											'listKey' => 'value',
											'labelKey' => 'text',
											'submitEventName' => 'onchange'
												));

						?>

					</div>


		</div>
		<div style="float:left">
			<!-- SELECT : Element  -->

					<div class='filter filter_ov_element'>
			
						<?php echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_ov_element',
											'dataValue' => $this->filters['ov_element']->value,
											'list' => $this->filters['ov_element']->list,
											'listKey' => 'value',
											'labelKey' => 'text',
											'submitEventName' => 'onchange'
												));

						?>

					</div>


		</div>
		<div style="float:left">
			<!-- SELECT : View name  -->

					<div class='filter filter_view_name'>
			
						<?php echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_view_name',
											'dataValue' => $this->filters['view_name']->value,
											'list' => $this->filters['view_name']->list,
											'listKey' => 'value',
											'labelKey' => 'text',
											'submitEventName' => 'onchange'
												));

						?>

					</div>


		</div>
		<div style="float:left">
			<!-- SELECT : Layout type  -->

					<div class='filter filter_layout_type'>
			
						<?php echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_layout_type',
											'dataValue' => $this->filters['layout_type']->value,
											'list' => $this->filters['layout_type']->list,
											'listKey' => 'value',
											'labelKey' => 'text',
											'submitEventName' => 'onchange'
												));

						?>

					</div>


		</div>
		<div style="float:left">
			<!-- SELECT : Publish  -->

					<div class='filter filter_publish'>
			
						<?php
						$choices = array();
						$choices[] = array("value" => null, 'text'=>JText::_( "JOVERRIDER_FILTER_NULL_PUBLISH" ));
						$choices[] = array("value" => '0', 'text'=>JText::_( "JNO" ));
						$choices[] = array("value" => '1', 'text'=>JText::_( "JYES" ));

						echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_publish',
											'dataValue' => $this->filters['publish']->value,
											'list' => $choices,
											'listKey' => 'value',
											'labelKey' => 'text',
											'submitEventName' => 'onchange'
												));

						?>
					</div>


		</div>
	</div>




	<div clear='all'></div>





</fieldset>
