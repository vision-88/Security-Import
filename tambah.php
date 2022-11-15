<!DOCTYPE html>
<html>

<head>
<title>Tambah Data</title>
    
<link rel="stylesheet" href="css/bootstrap.css" />	

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	

<!-- PANGGIL CSV-->
<link rel="stylesheet" href="css/0-dummy.css"/>
<script defer src="1-read-csv.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>  
<?php
$tgl = date('Y-m-d');
?>
<!-- Nav -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
			    <a class="navbar-brand hidden-xs" href="index.php">
				  <div class="float-right">&nbsp;<strong>Checkpoint Security Import</strong></div>
				  <div class="clear-both"></div>
			    </a>		
</nav><br>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">

<div class="form-group">
<form action="simpan.php" method="POST" enctype="multipart/form-data">
	<div class="modal-footer">		

	<button id="btn" type="submit" name="simpan" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ingin menambahkan data ini');" >Upload</button>
		 <a href="formatcsv/Format.csv" download="Format.csv">
  			<button  type ="button" class="btn btn-success" alt="checkpoint.csv" width="104" height="142">Download Format csv</button></a>
			<a href="index.php">
			<button type="button" class="btn btn-danger"  data-dismiss="modal">Back</button>
            </a>
		</div>

		<div class="modal-body"	>
			<label for ="site">Sites</label>
				<select name="site" id="site" class="form-control" required="true" style="height : 30px !important;">
					<option >--Select Site--</option>
					<option value="M-SKB">M-SKB</option>
					<option value="M-TGR">M-TGR</option>
					<option value="L-MJL">L-MJL</option>
				</select></br>
			
			<!-- (A) PICK CSV FILE -->
			<input type="file"  name="csv" required="true" accept=".csv" id="demoPick"/>

			<div class="panel-body">
											<input type="hidden" name="uploaddate" class="form-control" value="<?php echo $tgl;?>">
								</div>
			</br>
			</br>
			<center><table id="demoTable"></table></center>
			</div>
		</div>	
	</div>
</div>	
	</form>
		</div>
	</div>
</div>
</body>
</html>