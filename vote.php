<?php
require_once('App/app.php');

$posts->vote($_GET['post'], $_GET['vote']);

redirect($_GET['page']."?id=".$_GET['post']);