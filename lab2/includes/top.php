<?php
  session_start();
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf8" />
    
    <title>myLibrary<?php if($title) echo " - $title"; ?></title>
    
    <link rel="stylesheet" href="media/css/reset.css" type="text/css" media="screen" charset="utf8" />
    <link rel="stylesheet" href="media/css/master.css" type="text/css" media="screen" charset="utf8" />
  </head>
  
  <body>
    <div id="wrapper">
    	<div id="header">
        	<h1>myLibrary</h1>
        	<h2>Innovativ Programmering</h2>
        </div>
        <div id="menu">
        	<ul>
    	        <li><a href="menu1.php">Menyval 1</a> &bull; </li>
    	        <li><a href="menu2.php">Menyval 2</a> &bull; </li>
    	        <li><a href="menu3.php">Menyval 3</a> &bull; </li>
              <li><a href="menu4.php">Menyval 4</a></li>
            </ul>
        </div>
        <div id="content">