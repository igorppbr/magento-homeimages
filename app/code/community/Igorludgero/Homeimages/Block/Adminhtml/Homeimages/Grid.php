<?php
/**
 * @package     Igorludgero_Homeimages
 * @author      Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @copyright   Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Igorludgero_Homeimages_Block_Adminhtml_Homeimages_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('igorludgero_homeimages_homeimages');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('image_id');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('homeimages')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
            'confirm' => Mage::helper('homeimages')->__('Are you sure?')
        ));

        return $this;
    }

    protected function _prepareCollection()
    {
        $collection = Mage::helper("homeimages")->getAllHomeImages();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    protected function _prepareColumns()
    {
        $helper = Mage::helper('homeimages');

        $this->addColumn('id', array(
            'header' => $helper->__('ID'),
            'type'   => 'text',
            'index'  => 'id'
        ));

        $this->addColumn('image_path', array(
            'header' => $helper->__('Image'),
            'type'   => 'text',
            'index'  => 'image_path',
            'renderer' => 'Igorludgero_Homeimages_Block_Adminhtml_Homeimages_Grid_Renderer_Image'
        ));

        $this->addColumn('identifier', array(
            'header' => $helper->__('Identifier'),
            'type'   => 'text',
            'index'  => 'identifier'
        ));

        $this->addColumn('type', array(
            'header' => $helper->__('Type'),
            'type'   => 'text',
            'index'  => 'type',
            'renderer' => 'Igorludgero_Homeimages_Block_Adminhtml_Homeimages_Grid_Renderer_Type'
        ));

        $this->addColumn('url', array(
            'header' => $helper->__('URL'),
            'type'   => 'text',
            'index'  => 'url'
        ));

        $this->addColumn('action',
            array(
                'header'    => $helper->__('Edit'),
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => $helper->__('Edit'),
                        'url'     => array('base'=>'adminhtml/homeimages/edit/'),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false
            )
        );

        return parent::_prepareColumns();
    }

    /*protected function _preparePage()
    {
        $this->getCollection()
            ->joinAttribute('billing_city', 'customer_address/city', 'default_billing', null, 'left')
            ->joinAttribute('billing_region', 'customer_address/region', 'default_billing', null, 'left')
            ->joinAttribute('billing_country_id', 'customer_address/country_id', 'default_billing', null, 'left');
        return parent::_preparePage();
    }*/

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}