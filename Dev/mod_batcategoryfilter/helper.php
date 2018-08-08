<?php
/**
*
* Handle the category view
*
* @package	VirtueMart
* @subpackage
* @author RolandD
* @link https://virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: view.html.php 9755 2018-02-01 10:42:08Z Milbo $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// Load the view framework
if(!class_exists('VmView'))require(VMPATH_SITE.DS.'helpers'.DS.'vmview.php');

/**
* Handle the category view
*
* @package VirtueMart
* @author Max Milbers
*/
class BatVirtuemartViewCategory extends VmView {

	/*
	 * generate custom fields list to display as search in FE
	 */
	public function getSearchCustom() {

		$this->custom_parent_id = vRequest::getInt('custom_parent_id', 0);
		$this->searchCustomList = '';

		$db =JFactory::getDBO();

		$q1= 'SELECT c.* FROM #__virtuemart_customs  as c ';
		if(!empty($this->categoryId)){
			$q1 .= 'INNER JOIN #__virtuemart_product_customfields as pc on (c.virtuemart_custom_id=pc.virtuemart_custom_id)
INNER JOIN #__virtuemart_product_categories as cat ON (pc.virtuemart_product_id=cat.virtuemart_product_id)';
		}
		$q1 .= ' WHERE';
		if(!empty($this->categoryId)){
			$q1 .= ' virtuemart_category_id="'.$this->categoryId.'" and';
		}
		$q1 .= ' searchable="1" and (field_type="S" or field_type="P") and c.published = 1 GROUP BY c.virtuemart_custom_id';

		$db->setQuery($q1);
		$this->selected = $db->loadObjectList();
		//vmdebug('getSearchCustom '.str_replace('#__',$db->getPrefix(),$db->getQuery()),$this->selected);//,$this->categoryId,$this->selected);
		if($this->selected) {
			$app = JFactory::getApplication();
			foreach ($this->selected as $selected) {
				$valueOptions = array();
				if($selected->field_type=="S") {

					//if($selected->is_list) {
						//if($selected->is_list == "1") {
						$q2= 'SELECT pc.* FROM #__virtuemart_product_customfields  as pc ';
						$q2 .= 'INNER JOIN #__virtuemart_products as p on (pc.virtuemart_product_id=p.virtuemart_product_id)';
						if(!empty($this->categoryId)){
							$q2 .= 'INNER JOIN #__virtuemart_product_categories as cat on (pc.virtuemart_product_id=cat.virtuemart_product_id)';
						}
						$q2 .= ' WHERE virtuemart_custom_id="'.$selected->virtuemart_custom_id.'" and p.published="1" ';
						if(!empty($this->categoryId)){
							$q2 .= ' and virtuemart_category_id="'.$this->categoryId.'" ';
						}
						$q2 .= ' GROUP BY `customfield_value`';

						/*$q2 = 'SELECT * FROM `#__virtuemart_product_customfields` WHERE virtuemart_custom_id="'.$selected->virtuemart_custom_id.'" ';
						if(!empty($this->categoryId)){
							$q1 .= ' virtuemart_category_id="'.$this->categoryId.'" and';
						}
						$q2 = 'GROUP BY `customfield_value` ';*/
						$db->setQuery( $q2 );
						$Opts = $db->loadObjectList();
						//vmdebug('getSearchCustom my  q2 '.str_replace('#__',$db->getPrefix(),$db->getQuery()) );
						if($Opts){
							foreach( $Opts as $k => $v ) {
								if(!isset($valueOptions[$v->customfield_value])) {
									$valueOptions[$v->customfield_value] = $v->customfield_value;
								}
							}
							
							$v = $app->getUserStateFromRequest ('com_virtuemart.customfields.'.$selected->virtuemart_custom_id, 'customfields['.$selected->virtuemart_custom_id.']', '', 'string');
							$this->searchCustomValues .= '<div class="vm-search-custom-values-group"><div class="vm-custom-title-select">' .  vmText::_( $selected->custom_title ).'</div>'.JHtml::_( 'select.genericlist', $valueOptions, 'customfields['.$selected->virtuemart_custom_id.']', 'class="inputbox vm-chzn-select changeSendForm"', 'virtuemart_custom_id', 'custom_title', $v ) . '</div>';
						}

						//vmdebug('getSearchCustom '.$q2,$Opts,$valueOptions);
						/*} else if($selected->is_list == "2" and !empty($selected->custom_value)) {
							$valueOptions = array();
							$Opts = explode( ';', $selected->custom_value );
							foreach( $Opts as $k => $v ) {
								$valueOptions[$v] = $v;
							}
						}*/

				} else if($selected->field_type=="P"){
					$v = vRequest::getString('customfields['.$selected->virtuemart_custom_id.']');
					$n = 'customfields['.$selected->virtuemart_custom_id.']';
					$this->searchCustomValues .= vmText::_( $selected->custom_title ).' <input name="'.$n.'" class="inputbox vm-chzn-select" type="text" size="20" value="'.$v.'"/>';
				} else {
				//Atm not written for other field types
				/*	$db->setQuery('SELECT `customfield_value` as virtuemart_custom_id,`custom_value` as custom_title FROM `#__virtuemart_product_customfields` WHERE virtuemart_custom_id='.$selected->virtuemart_custom_id);
					$valueOptions= $db->loadAssocList();

					$valueOptions = array_merge(array($emptyOption), $valueOptions);
					$this->searchCustomValues .= '<div class="vm-search-custom-values-group"><div class="vm-search-title">'. vmText::_($selected->custom_title).'</div> '.JHtml::_('select.genericlist', $valueOptions, 'customfields['.$selected->virtuemart_custom_id.']', 'class="inputbox vm-chzn-select"', 'virtuemart_custom_id', 'custom_title', 0) . '</div>';*/

				}
			}
			$this->searchCustomValues .= '<div class="clear"></div>';
		}

		if(VmConfig::get('useCustomSearchTrigger',false)){
			// add search for declared plugins
			JPluginHelper::importPlugin('vmcustom');
			$dispatcher = JDispatcher::getInstance();
			$plgDisplay = $dispatcher->trigger('plgVmSelectSearchableCustom',array( &$this->options,&$this->searchCustomValues,$this->custom_parent_id ) );
		}
		//vmTime('getSearchCustom after trigger','getSearchCustom');
		vmJsApi::chosenDropDowns();
	}

	
}


//no closing tag