<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_batbrands
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('BatbrandHelper', JPATH_ROOT . '/components/com_batbrands/helpers/batbrand.php');
?>
<div class="batbrandgroup<?php echo $moduleclass_sfx; ?>">
<?php if ($headerText) : ?>
	<?php echo $headerText; ?>
<?php endif; ?>



<div class="row">
	<?php foreach ($list as $item) : ?>
		<div class="col-md-4">
			<div class="<?php echo $item->alias.' brandbox';?>">
				<?php $link = $item->clickurl ; ?>
				<?php $image_big = $item->image_big; ?>
				<?php $image_big_alt = $item->image_big_alt; ?>
				<?php $image_small = $item->image_small; ?>
				<?php $image_small_alt = $item->image_small_alt; ?>
				<?php $header_title = $item->header_title; ?>
				<?php $surface_area = $item->surface_area; ?>
				<?php $angle_processing = $item->angle_processing; ?>
				<?php $spacer = $item->spacer; ?>
				<?php $color = $item->color; ?>
				<?php $soffit_type = $item->soffit_type; ?>
				<?php $number_levels = $item->number_levels; ?>
				<?php $cost = $item->cost; ?>
				<?php $soffit_type = $item->soffit_type; ?>
				<?php $header_text = $item->header_text; ?>
				<?php $middle_text = $item->middle_text; ?>
				<?php $footer_text = $item->footer_text; ?>
				<?php if (!empty($link)) : ?>
					<a href="<?php echo $link; ?>" target="_blank" rel=""
						title="<?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?>">
				<?php endif; ?>
					<ul style="list-style: none">		
						<li>
							<?php if (!empty($header_title)) echo '<h2>' . $header_title . '</h2>';?>
							<?php if (!empty($cost)) echo '<span>' . $cost . ' р</span>'; ?>
						</li>
						<li>
							<?php if (BatbrandHelper::isImage($image_small)) : ?>
							<?php $baseurl = strpos($image_small, 'http') === 0 ? '' : JUri::base(); ?>
							<img
								src="<?php echo $baseurl . $image_small; ?>"
								alt="<?php echo $image_small_alt;?>"
							/>
							<?php endif; ?>
						</li>
						<li>
							<?php if (BatbrandHelper::isImage($image_big)) : ?>
							<?php $baseurl = strpos($image_big, 'http') === 0 ? '' : JUri::base(); ?>
							<img
								src="" alt="none" style="display: none" class="img_big"
								src_big="<?php echo $baseurl . $image_big; ?>"
								alt_big="<?php echo $image_big_alt;?>"
							/>
							<?php endif; ?>
						</li>
						
						<li class="show_big" style="display: none" >
							<?php if (!empty($surface_area)) echo 'Площадь: ' . $surface_area; ?>
						</li>
						<li class="show_big" style="display: none" >
							<?php if (!empty($angle_processing)) echo 'Обработка углов: ' . $angle_processing; ?>
						</li>
						<li class="show_big" style="display: none" >
							<?php if (!empty($spacer)) echo 'Закладная: ' . $spacer; ?>
						</li>
						<li class="show_big" style="display: none" >
							<?php if (!empty($color)) echo 'Цвет: ' . $color; ?>
						</li>
						<li class="show_big" style="display: none" >
							<?php if (!empty($soffit_type)) echo 'Тип навесного потолка: ' . $soffit_type; ?>
						</li>
						<li class="show_big" style="display: none" >
							<?php if (!empty($number_levels)) echo 'Количество уровней: ' . $number_levels; ?>
						</li>
						<li class="show_big" style="display: none" >
							<?php if (!empty($cost)) echo '<span>' . $cost . ' р</span>'; ?>
						</li>
						<li>
							<?php if (!empty($header_text)) echo $header_text; ?>
						</li>
						<li>
							<?php if (!empty($middle_text)) echo $middle_text; ?>
						</li>
						<li>
							<?php if (!empty($footer_text)) echo $footer_text; ?>
						</li>
					</ul>
				<?php if (!empty($link)) : ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
	
	<script>
		jQuery(window).on('load',  function() {
			jQuery('.brandbox').click(
							function(){
								$new_src = jQuery('.img_big').attr('src_big');
								$new_alt = jQuery('.img_big').attr('alt_big');
								jQuery('.img_big').hide();
								jQuery('.img_big').attr('src', ' ');
								jQuery('.img_big').attr('alt', ' ');
								jQuery('.show_big').hide();
								jQuery(this).find('.img_big').css('display', 'block');
								jQuery(this).find('.img_big').attr('src', $new_src);
								jQuery(this).find('.img_big').attr('alt', $new_alt);					
								jQuery(this).find('.show_big').css('display', 'block');		
								//jQuery('."col-md-12 i"').removeClass('col-md-12 i').addClass('col-md-4 i');
								//jQuery(this).parent('div').removeClass().addClass('col-md-12 i');
								//jQuery(this).parent('.col-md-4').append('<div class="col-md-12">TEXT</div>');
								//jQuery(this).parent('.col-md-4').append('<div class="col-md-12">TEXT</div>');
								jQuery(this).parent('.col-md-4').after('<div class="col-md-12 bigblock">TEXT</div>');
								//jQuery(this).parent('.col-md-4').insertAfter('<div class="col-md-12">TEXT</div>');
							}
						);
		});
	</script>
