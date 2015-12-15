<?php
/**
 * @package		DPSlider
 * @author		Digital Peak http://www.digital-peak.com
 * @copyright	Copyright (C) 2012 - 2014 Digital Peak. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
defined('_JEXEC') or die();

JHtml::_('jquery.framework', false, null, false);

$doc = JFactory::getDocument();
$doc->addScript(JURI::root() . 'modules/mod_dpslider/libraries/slider/swiper.jquery.min.js');
$doc->addStyleSheet(JURI::root() . 'modules/mod_dpslider/libraries/slider/swiper.min.css');

$doc->addScriptDeclaration('jQuery(document).ready(function() {
	var dpSlider' . $module->id . ' = new Swiper("#mod-dpslider-' . $module->id . '", {
		direction: "horizontal",
		calculateHeight: true,
		speed: 1000,
		paginationClickable: true,
		nextButton: ".swiper-button-next",
		prevButton: ".swiper-button-prev",
		spaceBetween: 10,
		slidesPerView: 1,
		loop: true,
		autoplay: ' . ($params->get('autoplay', '') ? $params->get('autoplay', '') : "''") . ',
		pagination: "#mod-dpslider-pagination-container-' . $module->id . '",
		centeredSlides: true,
		effect: "' . $params->get('effect', 'slide') . '"
		' . (!$params->get('loop', 1) ? ',onProgress: function(s, p){if(s.slides.length < 4 || s.slides.length -3 == s.activeIndex)s.stopAutoplay();}' : '' ) . '
	});
});');

$width = $params->get('width');
$height = $params->get('height');
$folder = $params->get('folder');

echo $params->get('textbefore');
?>

<div id="mod-dpslider-<?php echo $module->id?>" class="swiper-container" style="<?php echo (empty($height) ? '' : 'max-height:'.$height.';').(empty($width) ? '' : 'max-width:'.$width.';')?>">
	<div class="swiper-wrapper">
<?php
if (! empty($folder) && $folder != - 1)
{
	foreach (JFolder::files(JPATH_BASE . '/images/dpslider/' . $folder) as $file)
	{
		?>
		<div class="swiper-slide">
			<img src="images/dpslider/<?php echo $folder.'/'.$file?>">
		</div>
<?php
	}
}
for ($i = 0; $i < 10; $i ++)
{
	$content = $params->get('slide' . $i, '');
	if (empty($content))
	{
		continue;
	}
	echo '<div class="swiper-slide">' . $content . '</div>';
}
?>
	</div>
	<div class="mod-dpslider-pagination swiper-pagination swiper-pagination-clickable"
		id="mod-dpslider-pagination-container-<?php echo $module->id?>"></div>
	<div class="swiper-button-next swiper-button-grey"></div>
	<div class="swiper-button-prev swiper-button-grey"></div>
</div>
<?php echo $params->get('textafter')?>
