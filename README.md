# Magento 1 Extension - Homeimages - Developed by Igor Ludgero Miura - https:www/igorludgero.com/
A free extension to add images in the Magento admin with an URL. You can use this extension to show some images in your homepage or any other page.

After you added your images you can get the images like that:

<?php

$identifiers = Mage::helper("homeimages")->getAllIdentifiers();

?>

<ul>
    <? foreach($identifiers as $identifier){
        $images = Mage::helper("homeimages")->getImagesFromIdentifier($identifier);
        if($images['image'] != "" && $images['image_over'] != ""){
            ?>
            <li>
                <div>
                    <a href="<?php echo $images['image_url']; ?>"><img class="imagem1" alt="" src="<?php echo $images['image']; ?>"></a>
                    <a href="<?php echo $images['image_over_url']; ?>"><img class="imagem2" alt="" src="<?php echo $images['image_over']; ?>"></a>
                </div>
            </li>
            <?php
        }
    }
    ?>
</ul>
