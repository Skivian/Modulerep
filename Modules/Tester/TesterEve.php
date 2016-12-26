
<?php 
class TesterEve extends VTEventHandler {

function handleEvent($eventName, $data) 
{

    if($eventName == 'vtiger.entity.aftersave')
			{
		
			
		$dascase = 'vtiger3'; 
	  $linkinspark = mysql_connect('localhost','root','Pilot');
		mysql_select_db( $dascase ,$linkinspark);
		
		$mysqlqueFIRST = "SELECT MAX(testerid) FROM vtiger_tester";
		$idresultFIRST = mysql_query($mysqlqueFIRST);
			$fetched_onesFIRST=mysql_fetch_row($idresultFIRST);
			$whutFIRST = $fetched_onesFIRST[0];
		
		
		$mysqlqueid = "SELECT productID FROM vtiger_tester WHERE testerid=".$whutFIRST;
			$idresult = mysql_query($mysqlqueid);
			$fetched_onesid=mysql_fetch_row($idresult);
			$whut = $fetched_onesid[0];
			
		$mysqlque = "SELECT productname FROM vtiger_products WHERE productid=".$whut;
		
		$resultMines =mysql_query($mysqlque);
		$fetched_ones=mysql_fetch_row($resultMines);
		
		$what=$fetched_ones[0];
		
		$mysqlquea = "UPDATE vtiger_tester SET textname=\"".$what."\" WHERE testerid=".$whutFIRST;
		
		mysql_query($mysqlquea);

	   mysql_close($linkinspark);
			
			
                 // Entity has been saved, take next action
            }
}



}