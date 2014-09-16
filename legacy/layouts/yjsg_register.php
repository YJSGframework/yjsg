<?php
/*======================================================================*\
|| #################################################################### ||
|| # Package - Joomla Template based on YJSimpleGrid Framework          ||
|| # Copyright (C) 2010  Youjoomla.com. All Rights Reserved.            ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla.com                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         ||
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### ||
\*======================================================================*/
defined('_JEXEC') or die('Restricted access'); 
$document->addScript(JURI::base().'media/system/js/validate.js');
?>
<form action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" id="josForm" name="josForm" class="form-validate yjsg-form">
	<div class="yjsg-userpages yjsg-registration">
		<div class="yjsg-form-group">
			<label id="namemsg" for="name"> *&nbsp;<?php echo JText::_( 'YJSG_NAME' ); ?>: </label>
			<input type="text" name="jform[name]" id="name" size="40" value="" class="inputbox required" maxlength="50" />
		</div>
		<div class="yjsg-form-group">
			<label id="usernamemsg" for="username"> *&nbsp;<?php echo JText::_( 'YJSG_USERNAME' ); ?>: </label>
			<input type="text" id="username" name="jform[username]" size="40" value="" class="inputbox required validate-username" maxlength="25" />
		</div>
		<div class="yjsg-form-group">
			<label id="emailmsg" for="email"> *&nbsp;<?php echo JText::_( 'YJSG_EMAIL' ); ?>: </label>
			<input type="text" id="email" name="jform[email1]" size="40" value="" class="inputbox required validate-email" maxlength="100" />
		</div>
		<div class="yjsg-form-group">
			<label id="emailmsg2" for="email2"> *&nbsp;<?php echo JText::_( 'YJSG_VERIFY_EMAIL' ); ?>: </label>
			<input type="text" id="email2" name="jform[email2]" size="40" value="" class="inputbox required validate-email" maxlength="100" />
		</div>
		<div class="yjsg-form-group">
			<label id="pwmsg" for="password"> *&nbsp;<?php echo JText::_( 'YJSG_PASSWORD' ); ?>: </label>
			<input class="inputbox required validate-password" type="password" id="password" name="jform[password1]" size="40" value="" />
		</div>
		<div class="yjsg-form-group">
			<label id="pw2msg" for="password2"> *&nbsp;<?php echo JText::_( 'YJSG_VERIFY_PASSWORD' ); ?>: </label>
			<input class="inputbox required validate-passverify" type="password" id="password2" name="jform[password2]" size="40" value="" />
		</div>
		<p>
			<?php echo JText::_( 'YJSG_REGISTER_REQUIRED' ); ?>
		</p>
		<button class="button validate" type="submit"><?php echo JText::_('YJSG_REGISTER'); ?></button>
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="registration.register" />
		<?php echo JHtml::_('form.token');?>
	</div>
</form>