<?php
    require_once 'core.php';
    $sqls = "UPDATE product SET active='3' Where quantity <= 4";
    $result = $connect->query($sqls);