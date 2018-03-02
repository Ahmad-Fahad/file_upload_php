<?php
		if (isset($_GET['fileid'])) {
	   $fileid = $_GET['fileid'];
			
 echo $fileid;
		  $sql = "DELETE FROM `file`
		  		  WHERE `id` = $fileid";
	  $deleted = $db->delete($sql);
	  if ($deleted) {
	  		echo "<script>alert('File deleted  successfully');</script>";
	  	}
	  	else{
	  		echo "<script>alert('File is not deleted  successfully');</script>";
	  	}
	  	
	  }

?>
