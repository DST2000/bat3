<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php
JHtml::_('bootstrap.framework');
if($searchCustomValues) 
	{
			echo ($searchCustomValues);
	}
if (!empty($_REQUEST['virtuemart_category_id'])) 
	{
		$virtuemart_category_id = $_REQUEST['virtuemart_category_id'];
	}
else
	{
		$virtuemart_category_id = "category_not_set";
	}
echo "<p class='virtuemart_category_id'>".$virtuemart_category_id."</p>";
?>

<label for="customRange3">Example range</label>
<input type="range" class="custom-range" min="0" max="5" step="0.5" id="customRange3">

<br>
<br>


<div class="col-md-3">
<p class="center"> Value_1: </p>
	<br>
<input id="ex12a" type="text"/><br/>

<br>
<p class="center"> Value_2: </p>
	<br>
<input id="ex12b" type="text"/><br/>
<br>
<p class="center"> Value_3: </p>
	<br>
<input id="ex12c" type="text"/><br/>
</div>
<script>
// With JQuery

jQuery("#ex12a").slider({ id: "slider12a", min: 0, max: 30, range: true, value: [15, 20] });
jQuery("#ex12a").slider({
	tooltip: 'always'
});

jQuery("#ex12b").slider({ id: "slider12b", min: 0, max: 140, range: true, value: [2, 130] });
jQuery("#ex12b").slider({
	tooltip: 'always'
});
	
jQuery("#ex12c").slider({ id: "slider12c", min: 0, max: 10, range: true, value: [3, 7] });
jQuery("#ex12c").slider({
	tooltip: 'always'
});
	
//jQuery(function () {
//  $('[data-toggle="tooltip"]').tooltip()
//})
</script>

<style>
#slider12a .slider-track-high, #slider12b .slider-track-high, #slider12c .slider-track-high {
	background: green;
}

#slider12a .slider-track-low, #slider12b .slider-track-low, #slider12c .slider-track-low {
	background: red;
}

#slider12a .slider-selection, #slider12b .slider-selection, #slider12c .slider-selection {
	background: yellow;
}
	 .tooltip-max, .tooltip-min, .tooltip
	{
		opacity: 1;
		display: block !important;
	}
	.tooltip-main
	{
		opacity: 0;
	}

</style>

