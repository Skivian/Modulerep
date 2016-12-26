<?php
 class Tester_CheckBeforeSave_Action extends Vtiger_Action_Controller {
    function checkPermission(Vtiger_Request $request) {
         return;
     }
   
     public function process(Vtiger_Request $request) {
         $dataArr = (array)json_decode(urldecode($request->get('checkBeforeSaveData')));
         $response = "OK";
         $message = "";
		 //
		 $selected_amount1 = $dataArr['Amountofneed'];
		 $selected_amount2 = $dataArr['Amountofneed2'];
       
	   
	  //Get some amount of goods from "products"
	   $dasBase = 'vtiger3';
	  $linkin_park = mysql_connect('localhost','root','Pilot');
	  mysql_select_db( $dasBase ,$linkin_park);
	 
		$quaryMy1 = "SELECT qtyinstock FROM vtiger_products WHERE productid=".$dataArr['productneededID'];
	    $quaryMy2 = "SELECT qtyinstock FROM vtiger_products WHERE productid=".$dataArr['productneededID2'];
	   $resultMy1 = mysql_query($quaryMy1);
	   $resultMy2 = mysql_query($quaryMy2);
	   
	   $row1=mysql_fetch_row($resultMy1);
	   $row2=mysql_fetch_row($resultMy2);
	   
	   $resultMy1All = $row1[0] - $dataArr['Amountofneed'];
	   $resultMy2All = $row2[0] - $dataArr['Amountofneed2'];
   
   //$quaryMy12 = "SELECT productname FROM vtiger_products WHERE productid=".$dataArr['productID'];
    //$resultMy1 = mysql_query($quaryMy1);
	// $row1=mysql_fetch_row($resultMy1);
   
         if($request->get('EditViewAjaxMode')) { 
             $mode = $request->get('CreateMode');
             
             // On create or edit
             if (isset($mode) && (($mode == 'create') || ($mode == 'edit'))) {
               
				 if($resultMy1All >0 && $resultMy2All >0) {
					
					  $response = "CONFIRM";
                     $message = "Вы действительно хотите сохранить запись ?!"; 
                 }
				 if($dataArr['productneededID']==$dataArr['productneededID2'])
				 {
				 $response ="ALERT"; $message = "Выбранные товары из расхода - те же самые. Замените один из них.";
				 }
				 if($dataArr['productID']==$dataArr['productneededID2'] || $dataArr['productneededID']==$dataArr['productID'])
				 {
				 $response ="ALERT"; $message = "Один из выбранных для производства товаров совпадает с расходуемым. Замените один из них.";
				 }
                 if($resultMy1All < 0 || $resultMy2All < 0 ) { //change
                     $response ="ALERT";
                    $message = "Выбранное количество не подходит. ID1= ".$dataArr['productneededID']." and ID2= ".$dataArr['productneededID2']." so 1ROW= ".$row1[0]. " 2ROW= ".$row2[0]." На складе не хватает выбранного товара. А именно не хватает 1й Товар =".$resultMy1All." и 2й Товар =".$resultMy2All ;         
					//$message = "Выбранное количество не подходит. На складе не хватает выбранного товара." ;    					 
                 }                
             }
             echo json_encode(array("response" => $response, "message" => $message));
         }
         
         //Никакого окна подтверждения выведено не будет, карточка сохранится как обычно
         return; mysql_close($linkin_park);
     }
 }
 ?>