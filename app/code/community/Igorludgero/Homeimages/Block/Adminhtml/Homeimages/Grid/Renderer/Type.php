<?php
/**
 * @package     Igorludgero_Homeimages
 * @author      Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @copyright   Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Igorludgero_Homeimages_Block_Adminhtml_Homeimages_Grid_Renderer_Type extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex());
        if($value == 1){
            return Mage::helper("homeimages")->__("Normal");
        }
        else{
            return Mage::helper("homeimages")->__("On Mouse Over");
        }
    }
}