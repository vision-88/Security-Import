<!DOCTYPE html>
<html lang="en">
<head>
<title>Checkpoint Security Import</title>
<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/autonumber.css" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    
<link rel="icon" href="lyg.png">
<link rel="stylesheet" href="fontawesome/css/fontawesome.min.css" />
<link rel="stylesheet" href="fontawesome/css/fontawesome.min.css" />
<link rel="stylesheet" href="fontawesome/css/solid.css" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
  
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<!-- Datatable -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!-- Bootstrap Core CSS -->
<link href="libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="libs/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="libs/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="libs/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- jQuery -->
<script src="jquery/jquery.min.js"></script>

</head>
<body>
<?php 
include "koneksi.php";
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$tgl = "";
$tgl_to_date = "";

$queryCondition = "";
if(!empty($_POST["search"]["tgl"])) {			
	$tgl = $_POST["search"]["tgl"];
	list($fid,$fim,$fiy) = explode("-",$tgl);
	
	$tgl_todate = date('Y-m-d');
	if(!empty($_POST["search"]["tgl_to_date"])) {
		$tgl_to_date = $_POST["search"]["tgl_to_date"];
		list($tid,$tim,$tiy) = explode("-",$_POST["search"]["tgl_to_date"]);
		$tgl_todate = "$tiy-$tim-$tid";
	}	
	$queryCondition .= "WHERE tgl BETWEEN '$fiy-$fim-$fid' AND '" . $tgl_todate . "'";
}

else { $queryCondition .= "WHERE tgl = GETDATE() " ; 

}
$sql = "SELECT * from tblsecurity " . $queryCondition . " ORDER BY tgl desc";
$stmt = sqlsrv_query($conn,$sql);
?>
	<!-- Image and text -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
				    <a class="navbar-brand hidden-xs" href="index.php">
					  <div class="float-right">&nbsp;<strong>Checkpoint Security Import</strong></div>
					  <div class="clear-both">
			</div>	</a>		
</nav>

<div class="panel-body" >
<!-- Tanggal -->	
<label><?php echo date('l, Y-M-d');?></label>
</div>
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-body" >
<!--		Start BUTTON IMPORT -->
        <a href="tambah.php">
			<button style="margin-bottom: 20px; float: left;  " class ="btn btn-primary" > <i class="fa fa-plus"> Import Data</i>  </button>
			</a>   	
<!--		End Button import  -->
<!---------------------------------------------------------------------------->
	
<!--		Start Search Periode Tanggal -->		
<form class="form-inline" name="frmSearch" method="post" action="" style=" float: right;  " > 
<div class="form-group mb-2">
<p class="search_input">
<label class="col-sm-2 col-form-label">Period</label>
</div>
<div class="form-group mx-sm-3 mb-2">
<input type="date" class="form-control" placeholder="From Date" id="tgl" name="search[tgl]"  value="<?php echo $tgl; ?>" class="input-control" />
<input type="date" class="form-control"	 placeholder="To Date" id="tgl_to_date" name="search[tgl_to_date]" style="margin-left:10px"  value="<?php echo $tgl_to_date; ?>" class="input-control"  />			 
</div>
<input type="submit" class="btn btn-success"  name="go" value="Search" > &nbsp;
<input type="reset" class="btn btn-danger" value="Reset"onclick="window.location='index.php'">
</p>
</form>
<!--		End Search Periode Tanggal                                      -->
<!---------------------------------------------------------------------------->
<!--   		Start Tabel        -->
				<table class="table table-bordered"  id= "tabel-data" >
                    <thead>
                        <tr>
							<th>No.</th>
                            <th scope="col" width="">Sites</th>
                            <th scope="col" width="130px" >Date</th>
                            <th scope="col" width="">Event Type</th>
							<th scope="col" width="" >Event Details</th>
                            <th scope="col" width="130px" >Check Point</th>
							<th scope="col" width="" >Tour ID</th>
                            <th scope="col" width="" >Guard Name</th>
							<th scope="col" width="" >Image</th>
                            <th scope="col" width="" >Audio</th>
							<th scope="col" width="" >Video</th>
							<th scope="col" width="20px" >Action</th>
                        </tr>
                    </thead>
                    <tbody class="targetData" >
