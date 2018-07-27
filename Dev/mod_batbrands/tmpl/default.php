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
					<p class="header">
						<?php if (!empty($header_title)) echo $header_title;?>
						<?php if (!empty($cost)) echo '<span> за ' . $cost . ' рублей</span>'; ?>
					</p>	
					<div>
						<?php if (BatbrandHelper::isImage($image_small)) : ?>
							<?php $baseurl = strpos($image_small, 'http') === 0 ? '' : JUri::base(); ?>
							<img
								src="<?php echo $baseurl . $image_small; ?>"
								alt="<?php echo $image_small_alt;?>"
								class="img_small"
							/>
						<?php endif; ?>
					</div>	
					<div class="row">
						<div class="col-md-8">
							<?php if (BatbrandHelper::isImage($image_big)) : ?>
							<?php $baseurl = strpos($image_big, 'http') === 0 ? '' : JUri::base(); ?>
							<img
								src="" alt="none" style="display: none" class="img_big img-fluid"
								src_big="<?php echo $baseurl . $image_big; ?>"
								alt_big="<?php echo $image_big_alt;?>"
							/>
							<?php endif; ?>
						</div>
						<div class="col-md-4">
							<ul style="list-style: none; display: none;" class="show_big">
								<li>
									<h3>
										<?php if (!empty($header_title)) echo $header_title;?>
										<?php if (!empty($cost)) echo '<span> за ' . $cost . ' рублей</span>'; ?>
									</h3>
								</li>
								<li>
									<?php if (!empty($surface_area)) echo 'Площадь: ' . $surface_area . ' м<sup>2</sup>'; ?>
								</li>
								<li>
									<?php if (!empty($angle_processing)) echo 'Обработка углов: ' . $angle_processing . ' шт.'; ?>
								</li>
								<li>
									<?php if (!empty($spacer)) echo 'Закладная: ' . $spacer . ' шт.'; ?>
								</li>
								<li>
									<?php if (!empty($color)) echo 'Цвет: ' . $color; ?>
								</li>
								<li>
									<?php if (!empty($soffit_type)) echo 'Тип навесного потолка: ' . $soffit_type; ?>
								</li>
								<li>
									<?php if (!empty($number_levels)) echo 'Количество уровней: ' . $number_levels . ' шт.'; ?>
								</li>
								<li>
									<?php if (!empty($cost)) echo '<h4>Стоимость <span>' . $cost . ' рублей</span></h4>'; ?>
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
						</div>
					</div>
	
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
								$new_src = jQuery(this).find('.img_big').attr('src_big');
								$new_alt = jQuery(this).find('.img_big').attr('alt_big');
								jQuery('.img_big').hide();
								jQuery('.img_big').attr('src', ' ');
								jQuery('.img_big').attr('alt', ' ');
								jQuery('.show_big').hide();
								jQuery('.bigblock').remove();
								jQuery('.arrows_add').remove();
								jQuery(this).find('.img_big').css('display', 'block');
								jQuery(this).find('.img_big').attr('src', $new_src);
								jQuery(this).find('.img_big').attr('alt', $new_alt);					
								jQuery(this).find('.show_big').css('display', 'block');	
							
								jQuery(this).parent('.col-md-4')
									.after('<div class="col-md-12 bigblock"></div>');
								jQuery('.new_image_big').attr('src', $new_src);
								jQuery(this).clone().appendTo('.bigblock');
								jQuery('.bigblock').find('.img_big').css('display', 'inline');
								jQuery('.bigblock').find('.img_big').attr('src', $new_src);
								jQuery('.bigblock').find('.img_big').attr('alt', $new_alt);					
								jQuery('.bigblock').find('.img_small').css('display', 'none');	
								jQuery('.bigblock').css('background', '#42ECEF');	
								jQuery(this).find('.img_big').css('display', 'none');
								jQuery(this).find('.show_big').css('display', 'none');
								jQuery(this).parent('.col-md-4').append('<span class="arrows_add text-info" style="background:#42ECEF">&darr;</span>');
								jQuery('.bigblock').find('p.header').remove();

								//jQuery('.new_image_big').attr('alt', $new_alt);
								//jQuery(this).parent('.col-md-4').insertAfter('<div class="col-md-12">TEXT</div>');
							}
						);
		});
	</script>
</div>

<?php if ($footerText) : ?>
	<div class="batbrandfooter">
		<?php echo $footerText; ?>
	</div>
<?php endif; ?>
</div>
