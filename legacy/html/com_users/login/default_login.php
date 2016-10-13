<?php
/**
 * @version		$Id: default_login.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.5
 */

defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
$this->form->reset( true ); // to reset the form xml loaded by the view
if (intval(JVERSION) >= 3) {
	$this->form->loadFile( dirname(__FILE__) . DIRECTORY_SEPARATOR . "login.xml");
}else{
	$this->form->loadFile( dirname(__FILE__) . DIRECTORY_SEPARATOR . "login25.xml");
}
?>

<div class="userpageswrap login">
	<div class="userpages">
		<?php if(JFactory::getApplication()->input->get( 'Itemid' ) !==''): ?>
		<?php if ($this->params->get('show_page_heading') && $this->params->get('page_heading') !=='' ) : ?>
		<h1 class="pagetitle">
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
		<?php else: ?>
		<h1 class="pagetitle<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
			<?php echo $this->escape($this->params->get('page_title')); ?>
		</h1>
		<?php endif; ?>
		<?php else:?>
		<h1 class="pagetitle<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
			<?php echo JText::_('Login') ?>
		</h1>
		<?php endif ; ?>
		<?php if ($this->params->get('logindescription_show') == 1 || $this->params->get('login_image') != '') : ?>
		<div class="login-description">
			<?php endif ; ?>
			<?php if($this->params->get('logindescription_show') == 1) : ?>
			<?php echo $this->params->get('login_description'); ?>
			<?php endif; ?>
			<?php if ($this->params->get('logindescription_show') == 1 || $this->params->get('login_image') != '') : ?>
		</div>
		<?php endif ; ?>
		<form action="<?php echo JRoute::_('index.php?option=com_users&amp;task=user.login'); ?>" class="form-form" method="post">
			<fieldset class="input form-fieldset">
				<?php foreach ($this->form->getFieldset('credentials') as $field): ?>
				<?php if (!$field->hidden): ?>
				<div class="login-fields"><?php echo $field->label; ?>
					<?php echo $field->input; ?></div>
				<?php endif; ?>
				<?php endforeach; ?>
				<?php if ($this->tfa): ?>
				<div class="login-fields">
					<?php echo $this->form->getField('secretkey')->label; ?>
					<?php echo $this->form->getField('secretkey')->input; ?>
				</div>				
				<?php endif; ?>
				<br />
				<ul class="unstyled">
					<li>
						<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
							<?php echo JText::_('COM_USERS_LOGIN_RESET'); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
							<?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?>
						</a>
					</li>
					<?php
						$usersConfig = JComponentHelper::getParams('com_users');
						if ($usersConfig->get('allowUserRegistration')) : ?>
					<li>
						<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
							<?php echo JText::_('COM_USERS_LOGIN_REGISTER'); ?>
						</a>
					</li>
					<?php endif; ?>
				</ul>
				<br />
				<div class="login-fields">
				<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
					<label id="remember-lbl" for="remember"><?php echo JText::_('JGLOBAL_REMEMBER_ME') ?></label>
					<input id="remember" type="checkbox" name="remember" class="remeber_me" value="yes"  alt="<?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>" />
				<?php endif; ?>
				<button type="submit" class="btn btn-small btn-sm button"><?php echo JText::_('JLOGIN'); ?></button>
				<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_url',$this->form->getValue('return'))); ?>" />
				<?php echo JHtml::_('form.token'); ?>
				</div>
			</fieldset>
		</form>
	</div>
</div>
