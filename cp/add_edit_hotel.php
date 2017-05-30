<?php 
include("access.php");
if(isset($_POST['submitRoom'])){
	include("../includes/db.conn.php"); 
	include("../includes/conf.class.php");
	include("../includes/admin.class.php");
	$bsiAdminMain->add_edit_room();
	header("location:room_list.php");	
	exit;
}
include("header.php"); 
include("../includes/conf.class.php");
include("../includes/admin.class.php");
if(isset($_GET['rid']) && $_GET['rid'] != ""){
	$rid = $bsiCore->ClearInput($_GET['rid']);
	$cid = $bsiCore->ClearInput($_GET['cid']);
	if($rid != 0 && $cid != 0){
		$row = mysql_fetch_assoc(mysql_query($bsiAdminMain->getRoomsql($rid, $cid)));
		$rowrt = mysql_fetch_assoc(mysql_query($bsiAdminMain->getRoomtypesql($row['roomtype_id'])));
		$rowca = mysql_fetch_assoc(mysql_query($bsiAdminMain->getCapacitysql($row['capacity_id'])));
		$roomtypeCombo = $rowrt['type_name'].'<input type="hidden" name="roomtype_id" value="'.$row['roomtype_id'].'" />';
		$capacityCombo = $rowca['title'].'<input type="hidden" name="capacity_id" value="'.$row['capacity_id'].'" />';
	}else{
		$row = NULL;
		$roomtypeCombo = $bsiAdminMain->generateRoomtypecombo();
		$capacityCombo = $bsiAdminMain->generateCapacitycombo();
	}
}else{
	header("location:hotel_list.php");
	exit;
}
?>  
 <link rel="stylesheet" type="text/css" href="css/jquery.validate.css" />
      <div id="container-inside">
      <span style="font-size:16px; font-weight:bold">Hotel Add/Edit</span>
      <hr />
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="form1">
          <table cellpadding="5" cellspacing="2" border="0">
            <tr>
              <td><strong>Name</strong></td> 
              <td valign="middle"><input type="text" name="no_of_room" id="no_of_room" class="required char" value="<?=$row['NoOfRoom']?>" style="width:100px;" /></td><input type="hidden" name="pre_room_cnt" value="<?=$row['NoOfRoom']?>" />
            </tr>
            <tr>
              <td><strong>Location</strong></td>
              <td valign="middle"><input type="text" style="width:100px;" /></td>
            </tr>
            <tr>
              <td><strong>Phone</strong></td>
              <td valign="middle"><input type="text" style="width:100px;" /></td>
            </tr>
            <tr>
              <td></td>
              <td><input type="submit" value="<?php echo ADD_EDIT_SUBMIT; ?>" name="submitRoom" style="background:#e5f9bb; cursor:pointer; cursor:hand;" /></td>
            </tr>
          </table>
        </form>
      </div>
<script type="text/javascript">
	$().ready(function() {
		$("#form1").validate();
		
     });
         
</script>      
<script src="js/jquery.validate.js" type="text/javascript"></script>
<?php include("footer.php"); ?> 
