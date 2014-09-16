<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Template.Isis
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

function renderMessage($msgList)
{
	$buffer  = null;
	$alert = array('error' => 'yjtb_red', 'warning' => 'yjtb_red', 'notice' => 'yjtb_yellow', 'message' => 'yjtb_green');
	$icon  = array('error' => 'fa fa-ban', 'warning' => 'fa fa-warning', 'notice' => 'fa fa-warning', 'message' => 'fa fa-thumbs-up');

	// Only render the message list and the close button if $msgList has items
	if (is_array($msgList) && (count($msgList) >= 1))
	{

			foreach ($msgList as $type => $msgs)
			{
				$buffer .= '<div class="yjtbox ' . $alert[$type]. ' lineup">';
				$buffer .= '<span class="yjtboxicon ' . $icon[$type]. '"></span>';
				$buffer .= '<span class="yjtb_close"></span>';
				$buffer .= "\n<h4 class=\"yjtboxtitle\">" . JText::_($type) . "</h4>";
				if (count($msgs))
				{
					foreach ($msgs as $msg)
					{
						$buffer .= "\n\t\t" . $msg ;
					}
				}
				$buffer .= "\n</div>";
			}
	}

	return $buffer;
}
