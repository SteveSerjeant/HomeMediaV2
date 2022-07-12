<?php
session_start();
session_destroy();
//direct back to index page
header('location: index.php');
