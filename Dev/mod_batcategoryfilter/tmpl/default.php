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
<input id="ex12cnumber" type="number" value=""/>
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

jQuery("#ex12a").slider({ id: "slider12a", min: 0, max: 30, range: true, value: [5, 20], tooltip: 'always'	});



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
<br>

<br>
<br>
<div class="range-slider">
    <input type="text" class="js-range-slider" value="" />
</div>
<div class="extra-controls">
    Значения
    от <input type="text" class="js-input-from" value="0" />до
    <input type="text" class="js-input-to" value="180" />

</div>

<script>
jQuery(function ($)
{
	var $range = $(".js-range-slider");
	var $inputFrom = $(".js-input-from");
	var $inputTo = $(".js-input-to");
	var min = 0;
	var max = 180;
	var marks = [30, 55, 100, 140];

	$range.ionRangeSlider({
		type: "double",
		min: min,
		max: max,
		from: 2,
		to: 140,
		onStart: function (data) {
			addMarks(data.slider);
		},
		onChange: updateInputs
	});

	function convertToPercent (num) {
		var percent = (num - min) / (max - min) * 100;

		return percent;
	}

	function addMarks ($slider) {
		var html = '';
		var left = 0;
		var i;

		for (i = 0; i < marks.length; i++) {
			left = convertToPercent(marks[i]);
			html += '<span class="mark" style="left: ' + left + '%">' + marks[i] + '</span>';
		}

		$slider.append(html);
	}

	function updateInputs (data) {
		from = data.from;
		to = data.to;

		$inputFrom.prop("value", from);
		$inputTo.prop("value", to);	
	}
	
	
});

</script>

<style>

html {
    height: 100%;
}
body {
    height: 100%;
    overflow: hidden;
    margin: 40px;
    font-family: Arial, sans-serif;
    font-size: 12px;
}
.range-slider {
    position: relative;
    height: 80px;
}
.extra-controls {
    position: relative;
    border-top: 3px solid #000;
    padding: 10px 0 0;
}

.mark {
    display: block;
    position: absolute;
    top: 45px;
    background: #f00;
    transform: rotate(-45deg);
    padding: 1px 3px;
    border-radius: 3px;
    color: #fff;
    margin-left: -10px;
}

</style>