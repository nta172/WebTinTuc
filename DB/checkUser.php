<?php 
 if(!$_SESSION['userAdmin']) {
     header('LOCATION: http://localhost/webtintuc/admin/');
 }
?>