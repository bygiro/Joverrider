<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V1.5.2   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		0.4.0
* @package		Joverrider
* @subpackage	Hacks
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
	JToolBarHelper::title(JText::_("JOVERRIDER_LAYOUT_CONTROL_PANEL"), 'joverrider_hacks' );
	$this->token = JUtility::getToken();
?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton)
	{

		return Joomla.submitform(pressbutton);
	}
	function syncType(){
		what = $j("#sync_what").val();
		
		switch(what){
			case 'tmpl_ov':
				$j('#tmpl_form').fadeIn();
				$j('#lang_form').fadeOut();
				
			break;
			
			case 'lang_ov':
				$j('#tmpl_form').fadeOut();
				$j('#lang_form').fadeIn();			
			break;
			
			default:
				$j('#tmpl_form').fadeOut();
				$j('#lang_form').fadeOut();			
			break;
				
		}
	}
	
$j(document).ready( function() {
	$j("#sync_what").change(syncType);
	$j('div#toolbar-box div.m div.icon-48-joverrider_hacks').removeClass('icon-48-joverrider_hacks').addClass('icon-48-joverrider_controlpanel');
});	
</script>

<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm" class="" enctype="multipart/form-data">
<div id="file_import" class="reveal-modal">
<p style="text-align: center; margin-top: 15px;">
	<input size="40" type="file" name="file"><br /><br />
	<a id="import_button" href="#" class="joverrider_button green" onclick="Joomla.submitbutton('import')"><?php echo JText::_("JTOOLBAR_IMPORT"); ?></a>
</p>
	<a class="close-reveal-modal"><span style="font-size: 25px; color: #000000;">&#215;</span></a>
</div>
<div id="sync_form" class="reveal-modal">
	<?php echo $this->loadTemplate('form'); ?>
	<a class="close-reveal-modal"><span style="font-size: 25px; color: #000000;">&#215;</span></a>
</div>
<table style="width: 100%;">
<tr>
 <td width = "50%">
    <div id = "cpanel">
<?php echo JDom::_("html.link.menu.cpanel.button", array(
										'href' => 'index.php?option=com_joverrider&view=hacks&layout=hacks',
										'link_title' => JText::_("JOVERRIDER_VIEW_HACKS"),
										'img' => 'icon-48-joverrider_hacks.png'
										)); ?>
<?php echo JDom::_("html.link.menu.cpanel.button", array(
										'href' => 'index.php?option=com_joverrider&view=templateoverrides',
										'link_title' => JText::_("JOVERRIDER_VIEW_TEMPLATE_OVERRIDES"),
										'img' => 'icon-48-joverrider_templateoverrides.png'
										)); ?>
<?php echo JDom::_("html.link.menu.cpanel.button", array(
										'href' => 'index.php?option=com_joverrider&view=languageoverrides',
										'link_title' => JText::_("JOVERRIDER_VIEW_LANGUAGE_OVERRIDES"),
										'img' => 'icon-48-joverrider_languageoverrides.png'
										)); ?>
<?php echo JDom::_("html.link.menu.cpanel.button", array(
										'href' => 'index.php?option=com_joverrider&view=logs',
										'link_title' => JText::_("JOVERRIDER_VIEW_LOGS"),
										'img' => 'icon-48-joverrider_logs.png'
										)); ?>
<?php echo JDom::_("html.link.menu.cpanel.button", array(
										'href' => '#',
										'link_title' => JText::_("JOVERRIDER_IMPORT_HACKS"),
										'img' => 'icon-48-joverrider_import.png',
										'extra' => 'data-reveal-id="file_import"'
										)); ?>
<?php echo JDom::_("html.link.menu.cpanel.button", array(
										'href' => '#',
										'link_title' => JText::_("JOVERRIDER_SYNCHRONIZE"),
										'img' => 'icon-48-joverrider_synchronize.png',
										'extra' => 'data-reveal-id="sync_form"'
										)); ?>		
    </div>
 </td>
 <td><img src="components/com_joverrider/images/joverrider.png" align="left" border="0"></td>
 <td style = "vertical-align:top;  font-size: 14px;">
	<div><?php echo JText::_("JOVERRIDER_ABOUT");?></div>
	<table width="100%">
		<tr>
			<td>
				<div>
					<a href="http://www.bygiro.com/" target="_blank">
						<img src="components/com_joverrider/images/bygiro.png" border="0">
					</a>
				</div>
				<div><a href="http://www.bygiro.com/" target="_blank">www.bygiro.com</a></div>
				<div><a href="mailto:girotomaselli@gmail.com">girotomaselli@gmail.com</a></div>
			</td>
			<td align="center">
<p>
<a class="joverrider_button green" onclick="document.donate.submit(); return false;" alt="PayPal - The safer, easier way to pay online!" href="#">
Make a Donation
</a></p>
<p>Help us to improve Joverrider and develop many more great joomla extensions!<br /> thank you.</p>
<a onclick="document.donate.submit(); return false;" alt="PayPal - The safer, easier way to pay online!" href="#">
<img src="components/com_joverrider/images/paypal.png" border="0">
</a>

			
			</td>
		</tr>
	</table>
 </td>
</tr>
</table>

	<?php echo JDom::_('html.form.footer', array(
		'values' => array(
				'option' => "com_joverrider",
				'view' => "hacks",
				'layout' => "default",
				'boxchecked' => "0",
				'filter_order' => $this->lists['order'],
				'filter_order_Dir' => $this->lists['order_Dir']
			)));
	?>

</form>

<form name="donate" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_donations">
<input type="hidden" name="business" value="girotomaselli@hotmail.it">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="Joverrider joomla component">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="currency_code" value="EUR">
<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest">

<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
