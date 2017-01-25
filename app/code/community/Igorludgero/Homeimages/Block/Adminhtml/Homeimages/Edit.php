<?php
/**
 * @package     Igorludgero_Homeimages
 * @author      Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @copyright   Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Igorludgero_Homeimages_Block_Adminhtml_Homeimages_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'homeimages';
        $this->_controller = 'adminhtml_homeimages';
        $this->_headerText = Mage::helper('homeimages')->__('Home Images - Image');
        $this->_updateButton('save', 'label', Mage::helper('homeimages')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('homeimages')->__('Delete'));
    }
}