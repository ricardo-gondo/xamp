<?php 
//session_start(); # Deve ser a primeira linha do arquivo
//echo $_SESSION['setor'];

include("dbconfigMob.php");
error_reporting(0);
?>

<style> 
  marquee {
	width: 100%;
	padding: 5px 0;
	background-color: lightblue;
  }
</style>
<marquee direction="scroll" SCROLLDELAY=200 >Software Seculo XXI - Contato: 3045-3527</marquee> 

<tbody>
<?php
header("Refresh:60");	
$codigo = $_REQUEST['codigo'];			
echo "codigo:".$codigo;
//$result = pg_query($dbconfig, "SELECT * FROM poduto order by nome") or die('Query failed: ' . pg_last_error());
                        $sql = "select 
	cod_barra
	,cod_setor
	,nome
	,preco_venda
	,peso_unidade
from produto
where cod_setor='$codigo'
--and nome like 'A%'
order by nome
limit 54
";
                        //echo $sql;
                        $result=pg_query($dbconfig,$sql);
$i = 0;
// Establish the output variable
//$dyn_table = '<table border="2" cellpadding="10" width="1265">';
$dyn_table = '<table border="2" cellpadding="7" width="1265">';
echo "inicio";
while($row = pg_fetch_array($result)){ 
echo "achou";
    $id = $row["id"];
    $nome_name = $row["nome"];
echo "nome: ".$row["nome"];	
    $preco_name = $row["preco_venda"];
echo "preco: ".$row["preco_venda"];
    //$tamanho = strlen(preco_name);
    //$tamanho = strlen("preco_name");
    //$tamanho = strlen(strval(preco_name));
//echo "tamanho: "$tamanho;
echo "inicio";	
    if ($i % 3 == 0) { // if $i is divisible by our target number (in this case "3")
        $dyn_table .= '<tr><td>' . substr($nome_name,0,33) . '</td>' . '<td>'."R$ " . str_pad(number_format($preco_name,2,',',''),07,'.',STR_PAD_LEFT) . '</td>';
echo "preco1: ".$row["preco_venda"];
    } else {
        $dyn_table .= '<td>' . substr($nome_name,0,33) . '</td>' . '<td>'."R$ " . str_pad(number_format($preco_name,2,',',''),07,'.',STR_PAD_LEFT) . '</td>';
echo "preco2: ".$row["preco_venda"];
    }
    $i++;
echo "preco3: ".$row["preco_venda"];
echo "fim";
}
$dyn_table .= '</tr></table>'; 
?>
<?php echo $dyn_table; ?>                                                    
</tbody>

<p>Aguarde 40 segundos para iniciar slides</p>
<script type="text/javascript">
	setTimeout(function() {
		window.location.href = "slide_V2.php";
	}, 40000);
</script>

