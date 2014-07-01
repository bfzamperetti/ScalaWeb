<div class="forms_capa" style="width: 780px;">
	<div class="titulo_form" style="width: 760px;"> Dados Recuperados. </div>
	<a href="index.php"><div class="voltar" style="top: 40px;"></div></a>
	<style>
		.titulo_rec_dados{
			font-size: 24px;
			color: #444;			
			margin-bottom: 5px;
		}
		
		.label{
			color: #999;
			font-size: 18px;
		}
		
		.dado{
			color: #222;
			font-size: 20px;
		}
		
		.invalido{
			color: #222;
			font-size: 18px;
			margin-top: 20px;
			position: relative;
		}
		
	</style>

<?php
	include_once('../INCLUDES/conecta.php');
	$sql = "SELECT * FROM usuario WHERE chave_senha = '".$_GET['k']."'";
	$qry = pg_query($sql);
	if($v = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){

	echo "
		<table>
			<tr>
				<td colspan=2> 
					<div class='titulo_rec_dados'>".$_str['lblDataOf']." ".$v['nome']."</div>
				</td>
			</tr>
			<tr>
				<td align='right' valign = 'top'>
					<span class='label'> ".$_str['lblLogin'].": </span> 
				</td>
				<td valign = 'top'>
					<span class='dado'> ".$v['nome']." </span>
				</td>
			</tr>
			<tr>
				<td align='right' valign = 'top'>
					<span class='label'> ".$_str['lblPassword'].": </span> 
				</td>
				<td valign = 'top'>
					<span class='dado'> ".$v['senha']." </span>
				</td>
			</tr>
			<tr>
				<td align='right' valign = 'top'>
					<span class='label'> ".$_str['lblEmail'].": </span> 
				</td>
				<td valign = 'top'>
					<span class='dado'> ".$v['email']." </span>
				</td>
			</tr>
			<tr>
				<td align='right' valign = 'top'>
					<span class='label'> ".$_str['lblCity'].": </span> 
				</td>
				<td valign = 'top'>
					<span class='dado'> ".$v['cidade']." </span>
				</td>
			</tr>
			<tr>
				<td align='right' valign = 'top'>
					<span class='label'> ".$_str['lblProfession'].": </span> 
				</td>
				<td valign = 'top'>
					<span class='dado'> ".$v['profissao']." </span>
				</td>
			</tr>
		</table>
		";
		$sql2 = "UPDATE usuario SET chave_senha = '".md5(uniqid(rand(), true))."' WHERE chave_senha = '".$_GET['k']."'";
		pg_query($sql2);	

	}
	else
	{
		echo "<span class='invalido'> ".$_str['expiredRecoverDataLink']." </span>";
	}
	
?>

</div>
