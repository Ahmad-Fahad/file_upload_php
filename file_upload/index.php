<?php include "config/config.php"; ?>
<?php include "inc/header.php"; ?>
<?php include "delfile.php"; ?>
<div class="contentsection templete clear">
<div class="uploadsection  clear ">
  <h2>Upload Your File</h2>
  <?php
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			 $permitted = ["jpg","jpeg","png","gif","pdf","mp4","flv","avi"];
			 $filename  = $_FILES['filename']['name'];
			 $filesize  = $_FILES['filename']['size'];
		     $tmpname   = $_FILES['filename']['tmp_name'];
		     $div       = explode('.', $filename);
		     $file_ext  = strtolower(end($div));
		     $unique_name = substr(md5(time()),0,10).'.'.$file_ext; 
		   	 $foldername  = "upload/";
		   	 if (empty($filename)) {
		   	 	echo "Please, select a file to upload ";
		   	 }
		   	 elseif ($filesize > 5242880) {
		   	 	echo "Please, Select a file of 5 GP";
		   	 }
		   	 elseif (in_array($file_ext,$permitted) === false) {
		   	 	echo "You can upload only ".implode(',',$permitted);
		   	 }
		   	 else{
			move_uploaded_file($tmpname,$foldername.$unique_name);
			$qry    = "INSERT INTO `file`(`pathname`)
					   VALUES('$unique_name')";
			$result = $db->insert($qry);
			if($result){
				echo "<span color: #fff>Uploaded successfully</span><br>";
			}
			else{
				echo "<span color: #fff>Error</span><br>";
			}
		}
	}
?>
<?php
	 	$sql  = "SELECT * 
				 FROM `file`
				 ORDER BY `id` DESC
				 LIMIT 1";
	$lastfile = $db->select($sql);
	if ($lastfile) {
		while ($arrfile = $lastfile->fetch_assoc()) {
?>
	<br>
	<img height="200px" weight="250px" src="upload/"."<?php echo $arrfile['pathname']; ?>" alt="file">
	<br>
<?php
		}
	}
?>
	<form action="" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
	<table>
		<caption></caption>
		<thead>
			<tr>
				<th style = "color: #fff;"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><input type="file" name="filename"></td>
			</tr>
			<tr>
				<td><input type="submit" name="upload" value="Upload"></td>
			</tr>
		</tbody>
	</table>
	</form>
	</div>
	<div class="displaysection  clear">
		<h2>Your Uploaded Files</h2>
		<?php
			  $qry = "SELECT * 
			  		  FROM `file`
			  		  ORDER BY `id` DESC";
		  $result  =  $db->select($qry);
		  if($result){
		  	while ($arr = $result->fetch_assoc()) {
		?>
		<img src="upload/<?php echo $arr['pathname']; ?>" alt="file"><br>
		<a id="download" href="#">Download</a><a id="delete" href="?fileid=<?php echo $arr['id']; ?>">Delete</a><br>
		<?php
		  	}
		  }
		?>
	</div>
</div>
<div class="torch">
	<img src="style/torch.gif" alt="torch">
</div>
<?php include "inc/footer.php"; ?>
</body>
</html>