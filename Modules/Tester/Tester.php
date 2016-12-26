<?php
include_once 'modules/Vtiger/CRMEntity.php';
class Tester extends Vtiger_CRMEntity {
		//таблица с полями Модуля
          var $table_name = 'vtiger_tester';
		  //название ключевого поля в таблице 
          var $table_index = 'testerid';
		 // указывается таблица для поддержки пользовательских полей:
		  var $customFieldTable = Array(
		  'vtiger_testercf',
		  'vtiger_tester',
		
		  );
		  
		  // указывается с какими таблицами работает данный модуль:
		  var $tab_name = Array('vtiger_crmentity', 'vtiger_tester', 'vtiger_testercf');

		  // указываются ключевые поля таблиц:
				  
		 var $tab_name_index = Array(
		  'vtiger_crmentity' => 'crmid',
		  'vtiger_tester' => 'testerid',
		  'vtiger_testercf' => 'testerid',
		  );
		
		
		
		
		
		/////////////////////////////////////////////////////////
		/* Format: Field Label => Array(tablename, columnname) */
                // tablename should not have prefix 'vtiger_'
		var $list_fields = Array ( 
		'Amount'=> Array('tester','amount'),
		'Assigned To' => Array('crmentity','smownerid'),
		);
		
		
		 /* Format: Field Label => fieldname */
		var $list_fields_name = Array ( 
		'Amount'=>'amount',
		'Assigned To' => 'assigned_user_id',
		);
			   
			  ////////////////////////////// 
			  // For Popup listview and UI type support
			   var $search_fields = Array(
                /* Format: Field Label => Array(tablename, columnname) */
                // tablename should not have prefix 'vtiger_'
                'Amount'=> Array('tester','amount'),
				'Assigned To' => Array('vtiger_crmentity','assigned_user_id'),
        );
		
        var $search_fields_name = Array (
                /* Format: Field Label => fieldname */
                'Amount'=>'amount',
				'Assigned To' => 'assigned_user_id',
        );
			   
			   
			   // For Popup window record selection
        var $popup_fields = Array ('amount');
			   
			   // For Alphabetical search
        var $def_basicsearch_col = 'amount';

        // Column value to use on detail view record text display
        var $def_detailview_recname = 'amount';
			   
			   
		
		// Used when enabling/disabling the mandatory fields for the module.
        // Refers to vtiger_field.fieldname values.
        var $mandatory_fields = Array(
		'amount',
		'assigned_user_id'
		);
		
		 var $default_order_by = 'amount';
         var $default_sort_order='ASC';
		//
	function vtlib_handler($moduleName, $eventType) {
    global $adb;
    if($eventType == 'module.postinstall') {
        // TODO Handle actions after this module is installed.
    } else if($eventType == 'module.disabled') {
        // TODO Handle actions before this module is being uninstalled.
    } else if($eventType == 'module.preuninstall') {
        // TODO Handle actions when this module is about to be deleted.
    } else if($eventType == 'module.preupdate') {
        // TODO Handle actions before this module is updated.
    } else if($eventType == 'module.postupdate') {
        // TODO Handle actions after this module is updated.
    }
}
		//
		
		
		function save_module($module) { 
		global $adb;
						
				//reqtable
			$qtyStock = $_REQUEST['amount']; 		 $actid = $_REQUEST['productID'];
			$qtyStock2 = $_REQUEST['Amountofneed'];  $needProduct2 =$_REQUEST['productneededID'];
			$qtyStock3 = $_REQUEST['Amountofneed2']; $needProduct3 =$_REQUEST['productneededID2'];
			
			//dataproductsselect
			 $dasBase = 'vtiger3'; 
	  $linkinpark = mysql_connect('localhost','root','Pilot');
	  mysql_select_db( $dasBase ,$linkinpark);
	  $quaryMine = "SELECT qtyinstock FROM vtiger_products WHERE productid=".$actid;
	  
	  $resultMine = mysql_query($quaryMine);
	   $fetched_one=mysql_fetch_row($resultMine);
	
	  $Sum1 = $qtyStock+$fetched_one[0];
	
	 
	  //
	  $quaryMine2 = "SELECT qtyinstock FROM vtiger_products WHERE productid=".$needProduct2;
	  
	  $resultMine2 = mysql_query($quaryMine2);
	   $fetched_one2=mysql_fetch_row($resultMine2);

	  $min2 = $fetched_one2[0] - $qtyStock2;
	  
	  //
	  $quaryMine3 = "SELECT qtyinstock FROM vtiger_products WHERE productid=".$needProduct3;
	  
	  $resultMine3 = mysql_query($quaryMine3);
	   $fetched_one3=mysql_fetch_row($resultMine3);
	 
	  
	  $min3 =$fetched_one3[0] - $qtyStock3;
	  //
	  
	
	  //
	  $mysql="update vtiger_products set qtyinstock=".$Sum1." where productid=".$actid;
	  $mysql2="update vtiger_products set qtyinstock=".$min2." where productid=".$needProduct2;
	  $mysql3="update vtiger_products set qtyinstock=".$min3." where productid=".$needProduct3;
	  mysql_query($mysql); mysql_query($mysql2); mysql_query($mysql3);
   
	   mysql_close($linkinpark);
			

		
			
		}

}