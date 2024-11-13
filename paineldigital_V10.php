<?php 
session_start(); # Deve ser a primeira linha do arquivo
echo extension_loaded('pgsql') ? 'yes':'no';
include("dbconfigMob.php");
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title></title>
		<meta charset="utf-8">
		<!-- Bootstrap CSS file -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" />	
	</head>
	<body id="">
	   <!-- Jquery and Bootstrap Script files -->
		<script src="jquery/jquery-1.8.3.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>

	  <body>
		<style> 
		  marquee {
			width: 110%;
			padding: 5px 0;
			background-color: lightblue;
		  }
		</style>
		<marquee direction="scroll">Obrigado pela preferencia.</marquee>
	  </body>

		<head>
			<style>
			.newspaper {
			  column-count: 2;
			  column-gap: 100px;
			  column-rule-style: solid;
			  column-rule-width: 5px;
			  column-rule-color: lightblue;
			  column-width: 200px;
			  font-size:260%;
			}
			</style>
		</head>

	<!--
	<div class="newspaper1"> 
	<div class="">
	-->
	<div class="">
		<!--<h4>  Tabela de preço</h4>-->
		<form role="form" class="clearfix" action="" method="post">
			<?php
				if ( !empty($_POST)) 
				{
					// keep track validation errors
					$codigoError = null;

					// keep track post values
					$codigo = $_POST['codigo'];
					$_SESSION['setor'] = $codigo;

					// validate input
					$valid = true;
					if (empty($codigo)) {
						$codigoError = 'Favor informar o setor.';
						$valid = false;
					}

					// update data
					if ($valid) {
									
						//$sql = "SELECT * FROM produto where cod_barra = '$codigo' ";
						$sql = "select 
		contador
		,cod_setor
		,nome
		,preco_venda
		,peso_unidade
		,cod_barra
	from produto
	where cod_setor='$codigo'";
						// Execulta consulta
						$result  = pg_query($dbconfig, $sql);
						$numrows = pg_num_rows($result);
						$line    = pg_fetch_array($result, 0, PGSQL_ASSOC);

						// Alimenta variaveis
						$codBarra = $line['cod_barra'];
echo "cod.barra: ".$codBarra;						
						//print_r($codBarra);

					}
				}
			?>
			
			<label>Setor:</label>
			<input name="codigo" type="text"> 
			<button type="submit" class="frm-control btn btn-primary">Pesq.</button>     
			<!--
			-->
			<?php		
echo "codigo da tela: ".$codigo;
				if (empty($codigo)) {
					echo 'Favor informar o setor.';
					exit;
				}

				$result = pg_query($dbconfig, "SELECT * FROM setor where cod_setor='$codigo'") or die('Query failed: ' . pg_last_error());
				if (!$result) {
					echo "Um erro ororreu.\n";
					exit;
				}

				if (pg_num_rows($result) == 0) {
					echo "Setor inexistente";
					exit;
				}

				echo "inicio";
				$row = pg_fetch_array($result);
				echo "Setor: ".$row["descricao"];
				echo "codigo: ".$row["cod_setor"];
				echo "verificar0";
				//echo $row[cod_setor].'-'.$row["descricao"];
				echo "verificar";
			?>				
				
			<?php
echo "cod: ".$codigo;			
				echo "<br>";
				$codigo   = $_POST['codigo'];
							echo '<tr>';
							echo '<td><a class="btn btn-success" href="paineldigital_lista_v2.php?codigo='.$codigo.'">Listar</a></td>';
							echo '</tr>';				
			?>			
				</br>
		</form>
	</body>
</html>