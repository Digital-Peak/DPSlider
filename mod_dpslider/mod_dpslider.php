<?php
/**
 * @package		DPSlider
 * @author		Digital Peak http://www.digital-peak.com
 * @copyright	Copyright (C) 2012 - 2013 Digital Peak. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
defined('_JEXEC') or die();

if ($params->get('show_on_start_page_only', '0') == '1' && JUri::getInstance()->toString(array(
		'query'
)) != '')
{
	return;
}
require (JModuleHelper::getLayoutPath('mod_dpslider'));