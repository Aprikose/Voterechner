<!DOCTYPE html> 
<html>
	<head>
		<style>
			body
			{
				background-color:#d8f5cf;
				font-family:"Andalus";
			}
			
			a
			{
				text-decoration: none;
			}
			
			.container
			{
				background-color:#e4fddb;
				padding: 19px;
				border-style:solid;
				border-width:1px;
				border-color:#85d66c;
				-webkit-border-radius: 20px;
				-moz-border-radius: 20px;
				border-radius: 20px;
			}
			
			.input
			{
				padding: 0px 0px 0px 50px;
			}
			
			.alert
			{
				background-color:#d8f5cf;
				border-style:solid;
				border-width:1px;
				border-color:#85d66c;
				width: 628px;
				-webkit-border-radius: 5px;
				-moz-border-radius: 5px;
				border-radius: 5px;
				padding: 5px 5px 5px 15px;
			}
			
			td
			{
				padding: 7px;
				text-align: center;
				font-size: 80%;
				border-style: solid;
				border-width: 1px;
				border-color: #85d66c;
			}
			
			h1
			{
				font-size: 130%;
				font-weight: bold;
				padding: 0px 0px 0px 15px;
				clear:both;
			}
			
			textarea
			{
				width:100%;
			}
			
			input
			{
				clear:both;
			} 

		</style>
	
		<meta charset="utf-8" />
		<title>FF-Voterechner V2.2</title>
		
	</head>
	
	<body>
		<div style="padding: 0px 25px;">
			<p>Willkommen beim <strong>FF-Voterechner V2.2</strong>.</p>
	
			<div class="container">

				<?php

					require ('_code/output.php');

					echo formOutput();
					
				?>
				
			</div>
		</div>
	</body>
</html>
