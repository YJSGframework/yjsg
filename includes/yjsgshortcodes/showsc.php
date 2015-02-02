<?php
define( '_JEXEC', 1 );
define( 'JPATH_BASE', realpath(dirname(__FILE__).'/../../../../..'));

require_once ( JPATH_BASE.'/includes/defines.php' );
require_once ( JPATH_BASE.'/includes/framework.php' );

jimport('joomla.language.language');
jimport('joomla.filesystem.file');

$app = JFactory::getApplication('site');
$app->initialise();
$lang = JFactory::getLanguage();
$lang->setLanguage(JComponentHelper::getParams('com_languages')->get('site'));
$uri=JURI::getInstance();
JPlugin::loadLanguage('joomla');
JPlugin::loadLanguage('plg_system_yjsg');

$shortcode = $app->input->get('sc', 'icons', 'CMD');
$filetype = $app->input->get('t', 'html', 'WORD');

if (!in_array($filetype,array('html','js'))) { echo JText::_('JGLOBAL_AUTH_ACCESS_DENIED'); die(); }
if (JFile::exists(JPATH_BASE.'/templates/'.$app->getTemplate().'/custom/yjsgshortcodes/templates/'.$shortcode.'.'.$filetype)) $filename=JPATH_BASE.'/templates/'.$app->getTemplate().'/custom/yjsgshortcodes/templates/'.$shortcode.'.'.$filetype;
else if (JFile::exists(JPATH_BASE.'/plugins/system/yjsg/includes/yjsgshortcodes/templates/'.$shortcode.'.'.$filetype)) $filename=JPATH_BASE.'/plugins/system/yjsg/includes/yjsgshortcodes/templates/'.$shortcode.'.'.$filetype;
else { echo JText::_('JGLOBAL_AUTH_ACCESS_DENIED'); die(); }

$mimetype=($filetype=='html')?'text/html':'application/javascript';

$data=JFile::read($filename);
if ($filetype=='html')
{
	//correct paths
	$data=str_replace('href="../../../','href="../../',$data);
	$data=str_replace('src="../../../','src="../../',$data);
	$data=str_replace('src="'.$shortcode.'.js','src="'.$uri->toString(array('path')).'?sc='.$shortcode.'&amp;t=js',$data);
}
//replace languagues
preg_match_all("/\{\{([A-Z0-9\_\-]+)\}\}/",$data, $tmatches, PREG_SET_ORDER);
foreach ($tmatches as $tmatchkey => $tmatch)
{
	$data=str_replace($tmatch[0],JText::_($tmatch[1]),$data);
}

header('Content-type: '.$mimetype.';charset=utf-8');
header('Cache-Control: max-age=0');

echo $data;
?>