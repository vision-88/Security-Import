<?php
    $serverName="117.102.117.180/SQLEXPRESS,41798";
    $uid = "ERP";
    $pwd = '123$qweRmCa2020';
    $connectionInfo = array( "UID"=>$uid,
                             "PWD"=>$pwd,
                             "Database"=>"dbsecurity",
                             "CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    if($conn){
echo "";
    }else{
        echo "koneksi gagal";
    }
?>
