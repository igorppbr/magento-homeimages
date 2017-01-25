<?php

/**
 * @package     Igorludgero_Homeimages
 * @author      Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @copyright   Igor Ludgero Miura - https://www.igorludgero.com/ - igor@igorludgero.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$installer = $this;
$installer->startSetup();

//Create homeimages images table
$table = $installer->getConnection()
    ->newTable($installer->getTable('igorludgero_homeimages_images'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'ID')
    ->addColumn('image_path', Varien_Db_Ddl_Table::TYPE_VARCHAR, 0, array(
        'nullable'  => false,
    ), 'Path of image inside media folder')
    ->addColumn('identifier', Varien_Db_Ddl_Table::TYPE_VARCHAR, 0, array(
        'nullable'  => false,
    ), 'Identifier to agroup the similar images (2 types)')
    ->addColumn('type', Varien_Db_Ddl_Table::TYPE_INTEGER, 0, array(
        'nullable'  => false,
    ), 'Type of image (If will be showed on mouse over or not)')
    ->addColumn('url', Varien_Db_Ddl_Table::TYPE_VARCHAR, 0, array(
        'nullable'  => false,
    ), 'The Image URL');

$installer->getConnection()->createTable($table);

$installer->endSetup();