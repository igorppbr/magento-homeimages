<?php
/**
 * @package     Igorludgero_Homeimages
 * @author      Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @copyright   Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Igorludgero_Homeimages_Model_Mysql4_Homeimages extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('homeimages/homeimages', 'id');
    }
}