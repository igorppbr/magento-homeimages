# Magento 1 Extension - Homeimages

Developed by Igor Ludgero Miura - https://www.igorludgero.com/

A free extension to add images in the Magento admin with an URL. You can use this extension to show some images in your homepage or any other page.

After you added your images you can get the images like that:

$identifiers = Mage::helper("homeimages")->getAllIdentifiers();

foreach($identifiers as $identifier){

   $images = Mage::helper("homeimages")->getImagesFromIdentifier($identifier);
   
}
