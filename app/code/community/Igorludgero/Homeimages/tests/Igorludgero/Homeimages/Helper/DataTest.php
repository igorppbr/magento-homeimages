<?php
/**
 * @package     Igorludgero_Homeimages
 * @author      Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @copyright   Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Igorludgero_Homeimages_Helper_DataTest extends PHPUnit_Framework_TestCase
{

    public function testIdentifiers(){
        $helper = Mage::helper('homeimages');
        $identifiers = $helper->getAllIdentifiers();
        $this->assertNotNull($identifiers);
    }

    public function testImagesFromIdentifier(){
        $identifierName = "aaaa";
        $helper = Mage::helper('homeimages');
        $images = $helper->getImagesFromIdentifier($identifierName);
        $this->assertNotNull($images);
    }

}