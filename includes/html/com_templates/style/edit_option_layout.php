<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
// No direct access.
defined('_JEXEC') or die;
if($name =='YJSG_LAYOUT_LABEL' || $name =='YJSG_DEF_GRID_LABEL' || $name =='YJSG_LOGO_LABEL'){ 

				foreach ($this->form->getFieldset($name) as $field) : 
				
				
					$fieldKey 					= str_replace(array('jform[params]', '[', ']'),'',$field->name);
					$fieldsArray[$fieldKey] 	= $field->input; 
					$fieldLabel[$fieldKey]  	= $field->label;
					$fieldValue[$fieldKey]  	= $field->value;
		
				
				endforeach;
				
				// template params
				$templateSettings 	= YJSGTEMPLATEPATH . "template-settings.xml";
				$loadSettings		= simplexml_load_file($templateSettings);
				
				
				// default style
				$defaultStyle 		= $loadSettings->xpath("//field[@name='yjsg_get_styles']/@default");
				if(!empty($defaultStyle)){
					
					$defaultStyle	= (string)$defaultStyle[0];
					
				}else{
					
					$defaultStyle	= $this->form->getFieldAttribute('yjsg_get_styles','default' ,'default', 'params');
				}
				$defaultStyle		= explode('|',$defaultStyle);
				$defaultStyle		= $defaultStyle[0];				
				
				// main grid resets
				$tsDefaults = array('maincolumn'=>'55','insetcolumn'=>'0','leftcolumn'=>'22.5','rightcolumn'=>'22.5');
				$xmlReset 	= array();
				foreach($tsDefaults as $key => $fieldV){
					
						$value 		= $loadSettings->xpath("//field[@name='".$key."']/@default");
						if(!empty($value)){
							
							$value		= (string)$value[0];
							
						}else{
							
							$value		= $this->form->getFieldAttribute($key,'default' ,$fieldV, 'params');
						}
						
						$xmlReset[$key] = $value;
					
				}

				$mbResets = $xmlReset['maincolumn'].'|'.$xmlReset['insetcolumn'].'|'.$xmlReset['leftcolumn'].'|'.$xmlReset['rightcolumn'];
}
?>
<?php if($fieldSet->name =='YJSG_LAYOUT_LABEL'){ ?>

<div id="<?php echo strtolower($name);?>" class="layouttab tab-pane<?php echo $isactivetab?>">
	<div class="yjsg_layoutholder">
		<div class="sidepanel settingpannel side">
			<ul class="adminformlist">
				<li><?php echo $fieldLabel['YJSG_SIDEPANEL_YJ_LABEL'].$fieldsArray['YJSG_SIDEPANEL_YJ_LABEL'] ?></li>
				<li><?php echo $fieldLabel['spbox_width'].$fieldsArray['spbox_width'] ?></li>
				<li><?php echo $fieldLabel['spbtn_poz'].$fieldsArray['spbtn_poz'] ?></li>
				<li><?php echo $fieldLabel['sptran_speed'].$fieldsArray['sptran_speed'] ?></li>
				<li><?php echo $fieldLabel['sidepanel_module_style'].$fieldsArray['sidepanel_module_style'] ?></li>
			</ul>
		</div>
		<a href="javascript:;" class="opensettings sideopen" data-direction="side" data-settings=".sidepanel">
			<?php echo JText::_('YJSG_SIDE_PANEL') ?>
		</a>
		<div class="toppanel settingpannel">
			<ul class="adminformlist">
				<li><?php echo $fieldLabel['YJSG_TOPPANEL_YJ_LABEL'].$fieldsArray['YJSG_TOPPANEL_YJ_LABEL'] ?></li>
				<li><?php echo $fieldLabel['tpopen_text'].$fieldsArray['tpopen_text'] ?></li>
				<li><?php echo $fieldLabel['tpclose_text'].$fieldsArray['tpclose_text'] ?></li>
				<li><?php echo $fieldLabel['tpbtn_height'].$fieldsArray['tpbtn_height'] ?></li>
				<li><?php echo $fieldLabel['tpbtn_width'].$fieldsArray['tpbtn_width'] ?></li>
				<li><?php echo $fieldLabel['tptran_speed'].$fieldsArray['tptran_speed'] ?></li>
			</ul>
			<?php if(isset($fieldsArray['yjsg_toppanel_width']))echo $fieldsArray['yjsg_toppanel_width']?>
		</div>
		<a href="javascript:;" class="opensettings topopen" data-direction="top" data-settings=".toppanel">
			<?php echo JText::_('YJSG_TOP_PANEL') ?>
		</a>
		<fieldset class="panelform yjsglayout">
			<!-- start grid -->
			<?php if(in_array('yjsg1',$yjsglayoutarray))echo $fieldsArray['yjsg_1_width']?>
			<!-- yjsg1 -->
			<div id="yjsg_headerblock" data-position="1" class="yjsg_grid yjsgorder">
				<div class="yjsglogo_settings settingpannel">
					<ul class="adminformlist">
						<li><?php echo $fieldLabel['logo_image'].$fieldsArray['logo_image'] ?></li>
						<li><?php echo $fieldLabel['logo_width'].$fieldsArray['logo_width'] ?></li>
						<li><?php echo $fieldLabel['logo_height'].$fieldsArray['logo_height'] ?></li>
						<li><?php echo $fieldLabel['turn_logo_off'].$fieldsArray['turn_logo_off'] ?></li>
						<li><?php echo $fieldLabel['turn_header_block_off'].$fieldsArray['turn_header_block_off'] ?></li>
					</ul>
				</div>
				<div class="yjsglogo">
					<a href="javascript:;" class="opensettings" data-settings=".yjsglogo_settings">
						<i class="fa fa-cog"></i>
					</a>
					<img id="logoImage" src="<?php echo JURI::root() ?>templates/<?php echo $this->item->template; ?>/images/<?php echo $defaultStyle; ?>/logo.png" alt="logo">
				</div>
				<?php if(isset($fieldsArray['yjsg_header_width'])){?>
				<!-- yjsg_header_grid -->
				<?php echo $fieldsArray['yjsg_header_width'] ?>
				<?php } ?>
			</div>
			<!-- topmenu -->
			<div id="yjsg_topmenu" data-position="<?php echo array_search('yjsg_topmenu', $yjsglayoutarray) ?>" class="yjsg_grid yjsgorder">
				<div class="topmenu orange"><?php echo JText::_('YJSG_TOPMENU') ?></div>
			</div>
			<?php if(isset($fieldsArray['yjsg_2_width']))echo $fieldsArray['yjsg_2_width']?>
			<!-- yjsg2 -->
			<?php if(isset($fieldsArray['yjsg_3_width']))echo $fieldsArray['yjsg_3_width']?>
			<!-- yjsg3 -->
			<?php if(isset($fieldsArray['yjsg_4_width']))echo $fieldsArray['yjsg_4_width']?>
			<!-- yjsg4 -->
			<?php if(isset($fieldsArray['yjsg_newgrid1_width']))echo $fieldsArray['yjsg_newgrid1_width']?>
			<!-- newgrid1 -->
			<?php if(isset($fieldsArray['yjsg_newgrid2_width']))echo $fieldsArray['yjsg_newgrid2_width']?>
			<!-- newgrid2 -->
			<?php if(isset($fieldsArray['yjsg_newgrid3_width']))echo $fieldsArray['yjsg_newgrid3_width']?>
			<!-- newgrid3 -->
			<?php if(isset($fieldsArray['yjsg_newgrid4_width']))echo $fieldsArray['yjsg_newgrid4_width']?>
			<!-- newgrid4 -->
			<?php if(isset($fieldsArray['yjsg_newgrid5_width']))echo $fieldsArray['yjsg_newgrid5_width']?>
			<!-- newgrid5 -->
			<?php if(isset($fieldsArray['yjsg_newgrid6_width']))echo $fieldsArray['yjsg_newgrid6_width']?>
			<!-- newgrid6 -->
			<?php if(isset($fieldsArray['yjsg_newgrid7_width']))echo $fieldsArray['yjsg_newgrid7_width']?>
			<!-- newgrid7 -->
			
			<div id="yjsg_loadlayout" data-position="<?php echo array_search('yjsg_loadlayout', $yjsglayoutarray) ?>" class="yjsg_grid orange yjsgorder">
				<div class="clonelayoutbox">
					<span> <?php echo JText::_('YJSG_DEFINE_ITEMID_LABEL') ?> </span>
					<?php echo $fieldsArray['define_itemid'] ?>
				</div>
				<ul class="mainbodytabs nav nav-tabs">
					<li id="mainbodyTab" class="active">
						<a id="defaultmbtr" class="mainbtrigger" href="#defaultmb" data-toggle="tab">
							<?php echo JText::_('YJSG_DEFAULT') ?>
						</a>
					</li>
				</ul>
				<div class="mainbodytabcont tab-content">
					<div class="tab-pane fade in active" id="defaultmb">
						<div id="mainbodyLayoutHolder" class="mbLayout yjsg_maingrid midleftright">
							<div class="selectLayout">
								<div class="lblock">
									<span> <?php echo JText::_('YJSG_SELECT_LAYOUT') ?> </span>
									<div class="layoutOption lmr" data-layout="1" title="<?php echo JText::_('YJSG_SELECT_LAYOUT_LMR') ?>"></div>
									<div class="layoutOption mlr" data-layout="2" title="<?php echo JText::_('YJSG_SELECT_LAYOUT_MLR') ?>"></div>
									<div class="layoutOption lrm" data-layout="3" title="<?php echo JText::_('YJSG_SELECT_LAYOUT_LRM') ?>"></div>
								</div>
								<div class="lblock">
									<ul class="adminformlist">
										<li><?php echo $fieldLabel['css_width'].$fieldsArray['css_width'] ?></li>
										<li class="hide"><?php echo $fieldLabel['site_layout'].$fieldsArray['site_layout'] ?></li>
									</ul>
								</div>
							</div>
							<div class="jholdinsets"><!-- yjsg_bodytop_width -->
								<?php if(isset($fieldsArray['yjsg_bodytop_width']))echo $fieldsArray['yjsg_bodytop_width']?>
								<!-- insettop -->
								<div class="yjsg_moduleh insettop jinsets">
									<?php echo $fieldsArray['insettop'] ?>
								</div>
							</div>
							<!-- mainbody -->
							<div id="jmainbody" class="yjsg_grid jcomponent yjsg_grid_widths">
								<div class="yjsg_moduleh jmainbody">
									<?php echo $fieldsArray['maincolumn'] ?>
									<a class="YJSG_reset-values btn btn-xs btn-primary" data-elementcss="yjsg_mainbody_width" href="javascript:;" data-resets="<?php echo $mbResets ?>">
										<?php echo JText::_('YJSG_RESET') ?>
									</a>
								</div>
								<div class="yjsg_moduleh jinset">
									<?php echo $fieldsArray['insetcolumn'] ?>
								</div>
								<div class="yjsg_moduleh jleft">
									<?php echo $fieldsArray['leftcolumn'] ?>
								</div>
								<div class="yjsg_moduleh jright">
									<?php echo $fieldsArray['rightcolumn'] ?>
								</div>
							</div>
							<!-- end mainbody -->
							<div class="jholdinsets"><!-- yjsg_bodybottom_width -->
								<?php if(isset($fieldsArray['yjsg_yjsgbodytbottom_width']))echo $fieldsArray['yjsg_yjsgbodytbottom_width']?>
								<!-- insetbottom -->
								<div class="yjsg_moduleh insettop jinsets">
									<?php echo $fieldsArray['insetbottom'] ?>
								</div>
							</div>
						</div>
						<!-- end mainbodyLayoutHolder -->
					</div>
					<!-- end tab-pane defaultmb -->
				</div>
				<!-- end tab-content -->
			</div>
			<!-- end yjsg_loadlayout -->
			<div id="yjsg_pathway" data-position="<?php echo array_search('yjsg_pathway', $yjsglayoutarray) ?>" class="yjsg_grid orange yjsgorder"><!-- pathway -->
				<div class="pathway"><?php echo JText::_('YJSG_BREADCRUMB') ?></div>
			</div>
			<?php if(isset($fieldsArray['yjsg_5_width']))echo $fieldsArray['yjsg_5_width']?>
			<!-- yjsg5 -->
			<?php if(isset($fieldsArray['yjsg_6_width']))echo $fieldsArray['yjsg_6_width']?>
			<!-- yjsg6 -->
			<?php if(isset($fieldsArray['yjsg_7_width']))echo $fieldsArray['yjsg_7_width']?>
			<!-- yjsg7 -->
			<div id="yjsg_footer" data-position="11" class="yjsg_grid orange yjsgorder"><!-- footer -->
				<div class="yjsg_moduleh footermodule">
					<div class="yjsg_module orange">
						<label><?php echo JText::_('YJSG_FOOTER') ?></label>
					</div>
					<div class="validators yjsg_module orange"><?php echo JText::_('YJSG_VALIDATORS') ?></div>
				</div>
			</div>
			<!-- end grids -->
		</fieldset>
		<div id="bottomP" data-position="12" class="yjsgorder">
			<div class="bottompanel settingpannel">
				<ul class="adminformlist">
					<li><?php echo $fieldLabel['YJSG_BOTPANEL_YJ_LABEL'].$fieldsArray['YJSG_BOTPANEL_YJ_LABEL'] ?></li>
					<li><?php echo $fieldLabel['bpopen_text'].$fieldsArray['bpopen_text'] ?></li>
					<li><?php echo $fieldLabel['bpclose_text'].$fieldsArray['bpclose_text'] ?></li>
					<li><?php echo $fieldLabel['bpbtn_height'].$fieldsArray['bpbtn_height'] ?></li>
					<li><?php echo $fieldLabel['bpbtn_width'].$fieldsArray['bpbtn_width'] ?></li>
					<li><?php echo $fieldLabel['bptran_speed'].$fieldsArray['bptran_speed'] ?></li>
				</ul>
				<?php if(isset($fieldsArray['yjsg_botpanel_width']))echo $fieldsArray['yjsg_botpanel_width']?>
			</div>
			<a href="#yjsg_botpanel_width" class="opensettings bottomopen" data-scrollto="yjsg_botpanel_width" data-direction="top" data-settings=".bottompanel">
				<?php echo JText::_('YJSG_BOTTOM_PANEL') ?>
			</a>
		</div>
	</div>
	<!-- end layout -->
</div>
<?php } ?>
