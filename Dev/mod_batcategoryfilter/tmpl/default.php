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


<p> Single-value slider, high track: </p>
<input id="ex12a" type="text"/><br/>
Note that there is no low track on the single-value slider. The area to lesser than the value of the handle is the selection.

<p> Range slider, low track: </p>
<input id="ex12b" type="text"/><br/>

<p> Range slider, low and high tracks, and selection: </p>
<input id="ex12c" type="text"/><br/>

<br>

<span id="ex18-label-2a" class="hidden">Example low value</span>
<span id="ex18-label-2b" class="hidden">Example high value</span>
<input id="ex18b" type="text"/>

<script>
// With JQuery
jQuery("#ex12a").slider({ id: "slider12a", min: 0, max: 10, value: 5 });
jQuery("#ex12b").slider({ id: "slider12b", min: 0, max: 10, range: true, value: [3, 7] });
jQuery("#ex12c").slider({ id: "slider12c", min: 0, max: 10, range: true, value: [3, 7] });
	
	
jQuery("#ex18b").slider({
	min: 0,
	max: 10,
	value: [3, 6],
	labelledby: ['ex18-label-2a', 'ex18-label-2b']
});
</script>

<style>
#slider12a .slider-track-high, #slider12c .slider-track-high {
	background: green;
}

#slider12b .slider-track-low, #slider12c .slider-track-low {
	background: red;
}

#slider12c .slider-selection {
	background: yellow;
}
</style>

