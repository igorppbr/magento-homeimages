<?php

/**
 * @package     Igorludgero_Homeimages
 * @author      Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @copyright   Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Igorludgero_Homeimages_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * @description - Return all the home images inserted in the home images table on the database.
     * @return mixed - Return all the home images in the database table.
     */
    public function getAllHomeImages(){
        return Mage::getModel("homeimages/homeimages")->getCollection();
    }

    /**
     * @description - Return a random string
     * @param int $length - The random string length
     * @return string - The random string
     */
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @description - Return all identifiers string of all images saved.
     * @return array - Return all identifiers of images.
     */
    public function getAllIdentifiers(){
        $arrayIdentifiers = array();
        $collection = $this->getAllHomeImages();
        foreach ($collection as $image){
            if(in_array($image->getIdentifier(),$arrayIdentifiers) == false){
                $arrayIdentifiers[] = $image->getIdentifier();
            }
        }
        //Mage::log($arrayIdentifiers,null,"igor_homeimages.log");
        return $arrayIdentifiers;
    }

    /**
     * @description - Get the images url of identifier.
     * @param $identifier - The identifier image string.
     * @return array - The strings of url image and image mouse over.
     */
    public function getImagesFromIdentifier($identifier){
        $image = Mage::getModel("homeimages/homeimages")->getCollection()->addFieldToFilter("identifier",$identifier)->addFieldToFilter("type",1)->getFirstItem();
        $imageHover = Mage::getModel("homeimages/homeimages")->getCollection()->addFieldToFilter("identifier",$identifier)->addFieldToFilter("type",2)->getFirstItem();
        $imagesF = array(
            'image' => ($image!=null) ? $this->getImageUrl($image->getImagePath()) : '',
            'image_url' => ($image!=null) ? $image->getUrl() : '',
            'image_over' => ($imageHover!=null) ? $this->getImageUrl($imageHover->getImagePath()) : '',
            'image_over_url' => ($imageHover!=null) ? $imageHover->getUrl() : '',
        );
        //Mage::log($imagesF,null,"igor_homeimages.log");
        return $imagesF;
    }

    /**
     * @description - Get the URL of homeimage path.
     * @param $path - The image path string.
     * @return string - The full store image url.
     */
    public function getImageUrl($path){
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "homeimages" . DS . $path;
    }

}