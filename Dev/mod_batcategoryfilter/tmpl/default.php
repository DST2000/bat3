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

