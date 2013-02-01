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


JHtml::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
		
$siteUrl = JURI::root(true);
$siteUrl = str_replace("\\", "/", $siteUrl);   //Win servers

?>

<?php JoverriderHelper::headerDeclarations(); ?>





<?php	JToolBarHelper::title(JText::_("JOVERRIDER_LAYOUT_TEMPLATE_OVERRIDE"), 'joverrider_templateoverrides' );?>

<script language="javascript" type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#adminForm").validationEngine();
	
	// reloadList();
	
	
	$j('.overrideList').each(
		function(){
			$j(this).change(
				function(){
					reloadList();
				}
			);
		}
	);
	
});

function reloadList(){
	if($j("#ov_client").val() != ''){
		loadviews("template");
	}

	if($j("#ov_type").val() != ''){
		loadviews("ov_element");
	}
	
	if($j("#ov_element").val() != ''){
		switch($j("#ov_type").val()){
			case 'component':
			case 'menu':
				loadviews("view_name");
			break;
			
			case 'module':
				loadviews("view_name");
				loadviews("filename");
			break;
			
			case 'system':
			
			break;
		}
	}
	
	if($j("#view_name").val() != ''){
		loadviews("filename");
	}
	
}

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

<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm" class='form-validate' enctype='multipart/form-data' autocomplete="off">


	<?php if($this->templateoverride->publish == 0){?>
		<div class="width-40 fltlft">
			<?php echo $this->loadTemplate('form_1'); ?>
			<?php echo $this->loadTemplate('form_2'); ?>
		</div>
		<div class="width-60 fltrt">
			<?php echo $this->loadTemplate('form_3'); ?>
		</div>
	<?php } else { ?>
	<?php echo '<p class="info">'. JText::_( "JOVERRIDER_UNPUBLISH_BEFORE_EDIT" ).'</p>';?>
		<div class="width-40 fltlft">
			<?php echo $this->loadTemplate('fly_1'); ?>
			<?php echo $this->loadTemplate('fly_2'); ?>
		</div>
		<div class="width-60 fltrt">
			<?php echo $this->loadTemplate('fly_3'); ?>
		</div>
	<?php } ?>









	<?php echo JDom::_('html.form.footer', array(
		'dataObject' => $this->templateoverride,
		'values' => array(
				'option' => "com_joverrider",
				'view' => "templateoverride",
				'layout' => "templateoverride"
				)));
	?>

</form>