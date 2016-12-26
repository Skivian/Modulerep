<?php 
include_once 'vtlib/Vtiger/Module.php';
//aftersave events start
      include_once('vtlib/Vtiger/Event.php');
Vtiger_Event::register('Tester', 'vtiger.entity.aftersave', 'TesterEve', 'modules/Tester/TesterEve.php');
//aftersave events end
	  
	   $Vtiger_Utils_Log = true;
  
      $MODULENAME = 'Tester';

      $moduleInstance = new Vtiger_Module();
      $moduleInstance->name = $MODULENAME;
      $moduleInstance->parent = 'Tools';
      $moduleInstance->save();
      $moduleInstance->initTables();
  
		$info_block = new Vtiger_Block();
      $info_block->label = 'LBL_' . strtoupper($moduleInstance->name) . '_MAIN';
      $moduleInstance->addBlock($info_block);
	  
	  //1 line
	  $name_filed = new Vtiger_Field();
      $name_filed->name = 'amount';
      $name_filed->label = 'Amount';
      $name_filed->uitype = 2;
      $name_filed->summaryfield =1;
      $name_filed->column = $name_filed->name;
      $name_filed->columntype = 'INT(100)';
      $name_filed->typeofdata = 'I~M';
      $info_block->addField($name_filed);
      $moduleInstance->setEntityIdentifier($name_filed);
	  
	  
	  
  
      $order_field = new Vtiger_Field();
      $order_field->name = 'productID';
      $order_field->label = 'Product ID';
      $order_field->uitype = 10;
      $order_field->summaryfield =1;
      $order_field->column = $order_field->name;
      $order_field->columntype = 'VARCHAR(100)';
      $order_field->typeofdata = 'V~M';
      $info_block->addField($order_field);
      $order_field->setRelatedModules(Array('Products'));
	  $moduleInstance->setEntityIdentifier($order_field);
  
     //2 line
  
      $Field_amount1 = new Vtiger_Field();
      $Field_amount1->name = 'Amountofneed';
      $Field_amount1->label = 'Amount needed';
      $Field_amount1->uitype = 2;
      $Field_amount1->summaryfield =1;
      $Field_amount1->column = $Field_amount1->name;
      $Field_amount1->columntype = 'INT(100)';
      $Field_amount1->typeofdata = 'I~M';
      $info_block->addField($Field_amount1);
     
	  
	  
	  $Field_need_product = new Vtiger_Field();
      $Field_need_product->name = 'productneededID';
      $Field_need_product->label = 'Product need';
      $Field_need_product->uitype = 10;
      $Field_need_product->summaryfield =1;
      $Field_need_product->column = $Field_need_product->name;
      $Field_need_product->columntype = 'VARCHAR(100)';
      $Field_need_product->typeofdata = 'V~M';
      $info_block->addField($Field_need_product);
      $Field_need_product->setRelatedModules(Array('Products'));
	  
	//3 line
	
      $Field_amount2 = new Vtiger_Field();
      $Field_amount2->name = 'Amountofneed2';
      $Field_amount2->label = 'Amount needed2';
      $Field_amount2->uitype = 2;
      $Field_amount2->summaryfield =1;
      $Field_amount2->column = $Field_amount2->name;
      $Field_amount2->columntype = 'INT(100)';
      $Field_amount2->typeofdata = 'I~M';
      $info_block->addField($Field_amount2);
      
	  
	  
	  $Field_need_product2 = new Vtiger_Field();
      $Field_need_product2->name = 'productneededID2';
      $Field_need_product2->label = 'Product need2';
      $Field_need_product2->uitype = 10;
      $Field_need_product2->summaryfield =1;
      $Field_need_product2->column = $Field_need_product2->name;
      $Field_need_product2->columntype = 'VARCHAR(100)';
      $Field_need_product2->typeofdata = 'V~M';
      $info_block->addField($Field_need_product2);
      $Field_need_product2->setRelatedModules(Array('Products'));
	  
	  //4 line
	    $mfield1 = new Vtiger_Field();
        $mfield1->name = 'assigned_user_id';
        $mfield1->label = 'Assigned To';
        $mfield1->table = 'vtiger_crmentity';
        $mfield1->column = 'smownerid';
        $mfield1->uitype = 53;
        $mfield1->typeofdata = 'V~M';
        $info_block->addField($mfield1);

        $mfield2 = new Vtiger_Field();
        $mfield2->name = 'CreatedTime';
        $mfield2->label= 'Created Time';
        $mfield2->table = 'vtiger_crmentity';
        $mfield2->column = 'createdtime';
        $mfield2->uitype = 70;
        $mfield2->typeofdata = 'T~O';
        $mfield2->displaytype= 2;
        $info_block->addField($mfield2);

        $mfield3 = new Vtiger_Field();
        $mfield3->name = 'ModifiedTime';
        $mfield3->label= 'Modified Time';
        $mfield3->table = 'vtiger_crmentity';
        $mfield3->column = 'modifiedtime';
        $mfield3->uitype = 70;
        $mfield3->typeofdata = 'T~O';
        $mfield3->displaytype= 2;
        $info_block->addField($mfield3);
		//
		$moduleInstance = Vtiger_Module::getInstance('Tester');
		$accountsModule = Vtiger_Module::getInstance('Products');
		$relationLabel = 'Products';
		$moduleInstance->setRelatedList( $accountsModule, $relationLabel, Array('ADD','SELECT') );
		//invisible text
		$name_txt_field =new Vtiger_Field();
      $name_txt_field->name = 'textname';
      $name_txt_field->label = 'Text name';
      $name_txt_field->uitype = 1;
      $name_txt_field->summaryfield =1;
      $name_txt_field->column = $name_txt_field->name;
      $name_txt_field->columntype = 'VARCHAR(100)';
      $name_txt_field->typeofdata = 'V~O';
	  $name_txt_field->displaytype= 2;//set 2 for invisible text, 1 for visible
      $info_block->addField($name_txt_field);
     
	  
	  //second block
      $description_block = new Vtiger_Block();
      $description_block->label = 'LBL_' . strtoupper($moduleInstance->name) . '_DESCRIPTION';
      $moduleInstance->addBlock($description_block);
  
      $description_field = new Vtiger_Field();
      $description_field->name = 'description';
      $description_field->label = 'Description';
      $description_field->column = $description_field->name;
      $description_field->columntype = 'VARCHAR(255)';
      $description_field->uitype = 19;
      $description_field->typeofdata = 'V~O';
      $description_block->addField($description_field);
	  
	   $filter1 = new Vtiger_Filter();
	   $filter1->name = 'All';
	   $filter1->isdefault = true;
	   $moduleInstance->addFilter($filter1);
	    $filter1->addField($name_filed)->addField($name_txt_field, 1);
		//$filter1->addField($name_filed)->addField($order_field, 1)->addField($name_txt_field, 2);
	  
	   //настройка совместного доступа (права доступа устанавливаются по умолчанию). 
      $moduleInstance->setDefaultSharing();
  
      //инициализация Веб-сервиса (автоматический вызов API)
      $moduleInstance->initWebservice();   
	  
	  echo "Done!";