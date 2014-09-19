<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted index access' );
// top panel params
$tpopen_text			             = $this->params->get("tpopen_text","Open");
$tpclose_text			             = $this->params->get("tpclose_text","Close");
$tpbtn_width			             = $this->params->get("tpbtn_width","100");
$tpbtn_height			             = $this->params->get("tpbtn_height","30");
$tptran_speed			             = $this->params->get("tptran_speed","500");

//bottom panel params
$bpopen_text			             = $this->params->get("bpopen_text","Open");
$bpclose_text			             = $this->params->get("bpclose_text","Close");
$bpbtn_width			             = $this->params->get("bpbtn_width","100");
$bpbtn_height			             = $this->params->get("bpbtn_height","30");
$bptran_speed			             = $this->params->get("bptran_speed","500");

// side panel params
$spbox_width			             = $this->params->get("spbox_width","350");
$spbtn_poz				             = $this->params->get("spbtn_poz","45%");
$sptran_speed			             = $this->params->get("sptran_speed","500");
$sidepanel_module_style				 = $this->params->get("sidepanel_module_style","YJsgxhtml");
$rtlclass							 ='';

if($text_direction == 1){ 
 $rtlclass = ' yjsgrtl';
}
$document->addScript(YJSG_ASSETS.'src/yjsg.panels.js');

?>
<?php 
// top panel
if ($yjsgTopPanel_loaded) { 
	$document->addStyleDeclaration("#yjsg_toppanel_open{height:".$tpbtn_height."px;width:".$tpbtn_width."px;line-height:".$tpbtn_height."px;}");
?>
<div id="yjsg_toppanel" class="yjsg-panel<?php echo $rtlclass?>">
	<div id="yjsg_toppanel_slide" class="yjsg-panel-stretch">
		<div id="yjsg_toppanel_content" class="yjsg-panel-content yjsgsitew">
			<?php yjsg_print_grid_area('toppanel'); /* toppanel grid 1 tpan1 - tpan5 */ ?>
		</div>
	</div>
	<a id="yjsg_toppanel_open" href="javascript:;" class="yjsg-panel-open" data-direction="top" data-panel="#yjsg_toppanel" data-duration="<?php echo $tptran_speed ?>" data-otext="<?php echo $tpopen_text ?>" data-ctext="<?php echo $tpclose_text ?>">
		<?php echo $tpopen_text ?>
	</a>
</div>
<?php } ?>
<?php 
// bottom panel
if ($yjsgBotPanel_loaded) { 
	$document->addStyleDeclaration("#yjsg_botpanel_slide{margin-top:".$bpbtn_height."px;}#yjsg_botpanel_open{height:".$bpbtn_height."px;width:".$bpbtn_width."px;line-height:".$bpbtn_height."px;}");
?>
<div id="yjsg_botpanel" class="yjsg-panel<?php echo $rtlclass?>">
	<a id="yjsg_botpanel_open" href="javascript:;" class="yjsg-panel-open" data-direction="bottom" data-panel="#yjsg_botpanel" data-duration="<?php echo $bptran_speed ?>" data-otext="<?php echo $bpopen_text ?>" data-ctext="<?php echo $bpclose_text ?>">
		<?php echo $bpopen_text ?>
	</a>
	<div id="yjsg_botpanel_slide" class="yjsg-panel-stretch">
		<div id="yjsg_botpanel_content" class="yjsg-panel-content yjsgsitew">
			<?php yjsg_print_grid_area('botpanel'); /* botpanel bpan1 - bpan5 */ ?>
		</div>
	</div>
</div>
<?php } ?>
<?php
// side panel
if ($this->countModules('sidepanel')) {
	$sidepanelDir = 'right';
	$sidepaneW = $spbox_width -30;
	$dataDir = 'right';
	if( $text_direction == 1 ){
		$sidepanelDir = 'left';
		$dataDir = 'left';
	}
	$document->addStyleDeclaration("#yjsg_sidepanel{width:".$spbox_width."px;".$sidepanelDir.":-".$sidepaneW."px;}#yjsg_sidepanel_open{top:".$spbtn_poz.";}");
?>
<div id="yjsg_sidepanel" class="yjsg-panel<?php echo $rtlclass?>">
	<a id="yjsg_sidepanel_open" href="javascript:;" class="yjsg-panel-open" data-direction="<?php echo $dataDir?>" data-settings="#yjsg_sidepanel" data-panel="#yjsg_sidepanel" data-duration="<?php echo $sptran_speed ?>"></a>
	<div id="yjsg_sidepanel_slide" class="inside-container">
		<div id="yjsg_sidepanel_slideIn" class="yjsg-panel-content">
			<jdoc:include type="modules" name="sidepanel" style="<?php echo $sidepanel_module_style ?>" />
		</div>
	</div>
</div>
<?php } ?>