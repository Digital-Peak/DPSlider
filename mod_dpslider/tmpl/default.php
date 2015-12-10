<?php
/**
 * @package		DPSlider
 * @author		Digital Peak http://www.digital-peak.com
 * @copyright	Copyright (C) 2012 - 2015 Digital Peak. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

defined('_JEXEC') or die();

$doc = JFactory::getDocument();

JHtml::_('jquery.framework');

$doc->addScript(JURI::root().'modules/mod_dpslider/libraries/slider/slider.min.js');
$doc->addStyleSheet(JURI::root().'modules/mod_dpslider/libraries/slider/slider.min.css');

$width = $params->get('width');
$height = $params->get('height');

$folder = $params->get('folder');

$doc->addScriptDeclaration('jQuery(document).ready(function() {
	var dpSlider'.$module->id.' = jQuery("#mod-dpslider-'.$module->id.'").swiper({
		mode: "horizontal", calculateHeight: true, speed: 1000,
		loop: '.($params->get('loop', 1) == 1 ? 'true' : 'false').',
		autoplay: '.($params->get('autoplay', '') ? $params->get('autoplay', '') : "''").',
		pagination: "#mod-dpslider-pagination-container-'.$module->id.' .mod-dpslider-pagination"
	});
	jQuery("#mod-dpslider-pagination-container-'.$module->id.' .swiper-pagination-switch").click(function(){
    	dpSlider'.$module->id.'.stopAutoplay();
    	dpSlider'.$module->id.'.swipeTo(jQuery(this).index());
    });
	jQuery("#mod-dpslider-pagination-container-'.$module->id.' .mod-dpslider-lt").click(function(){
    	dpSlider'.$module->id.'.stopAutoplay();
    	dpSlider'.$module->id.'.swipePrev();
    });
	jQuery("#mod-dpslider-pagination-container-'.$module->id.' .mod-dpslider-gt").click(function(){
    	dpSlider'.$module->id.'.stopAutoplay();
    	dpSlider'.$module->id.'.swipeNext();
    });
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
<div class="mod-dpslider-pagination-container" id="mod-dpslider-pagination-container-<?php echo $module->id?>"><span class="mod-dpslider-lt">&lt;</span><span class="mod-dpslider-pagination"></span><span class="mod-dpslider-gt">&gt;</span></div>
<?php echo $params->get('textafter')?>
