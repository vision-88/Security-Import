<?php
include "koneksi.php";
$uploaddate = date('Y-m-d');
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false ) {
    echo "Koneksi Gagal</br>";
    die( print_r( sqlsrv_errors(), true));
}

if (isset($_POST ['simpan'])) { 
$site = $_POST['site'];
$tg=$_POST['uploaddate'];

if ($_FILES['csv']['size'] > 0) {
    //get the csv file 
   $file = $_FILES['csv']['tmp_name']; 
    $handle = fopen($file, "r");
    $i = 0;
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    if ($i > 0) {

    $params = array();


    //if ( substr($data[6], 0, 1) == '?'){
    if($data[6]=="? |  |" ) {
    $img    = 1;
    $audio  = 0;
    $video  = 0;
    

    }elseif
    //( substr($data[6], 0, 3) == '?'){
    ($data[6]=="| ? |" ) {
    $img    = 0;
    $audio  = 1;
    $video  = 0;

    }elseif
    //( substr($data[6], 0, 6) == '?'){
    ($data[6]=="|  | ?" ) {
    $img    = 0;
    $audio  = 0;
    $video  = 1;
    }
    else{ $img = 0; $audio = 0; $video = 0;}

    

    $tsql = "Insert into tblsecurity (site,tgl,event_type,event_details,check_point,tour_id,guard_name,img,audio,video,uploaddate) 
    values('$site','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$img','$audio','$video','$tg')";
    $stmt = sqlsrv_query( $conn, $tsql, $params);}
    echo "<script type='text/javascript'>alert('Data Berhasil Diimport');window.location.href ='index.php';</script>";
    if( $stmt === false ) {
    
        echo "Error in executing query.</br>";
        die( print_r( sqlsrv_errors(), true));
    
    
    }
        $i++;
    }
}}    
header('location:index.php');
sqlsrv_free_stmt( $stmt);
sqlsrv_close( $conn);
?>