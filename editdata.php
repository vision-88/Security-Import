<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id'];
$site = $_GET['site'];
$tgl = $_GET['tgl'];
$event_type = $_GET['event_type'];
$event_details = $_GET['event_details'];
$check_point = $_GET['check_point'];
$tour_id = $_GET['tour_id'];
$guard_name = $_GET['guard_name'];
$img = $_GET['img'];
$audio = $_GET['audio'];
$video = $_GET['video'];

//query update
$queryupdate = mysqli_query($koneksi, "UPDATE tblsecurity 
SET site='$site' , tgl='$tgl' , event_type='$event_type' , event_details='$event_details' ,
check_point='$check_point' , tour_id='$tour_id' , guard_name='$guard_name' , img='$img' ,
audio='$audio' , video='$video' WHERE id='$id' ");

if ($queryupdate) {
	# credirect ke page index
	header("location:index.php");	
}
else{
	echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>
