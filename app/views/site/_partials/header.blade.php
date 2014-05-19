<?php 
use \App\Models\Settings;

$settings = Settings::find(1); 
$department = $settings->depart;
if ($department == 0) { $title = "Ústavy FEI";}
if ($department == 21030642) { $title = "UAMT FEI STU";}
if ($department == 21030548) { $title = "UAEA FEI STU";}
if ($department == 21030549) { $title = "UEF FEI STU";}
if ($department == 21030550) { $title = "UE FEI STU";}
if ($department == 21030816) { $title = "UIM FEI STU";}
if ($department == 21030817) { $title = "UJFI FEI STU";}
if ($department == 21030356) { $title = "URK FEI STU";}
if ($department == 21030818) { $title = "UT FEI STU";}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ $title }}</title>
	<link rel="stylesheet" href="{{{ URL::to($settings->style) }}}">
</head>
<body>
<div id="layout">
	<header id="header">
		@include('site._partials.navigation')
	</header>


