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

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
?>

<?php JoverriderHelper::headerDeclarations(); ?>





<?php	JToolBarHelper::title(JText::_("JOVERRIDER_LAYOUT_LANGUAGE_OVERRIDE"), 'joverrider_languageoverrides' );?>

<script language="javascript" type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#adminForm").validationEngine();

	/* hack 
    $j("#searchstring").focus(function () {
		if(!refreshed)
		{
			<?php if($this->state->get('cache_expired')){ ?>
			refreshStrings();
			refreshed = true;
			<?php } ?>
		}
		
		$j(this).removeClass('invalid');
    });
	
});

Joomla.submitform = function(pressbutton)
{
	//Unlock the page
	holdForm = false;

	var parts = pressbutton.split('.');

	jQuery("#task").val(pressbutton);
	switch(parts[parts.length-1])
	{
		case 'delete':
		case 'cancel':
			jQuery("#adminForm").validationEngine('detach');
			break;
	}

	jQuery("#adminForm").submit();
}

//Secure the user navigation on the page, in order preserve datas.
var holdForm = true;
window.onbeforeunload = function closeIt(){	if (holdForm) return false;};
</script>

<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm" class='form-validate' autocomplete="off">



	<?php if($this->languageoverride->publish == 0){?>
		<div class="width-40 fltlft">
			<?php echo $this->loadTemplate('form_1'); ?>
		</div>
		<div class="width-60 fltrt">
			<?php echo $this->loadTemplate('form_2'); ?>
		</div>
	<?php } else { ?>
	<?php echo '<p class="info">'. JText::_( "JOVERRIDER_UNPUBLISH_BEFORE_EDIT" ).'</p>';?>
		<div class="width-40 fltlft">
			<?php echo $this->loadTemplate('fly_1'); ?>
		</div>
		<div class="width-60 fltrt">
			<?php echo $this->loadTemplate('fly_2'); ?>
		</div>	
	<?php } ?>











	<?php echo JDom::_('html.form.footer', array(
		'dataObject' => $this->languageoverride,
		'values' => array(
				'option' => "com_joverrider",
				'view' => "languageoverride",
				'layout' => "languageoverride"
				)));
	?>

</form>