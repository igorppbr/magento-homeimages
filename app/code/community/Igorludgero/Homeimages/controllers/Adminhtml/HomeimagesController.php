<?php
/**
 * @package     Igorludgero_Homeimages
 * @author      Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @copyright   Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


class Igorludgero_Homeimages_Adminhtml_HomeimagesController extends Mage_Adminhtml_Controller_Action
{

    protected function _isAllowed()
    {
        return true;
        //return Mage::getSingleton('admin/session')->isAllowed('system/config/igorludgero_outside');
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('homeimages/igorludgero_homeimages_manage');
        $this->_addContent($this->getLayout()->createBlock('homeimages/adminhtml_homeimages'));
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('homeimages/adminhtml_homeimages_grid')->toHtml()
        );
    }

    public function massDeleteAction(){
        $ids = $this->getRequest()->getParam('image_id');
        if(!is_array($ids)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('homeimages')->__('Please select the home images.'));
        } else {
            try {
                $imagesModel = Mage::getModel('homeimages/homeimages');
                foreach ($ids as $id) {
                    $imagesModel->load($id)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('tax')->__(
                        'Total of %d record(s) were deleted.', count($ids)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

    public function newAction(){
        $this->_forward('edit');
    }

    public function editAction(){
        $homeImageId = $this->getRequest()->getParam('id');
        $model = Mage::getModel('homeimages/homeimages')->load($homeImageId);
        if ($model->getId() || $homeImageId == 0) {
            Mage::register('homeimages_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('homeimages/igorludgero_homeimages_manage');

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('homeimages/adminhtml_homeimages_edit'));
            $this->getLayout()->getBlock('head')->setTitle($this->__('Homeimages - Image'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('homeimages')->__("Home image don't exist.")
            );
            $this->_redirect('*/*/');
        }
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {

            $model = Mage::getModel("homeimages/homeimages");

            if($data["id"] != ""){
                $model->load($data["id"]);
            }

            $fname = "";
            $error = false;

            if (isset($_FILES['image_path']['name']) && $_FILES['image_path']['name'] != '' && $data["id"] == "") {
                try
                {
                    $path = Mage::getBaseDir('media').DS.'homeimages'.DS;  //destination directory
                    $array = explode('.', $_FILES['image_path']['name']);
                    $extension = end($array);
                    $fname = Mage::helper("homeimages")->generateRandomString(30).".".$extension; //file name
                    $uploader = new Varien_File_Uploader('image_path'); //load class
                    $uploader->setAllowedExtensions(array('JPG','JPEG','PNG','GIF','png','jpg','jpeg','gif')); //Allowed extension for file
                    $uploader->setAllowCreateFolders(true); //for creating the directory if not exists
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(false);
                    $uploader->save($path, $fname);
                }
                catch (Exception $e)
                {
                    $error = true;
                    Mage::getSingleton('adminhtml/session')->addError(
                        Mage::helper('homeimages')->__("Erro uploading the image. Error: ".$e->getMessage())
                    );
                    $this->_redirect('*/*/new');
                }
            }

            if($error == false) {

                if ($fname != "") {
                    $model->setImagePath($fname);
                }

                if ($model->setIdentifier($data['identifier'])->setType($data['type'])->setUrl($data['url'])->save()) {
                    Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('homeimages')->__("Image saved.")
                    );
                    $this->_redirect('adminhtml/homeimages/index/');
                } else {
                    Mage::getSingleton('adminhtml/session')->addError(
                        Mage::helper('homeimages')->__("Error saving the image. Check again the fields.")
                    );
                    $this->_redirect('*/*/new');
                }

            }

        }
        else{
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('homeimages')->__("Invalid Data.")
            );
            $this->_redirect('*/*/new');
        }
    }

    public function deleteAction(){
        $id = $this->getRequest()->getParam('id');
        if(isset($id)){
            $model = Mage::getModel('homeimages/homeimages')->load($id);
            if($model->getId()>0){
                if($model->delete()){
                    Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('homeimages')->__("Image Deleted.")
                    );
                    $this->_redirect('*/*/');
                }
                else{
                    Mage::getSingleton('adminhtml/session')->addError(
                        Mage::helper('homeimages')->__("Error trying to delete this image.")
                    );
                    $this->_redirect('*/*/edit');
                }
            }
            else{
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('homeimages')->__("Invalid data, please re-input the image values.")
                );
                $this->_redirect('*/*/edit');
            }
        }
        else{
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('homeimages')->__("Invalid data, please re-input the image values.")
            );
            $this->_redirect('*/*/edit');
        }
    }

}