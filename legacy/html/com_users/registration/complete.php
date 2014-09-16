<?php
/**
 * @version		$Id: complete.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 */

defined('_JEXEC') or die;
$app = JFactory::getApplication();
$itemid = JRequest::getint( 'Itemid' );
$app->redirect( "index.php?option=com_users&view=login");
?>