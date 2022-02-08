<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style>
		body {
			margin:0px;
		  	background: url('bg.jpg') no-repeat center center fixed;
		  	-webkit-background-size: cover;
		  	-moz-background-size: cover;
		  	background-size: cover;
		  	-o-background-size: cover;
		  	background-color: #fafafa;
		}

		hr {
            border: 1px solid #CCCCCC;
		}

        table {
            border-collapse: collapse;
            border: 1px solid grey;
            width: 100%;
        }

        th {
            border: 1px solid #CCCCCC;
            background: #EAEAEA;
            padding: 9px 15px;
        }

        td {
            border: 1px solid #E2E2E2;
            padding: 9px 15px;
        }
 		a {
 			color:#337ab7;
 			text-decoration:none;
 		}
 		a:focus,a:hover {
 			color:#23527c;
 			text-decoration:underline;
 		}
 		.container {
 			width: 960px;
 			margin: 0px auto;
 			background: #ffffff;
 			padding: 9px 15px;
 		}
 		.blueButton {
			box-shadow: 0px 0px 0px 2px #9fb4f2;
			background: linear-gradient(to bottom, #7892c2 5%, #476e9e 100%);
			background-color: #7892c2;
			border-radius: 10px;
			border: 1px solid #4e6096;
			display: inline-block;
			cursor: pointer;
			color: #ffffff;
			font-family: Arial;
			font-size: 19px;
			padding: 12px 37px;
			text-decoration: none;
			text-shadow: 0px 1px 0px #283966;
		}
		.blueButton:hover {
			background: linear-gradient(to bottom, #476e9e 5%, #7892c2 100%);
			background-color: #476e9e;
			color: #ffffff;
		}
		.blueButton:active {
			position: relative;
			top: 1px;
		}
		.orangeButton {
			box-shadow:inset 0px 1px 0px 0px #fff6af;
			background:linear-gradient(to bottom, #ffec64 5%, #ffab23 100%);
			background-color:#ffec64;
			border-radius:6px;
			border:1px solid #ffaa22;
			display:inline-block;
			cursor:pointer;
			color:#333333;
			font-family:Arial;
			font-size:15px;
			font-weight:bold;
			padding:6px 24px;
			text-decoration:none;
			text-shadow:0px 1px 0px #ffee66;
		}
		.orangeButton:hover {
			background:linear-gradient(to bottom, #ffab23 5%, #ffec64 100%);
			background-color:#ffab23;
		}
		.orangeButton:active {
			position:relative;
			top:1px;
		}
		.exitButton {
			box-shadow: 0px 1px 0px 0px #f0f7fa;
			background:linear-gradient(to bottom, #33bdef 5%, #019ad2 100%);
			background-color:#33bdef;
			border-radius:6px;
			border:1px solid #057fd0;
			display:inline-block;
			cursor:pointer;
			color:#ffffff;
			font-family:Arial;
			font-size:15px;
			font-weight:bold;
			padding:6px 24px;
			text-decoration:none;
			text-shadow:0px -1px 0px #5b6178;
		}
		.exitButton:hover {
			background:linear-gradient(to bottom, #019ad2 5%, #33bdef 100%);
			background-color:#019ad2;
		}
		.exitButton:active {
			position:relative;
			top:1px;
		}
		.greenButton {
			box-shadow:inset 0px 1px 0px 0px #caefab;
			background:linear-gradient(to bottom, #77d42a 5%, #5cb811 100%);
			background-color:#77d42a;
			border-radius:6px;
			border:1px solid #268a16;
			display:inline-block;
			cursor:pointer;
			color:#306108;
			font-family:Arial;
			font-size:15px;
			font-weight:bold;
			padding:6px 24px;
			text-decoration:none;
			text-shadow:0px 1px 0px #aade7c;
		}
		.greenButton:hover {
			background:linear-gradient(to bottom, #5cb811 5%, #77d42a 100%);
			background-color:#5cb811;
		}
		.greenButton:active {
			position:relative;
			top:1px;
		}

    </style>
</head>
<body>
<div class="container">
<a class="blueButton" href="/">Главная</a>
<hr>
<?php

if (!empty($_SESSION['message'])) {
    echo htmlspecialchars($_SESSION['message']) . '<hr>';
    unset($_SESSION['message']);
}