</div>

	
<?php foreach ($list as $item) : ?>
	<div class="batbranditem">
		<?php $link = JRoute::_('index.php?option=com_batbrands&task=click&id=' . $item->id); ?>
		<?php if ($item->type == 1) : ?>
			<?php // Text based batbrands ?>
			<?php echo str_replace(array('{CLICKURL}', '{NAME}'), array($link, $item->name), $item->custombatbrandcode); ?>
		<?php else : ?>
			<?php $imageurl = $item->params->get('imageurl'); ?>
			<?php $width = $item->params->get('width'); ?>
			<?php $height = $item->params->get('height'); ?>
			<?php if (BatbrandHelper::isImage($imageurl)) : ?>
				<?php // Image based batbrand ?>
				<?php $baseurl = strpos($imageurl, 'http') === 0 ? '' : JUri::base(); ?>
				<?php $alt = $item->params->get('alt'); ?>
				<?php $alt = $alt ?: $item->name; ?>
				<?php $alt = $alt ?: JText::_('MOD_BATBRANDS_BATBRAND'); ?>
				<?php if ($item->clickurl) : ?>
					<?php // Wrap the batbrand in a link ?>
					<?php $target = $params->get('target', 1); ?>
					<?php if ($target == 1) : ?>
						<?php // Open in a new window ?>
						<a
							href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer"
							title="<?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?>">
							<img
								src="<?php echo $baseurl . $imageurl; ?>"
								alt="<?php echo $alt;?>"
								<?php if (!empty($width)) echo ' width="' . $width . '"';?>
								<?php if (!empty($height)) echo ' height="' . $height . '"';?>
							/>
						</a>
					<?php elseif ($target == 2) : ?>
						<?php // Open in a popup window ?>
						<a
							href="<?php echo $link; ?>" onclick="window.open(this.href, '',
								'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550');
								return false"
							title="<?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?>">
							<img
								src="<?php echo $baseurl . $imageurl; ?>"
								alt="<?php echo $alt;?>"
								<?php if (!empty($width)) echo ' width="' . $width . '"';?>
								<?php if (!empty($height)) echo ' height="' . $height . '"';?>
							/>
						</a>
					<?php else : ?>
						<?php // Open in parent window ?>
						<a
							href="<?php echo $link; ?>"
							title="<?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?>">
							<img
								src="<?php echo $baseurl . $imageurl; ?>"
								alt="<?php echo $alt;?>"
								<?php if (!empty($width)) echo ' width="' . $width . '"';?>
								<?php if (!empty($height)) echo ' height="' . $height . '"';?>
							/>
						</a>
					<?php endif; ?>
				<?php else : ?>
					<?php // Just display the image if no link specified ?>
					<img
						src="<?php echo $baseurl . $imageurl; ?>"
						alt="<?php echo $alt;?>"
						<?php if (!empty($width)) echo ' width="' . $width . '"';?>
						<?php if (!empty($height)) echo ' height="' . $height . '"';?>
					/>
				<?php endif; ?>
			<?php elseif (BatbrandHelper::isFlash($imageurl)) : ?>
				<object
					classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
					codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
					<?php if (!empty($width)) echo ' width="' . $width . '"';?>
					<?php if (!empty($height)) echo ' height="' . $height . '"';?>
				>
					<param name="movie" value="<?php echo $imageurl; ?>" />
					<embed
						src="<?php echo $imageurl; ?>"
						loop="false"
						pluginspage="http://www.macromedia.com/go/get/flashplayer"
						type="application/x-shockwave-flash"
						<?php if (!empty($width)) echo ' width="' . $width . '"';?>
						<?php if (!empty($height)) echo ' height="' . $height . '"';?>
					/>
				</object>
			<?php endif; ?>
		<?php endif; ?>
		<div class="clr"></div>
	</div>
<?php endforeach; ?>

<?php if ($footerText) : ?>
	<div class="batbrandfooter">
		<?php echo $footerText; ?>
	</div>
<?php endif; ?>
</div>
