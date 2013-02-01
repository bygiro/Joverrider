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

defined('_JEXEC') or die('Restricted access'); ?>

<?php JoverriderHelper::headerDeclarations(); ?>


<?php JHTML::_('behavior.tooltip');?>
<?php JHTML::_('behavior.calendar');?>


<?php
	JToolBarHelper::title(JText::_("JOVERRIDER_LAYOUT_LANGUAGE_OVERRIDES"), 'joverrider_languageoverrides' );
	$this->token = JUtility::getToken();
?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton)
	{
		switch(pressbutton)
		{
			case 'delete':

				var deleteConfirmMessage;
				if (document.adminForm.boxchecked.value > 1)
					deleteConfirmMessage = "<?php echo(addslashes(JText::_("JDOM_ALERT_ASK_BEFORE_REMOVE_MULTIPLE"))); ?>";
				else
					deleteConfirmMessage = "<?php echo(addslashes(JText::_("JDOM_ALERT_ASK_BEFORE_REMOVE"))); ?>";

				if (window.confirm(deleteConfirmMessage))
					return Joomla.submitform(pressbutton);
				else
					return;
				break;

		}

		return Joomla.submitform(pressbutton);
	}


$j(document).ready( function() {
	var sync_task = $j('#toolbar-synchronize a.toolbar').attr('onclick');
	$j('#sync_button').attr('onclick',sync_task);
	$j('#toolbar-synchronize a.toolbar').attr('onclick','');
	$j('#toolbar-synchronize a.toolbar').attr('data-reveal-id','sync_form');
});
	
</script>

<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm" class="" autocomplete="off">





	<div>
		<?php echo $this->loadTemplate('filters'); ?>
		<?php echo $this->loadTemplate('grid'); ?>
	</div>











	<?php echo JDom::_('html.form.footer', array(
		'values' => array(
				'option' => "com_joverrider",
				'view' => "languageoverrides",
				'layout' => "default",
				'boxchecked' => "0",
				'filter_order' => $this->lists['order'],
				'filter_order_Dir' => $this->lists['order_Dir']
			)));
	?>

</form>