<?php
$no=0;
if(!empty($stmt))	 {  
	
while ($row = sqlsrv_fetch_array($stmt)) {
	$no++;

	// ganti 1&0 -> icon
	if ($row['img']==1){$ceklis ="&#10004";}
	else {$ceklis ="&#10006";}

	if ($row['audio']==1){$ceklis1 ="&#10004";}
	else {$ceklis1 ="&#10006";}

	if ($row['video']==1){$ceklis2 ="&#10004";}
	else {$ceklis2 ="&#10006";}
	//end baru
?>
					<tr>
					<td><center><?= $no;?></center></td>
					<td><?= $row['site'];?></td>
					<td><?= $row['tgl']->format('Y-m-d H:i:s');?></td>
					<td><?= $row['event_type'];?></td>
					<td><?= $row['event_details'];?></td>
					<td><?= $row['check_point'];?></td>
					<td><center><?= $row['tour_id'];?></center></td>
					<td><?= $row['guard_name'];?></td>
					<td><center><?= $ceklis;?></center></td>
					<td><center><?= $ceklis1;?></center></td>
					<td><center><?= $ceklis2;?></center></td>
					<td>
					<a href="#" class="badge badge-primary badge-pill tampilModalUbah"  
					data-toggle="modal" data-target="#myModal<?php echo $row['id']; ?>" >
					<i class="fa-solid fa-pen-to-square"></i></a>

					<a href="hapus.php?id=<?= $row['id']; ?>"  
					class="badge badge-primary badge-pill" 
					onclick="return confirm('Apakah anda yakin ingin menghapus data?');"><i class="fa-solid fa-trash"></i></a>
					</td>
<!-- Button untuk modal -->
<!-- Trigger the modal with a button -->

<!-- Modal Edit -->
<div class="modal fade" id="myModal<?php echo $row['id']; ?>" role="dialog" style="height : 9000px !important;" >
<div class="modal-dialog">
    
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<label>Edit Data</label>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>		
<div class=" modal-body" style="max-height: 540px; overflow-y: auto;">
<form role="form" action="update.php" method="POST">
<?php
$id = $row['id']; 
$query_view = sqlsrv_query($conn, "SELECT * FROM tblsecurity WHERE id='$id'");
while ($row = sqlsrv_fetch_array($query_view)) {
?>
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<div class="form-group"	>
			<label for ="site">Sites</label>
			<select name="site" id="site" 
			class="form-control" value="<?php echo $row['site']; ?>" required="true"style="height : 30px !important;">
				<option value = "<?php echo $row['site']; ?>"><?php echo $row['site']; ?></option>
				<option value="M-SKB">M-SKB</option>
				<option value="M-TGR">M-TGR</option>
				<option value="L-MJL">L-MJL</option>
			</select></br>
</div>

<div class="form-group">
  <label>Date</label>
  <input type="datetime2" name="tgl" class="form-control" value="<?= $row['tgl']->format('Y-m-d H:i:s');?>" >
</div>

<div class="form-group"	>
				<label for ="event_type">Event Type</label>
				<select name="event_type" id="event_type" 
					 class="form-control" value="<?php echo $row['event_type']; ?>" required="true"
					 style="height : 30px !important;">
						<option value = "<?php echo $row['event_type']; ?>"><?php echo $row['event_type']; ?></option>
						<option value="START">START</option>
          				<option value="TEST">TEST</option>
						<option value="FINISH">FINISH</option>
						<option value="MISSED SCAN">MISSED SCAN</option>
						<option value="MME">MME</option>
						<option value="CHECKPOINT SCAN">CHECKPOINT SCAN</option>
						<option value="INCIDENTS">INCIDENTS</option>
						<option value="MANDOWN">MANDOWN</option>
						<option value="SOS">SOS</option>  
				</select></br>
</div>
<div class="form-group">
  <label>Event Details</label>
  <input type="text" name="event_details" class="form-control" value="<?php echo $row['event_details']; ?>">      
</div>

<div class="form-group">
  <label>Checkpoint</label>
  <input type="text" name="check_point" class="form-control" value="<?php echo $row['check_point']; ?>">      
</div>

<div class="form-group">
  <label>Tour ID</label>
  <input type="text" name="tour_id" class="form-control" value="<?php echo $row['tour_id']; ?>">      
</div>

<div class="form-group">
  <label>Guard Name</label>
  <input type="text" name="guard_name" class="form-control" value="<?php echo $row['guard_name']; ?>">      
</div>

<div class="form-group"	>
				<label for ="img">Image</label>
				<select name="img" id="img" class="form-control" value="<?php echo $row['img']; ?>" required="true"
					style="height : 30px !important;">
					<option value = "<?php echo $row['img']; ?>"><?php echo $ceklis; ?></option>
					<option value="1">&#10004;</option>
					<option value="0">&#10006;</option>
				</select></br>
</div>

<div class="form-group"	>
				<label for ="audio">Audio</label>
				<select name="audio" id="audio" class="form-control" value="<?php echo $row['audio']; ?>" required="true"
					style="height : 30px !important;">
					<option value = "<?php echo $row['audio']; ?>"><?php echo $ceklis1; ?></option>
					<option value="1">&#10004;</option>
					<option value="0">&#10006;</option>
				</select></br>
</div>
<div class="form-group"	>
				<label for ="video">Video</label>
				<select name="video" id="video" class="form-control" value="<?php echo $row['video']; ?>" required="true"
					style="height : 30px !important;">
				<option value = "<?php echo $row['video']; ?>"><?php echo $ceklis2; ?></option>
				<option value="1">&#10004;</option>
				<option value="0">&#10006;</option>
				</select></br>
</div>
<div class="modal-footer">
  <button id="btn" type="submit" class="btn btn-success">Update</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
<?php 
}
?>        
</form>
</div>
</div>
</div>
</div>

<?php				
	}};
?>
		</tbody>
	</table> 
</div>
<!--    End Tabel        -->
</div>
</div>
</div>

</div>
</div>
</div>

<script type="text/javascript" src="jquery-3.2.1.js"></script>
<script src="js/jquery-3.6.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tabel-data').DataTable({
			"responsive": true,
			"processing": true,
			"columnDefs": [
				{ "orderable": false, "targets": [5] }
			]
		});
		$('#tabel-data').parent().addClass("table-responsive");
	});
</script>

</br></br>
<!-- Site footer -->
<footer class="site-footer">

</footer>

<!-- Start Alert Rubah Data -->
<script>
        $(document).ready(function () {
        $("#btn").click(function () {
            alert("Data Berhasil Di Rubah");
        	});
    	});
</script>
<!-- End Alert Rubah Data -->

<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('.datatab').DataTable();
  } );
//script tgl
function myFunction() {
  document.getElementById("tgl").value = "<?php echo date_format ($row['tgl'],'Y-m-d H:i:s'); ?>";
}
</script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$.datepicker.setDefaults({
showOn: "button",
buttonImage: "datepicker.png",
buttonText: "Date Picker",
buttonImageOnly: true,
dateFormat: 'dd-mm-yy'  
});
$(function() {
$("#tgl").datepicker();
$("#tgl_to_date").datepicker();
});
</script>

</body>
</html>