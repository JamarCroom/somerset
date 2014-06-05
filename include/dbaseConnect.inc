<?php
$db = new PDO("sqlite:./db/somersetDb.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>