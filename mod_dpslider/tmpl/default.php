<?php
/**
 * @package		DPSlider
 * @author		Digital Peak http://www.digital-peak.com
 * @copyright	Copyright (C) 2012 - 2013 Digital Peak. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

defined('_JEXEC') or die();

$doc = JFactory::getDocument();

JHtml::_('jquery.framework');

$doc->addStyleSheet(JURI::root().'modules/mod_dpslider/tmpl/default.css');
$doc->addScript(JURI::root().'modules/mod_dpslider/libraries/slider/slider.min.js');
$doc->addStyleSheet(JURI::root().'modules/mod_dpslider/libraries/slider/slider.min.css');

$width = $params->get('width');
$height = $params->get('height');

$folder = $params->get('folder');

$doc->addScriptDeclaration('jQuery(document).ready(function() {
	var dpSlider'.$module->id.' = jQuery("#mod-dpslider-'.$module->id.'").swiper({
		mode:"horizontal",calculateHeight: true,
		loop: true,
		pagination: ".mod-dpslider-pagination"
	});
	jQuery(".mod-dpslider-pagination .swiper-pagination-switch").click(function(){
    	dpSlider'.$module->id.'.swipeTo(jQuery(this).index());
    })
});');

//<div id="swiper-scrollbar-<php echo $module->id>" class="swiper-scrollbar"></div>
echo $params->get('textbefore');
?>

<div id="mod-dpslider-<?php echo $module->id?>" class="swiper-container" style="<?php echo (empty($height) ? '' : 'height:'.$height.';').(empty($width) ? '' : 'width:'.$width.';')?>">
  <div class="swiper-wrapper">
<?php 
if (!empty($folder) && $folder != -1) {
	foreach (JFolder::files(JPATH_BASE.'/images/dpslider/'.$folder) as $file) { ?>
      <div class="swiper-slide"><img src="images/dpslider/<?php echo $folder.'/'.$file?>"></div>
<?php 
	}
}
for ($i = 0; $i < 10; $i++) {
	$content = $params->get('slide'.$i, '');
	if (empty($content)) {
		continue;
	}
	echo '<div class="swiper-slide">'.$content.'</div>';
}
?>
  </div>
</div>
<p class="mod-dpslider-pagination"></p>
<?php echo $params->get('textafter')?>