<?php
defined('_JEXEC') or die;
JHtml::_('bootstrap.framework');
$tpath = $this->baseurl.'/templates/'.$this->template;
?>
<head>
<!--	<script src="<?php echo $tpath; ?>/js/popper.min.js" type="text/javascript"></script>-->
	<jdoc:include type="head" />
	<link href="<?php echo $tpath; ?>/css/jui/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $tpath; ?>/css/bootstrap-slider.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $tpath; ?>/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $tpath; ?>/css/ion.rangeSlider.skinHTML5.css" rel="stylesheet" type="text/css" />
<!--	<link href="<?php echo $tpath; ?>/css/highlightjs-github-theme.css" rel="stylesheet" type="text/css" />-->
	<script src="<?php echo $tpath; ?>/js/bootstrap-slider.js" type="text/javascript"></script>
	<script src="<?php echo $tpath; ?>/js/ion.rangeSlider.js" type="text/javascript"></script>
<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<!--[if lte IE 8]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<?php  if ($pie == 1) : ?>
			<style>
				{behavior:url(<?php  echo $tpath; ?>/js/PIE.htc);}
			</style>
		<?php  endif; ?>
	<![endif]-->
</head>