<?php
/**
 * @package     Igorludgero_Homeimages
 * @author      Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @copyright   Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Igorludgero_Homeimages_Block_Adminhtml_Homeimages extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'homeimages';
        $this->_controller = 'adminhtml_homeimages';
        $this->_headerText = Mage::helper('homeimages')->__('Home Images - Manage Home Images');

        parent::__construct();
        $this->_removeButton('add');
        $this->_addButton('add_new', array(
            'label'   => Mage::helper('homeimages')->__('Add New Image'),
            'onclick' => "setLocation('{$this->getUrl('*/*/new')}')",
            'class'   => 'add'
        ));
    }
}