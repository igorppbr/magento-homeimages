<?php
/**
 * @package     Igorludgero_Homeimages
 * @author      Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @copyright   Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Igorludgero_Homeimages_Block_Adminhtml_Homeimages_Edit_Form extends Mage_Adminhtml_Block_Widget_Form{

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        if (Mage::getSingleton('adminhtml/session')->getHomeimagesData()) {
            $data = Mage::getSingleton('adminhtml/session')->getHomeimagesData();
            Mage::getSingleton('adminhtml/session')->setHomeimagesData(null);
        } elseif (Mage::registry('homeimages_data')) {
            $data = Mage::registry('homeimages_data')->getData();
        }

        $fieldset = $form->addFieldset('salesoutside_form', array(
            'legend' => Mage::helper('homeimages')->__('Image Information')
        ));

        $fieldset->addField('id', 'hidden', array(
            'label' => Mage::helper('homeimages')->__('ID'),
            'required' => false,
            'name' => 'id',
            'value' => !empty($data) ? $data['id'] : ''
        ));

        $fieldset->addField('image_path', 'file', array(
            'label'     => Mage::helper('homeimages')->__('Image'),
            'required'  => false,
            'name'      => 'image_path',
            'required'  => empty($data) ? true : false
        ));

        $fieldset->addField('identifier', 'text', array(
            'label' => Mage::helper('homeimages')->__('Identifier'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'identifier',
            'value' => !empty($data) ? $data['identifier'] : ''
        ));

        $options = array(
            array('value' => 1, 'label' => Mage::helper("homeimages")->__("Normal")),
            array('value' => 2, 'label' => Mage::helper("homeimages")->__("On Mouse Over")),
        );
        $fieldset->addField('type', 'select', array(
            'label' => Mage::helper('homeimages')->__('Type'),
            'required' => true,
            'name' => 'type',
            'values' => $options,
            'value' => !empty($data) ? $data['type'] : ''
        ));

        $fieldset->addField('url', 'text', array(
            'label' => Mage::helper('homeimages')->__('URL'),
            'class' => 'required-entry validate-url',
            'required' => true,
            'name' => 'url',
            'value' => !empty($data) ? $data['url'] : ''
        ));

        return parent::_prepareForm();

    }
}