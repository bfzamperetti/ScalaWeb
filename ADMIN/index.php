<?php
session_start();
/* incluir paginas necessarias (nao mudar a ordem) */
include('../INCLUDES/conecta.php');
?>
<?php	

if ($_GET['query'] == 'usuarios'){
	$sql = 'SELECT * FROM usuario ORDER BY nome';
	$qry = pg_query($sql);
	$usuarios = array();
	for ($i = 0; $res = pg_fetch_array($qry, NULL, PGSQL_ASSOC); $i++)
		$usuarios[$i] = $res;
	
	//var_dump($data);
	echo "<table>
			   <tr>
					<td>Login</td>
					<td>Nome</td>
					<td>Senha</td>
					<td>Cidade</td>
					<td>Email</td>
					<td>Profissão</td>
					<td>Autorizado</td>
					<td>Comunicação Alternativa</td>
					<td>Local de Acesso</td>
				</tr>";
		foreach($usuarios as $object):
		?>
				   <tr>
					<td><?php echo $object['login']?></td>
					<td><?php echo $object['nome']?></td>
					<td><?php echo $object['senha']?></td>
					<td><?php echo $object['cidade']?></td>
					<td><?php echo $object['email']?></td>
					<td><?php echo $object['profissao']?></td>
					<td><?php echo $object['autorizado']?></td>
					<td><?php echo $object['comunicacao_alternativa']?></td>
					<td><?php echo $object['local']?></td>
				</tr>
	<?php 
		endforeach;
		  echo "</table>";	
}

if ($_GET['query'] == 'emails'){
	$sql = 'SELECT email FROM usuario ORDER BY email';
	$qry = pg_query($sql);
	$email = array();
	for ($i = 0; $res = pg_fetch_array($qry, NULL, PGSQL_ASSOC); $i++)
		$email[$i] = $res;
	
	//var_dump($data);
	echo "<table>";
		foreach($email as $object):
		?>
				   <tr>
					<td><?php echo $object['email']?></td>
				</tr>
	<?php 
		endforeach;
		  echo "</table>";
	
}

if ($_GET['query'] == 'local'){
	$sql = 'SELECT * FROM usuario WHERE upper(local) LIKE \'%'.strtoupper($_GET['param']).'%\' ORDER BY nome';
	$qry = pg_query($sql);
	$usuarios = array();
	for ($i = 0; $res = pg_fetch_array($qry, NULL, PGSQL_ASSOC); $i++)
		$usuarios[$i] = $res;
	
	//var_dump($data);
	echo "<table>
			   <tr>
					<td>Login</td>
					<td>Nome</td>
					<td>Senha</td>
					<td>Cidade</td>
					<td>Email</td>
					<td>Profissão</td>
					<td>Autorizado</td>
					<td>Comunicação Alternativa</td>
					<td>Local de Acesso</td>
				</tr>";
		foreach($usuarios as $object):
		?>
				   <tr>
					<td><?php echo $object['login']?></td>
					<td><?php echo $object['nome']?></td>
					<td><?php echo $object['senha']?></td>
					<td><?php echo $object['cidade']?></td>
					<td><?php echo $object['email']?></td>
					<td><?php echo $object['profissao']?></td>
					<td><?php echo $object['autorizado']?></td>
					<td><?php echo $object['comunicacao_alternativa']?></td>
					<td><?php echo $object['local']?></td>
				</tr>
	<?php 
		endforeach;
		  echo "</table>";
}

if ($_GET['query'] == 'cidade'){
	$sql = 'SELECT * FROM usuario WHERE upper(cidade) LIKE \'%'.strtoupper($_GET['param']).'%\' ORDER BY nome';
	$qry = pg_query($sql);
	$usuarios = array();
	for ($i = 0; $res = pg_fetch_array($qry, NULL, PGSQL_ASSOC); $i++)
		$usuarios[$i] = $res;
	
	//var_dump($data);
	echo "<table>
			   <tr>
					<td>Login</td>
					<td>Nome</td>
					<td>Senha</td>
					<td>Cidade</td>
					<td>Email</td>
					<td>Profissão</td>
					<td>Autorizado</td>
					<td>Comunicação Alternativa</td>
					<td>Local de Acesso</td>
				</tr>";
		foreach($usuarios as $object):
		?>
				   <tr>
					<td><?php echo $object['login']?></td>
					<td><?php echo $object['nome']?></td>
					<td><?php echo $object['senha']?></td>
					<td><?php echo $object['cidade']?></td>
					<td><?php echo $object['email']?></td>
					<td><?php echo $object['profissao']?></td>
					<td><?php echo $object['autorizado']?></td>
					<td><?php echo $object['comunicacao_alternativa']?></td>
					<td><?php echo $object['local']?></td>
				</tr>
	<?php 
		endforeach;
		  echo "</table>";
}

if ($_GET['query'] == 'profissao'){
	$sql = 'SELECT * FROM usuario WHERE upper(profissao) LIKE \'%'.strtoupper($_GET['param']).'%\' ORDER BY nome';
	$qry = pg_query($sql);
	$usuarios = array();
	for ($i = 0; $res = pg_fetch_array($qry, NULL, PGSQL_ASSOC); $i++)
		$usuarios[$i] = $res;
	
	//var_dump($data);
	echo "<table>
			   <tr>
					<td>Login</td>
					<td>Nome</td>
					<td>Senha</td>
					<td>Cidade</td>
					<td>Email</td>
					<td>Profissão</td>
					<td>Autorizado</td>
					<td>Comunicação Alternativa</td>
					<td>Local de Acesso</td>
				</tr>";
		foreach($usuarios as $object):
		?>
				   <tr>
					<td><?php echo $object['login']?></td>
					<td><?php echo $object['nome']?></td>
					<td><?php echo $object['senha']?></td>
					<td><?php echo $object['cidade']?></td>
					<td><?php echo $object['email']?></td>
					<td><?php echo $object['profissao']?></td>
					<td><?php echo $object['autorizado']?></td>
					<td><?php echo $object['comunicacao_alternativa']?></td>
					<td><?php echo $object['local']?></td>
				</tr>
	<?php 
		endforeach;
		  echo "</table>";
}


?>	
