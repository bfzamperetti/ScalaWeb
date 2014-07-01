        <?php
include('../INCLUDES/conecta.php');
include_once('../INCLUDES/uses.php');
session_start();
echo " 
	<div class='pranchas_abrir'>
		<form name='frm_abrir_prancha' action='index.php?varAtual=menu_inferior' method='post'>
		<div class='lista_de_pranchas_var'>
			<div class='cab_lista_prancha_var'>
				<div class='titulo_lista_de_pranchas_var'> Pranchas Privadas (só acessadas por você) </div>
			</div>
			
			<div id='pranchas_privadas' class='lista_de_pranchas_quadro_var'>
			";
			
				
				$sql = "SELECT * FROM prancha_usuario WHERE id_usuario = ".$_SESSION['id']." and tipo='privada' ORDER BY id DESC";
				$qry = pg_query($sql);
				$i = 0;
				$_SESSION['vetor_privadas'] = array();
				$_SESSION['vetor_lista_pranchas'] =  array();
				
				while ($p = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
					$i++;
					
					echo "<div class='prancha_lista_pranchas_var' style='display:none;' id='prancha_lista_pranchas".$p['id']."' onclick='javascript: selecionarPranchasNaLista(".$p['id'].",\"".$p['tipo']."\");'>
							<div class='foto_prancha_lista_var'>
								<img src='imagens/site/documento.png' width='20px' />
							</div>
							<div class='nome_prancha_lista_var'>
								".$p['nome']."
							</div>
							<div class='fechar_prancha_lista_var' id='botao_x_apagar".$p['id']."' onclick='javascript: apagar_prancha_lista(".$p['id'].")'>
									<img src='imagens/site/ico2.png' width='45px' />
								</div>
							<div class='data_prancha_lista_var'>
								".mostraData($p['data'])."
							</div>
						  </div>";
						   
						   $_SESSION['vetor_privadas'][] =  "prancha_lista_pranchas".$p['id'];
						   $array_aux[] =  "botao_x_apagar".$p['id'];
				}
				$_SESSION['vetor_lista_pranchas'] = $_SESSION['vetor_privadas'];
				$_SESSION['vetor_privadas'] = array_merge($_SESSION['vetor_privadas'],$array_aux);
				$_SESSION['vetor_privadas'][] =  "botao_mais_pranchas_priv";
				$_SESSION['vetor_privadas'][] =  "botao_menos_pranchas_priv";
				$_SESSION['vetor_privadas'][] =  "botao_voltar_priv";
				
				if ($i == 0) echo "<div class='msg_lista_pranchas'>Não Há Pranchas nesta sessão</div>"; 
		echo '
			</div>
		</div>
		<div class="lista_de_pranchas_var">
			<div class="cab_lista_prancha_var">
				<div class="titulo_lista_de_pranchas_var"> Pranchas Públicas (todos tem acesso) </div>
			</div>
			<div id="pranchas_publicas" class="lista_de_pranchas_quadro_var">
			';
				$sql = "SELECT * FROM prancha_usuario WHERE tipo = 'publica' ORDER BY id DESC";
				$qry = pg_query($sql);
				$i = 0;
				$_SESSION['vetor_publicas'] = array();
				
				while ($p = pg_fetch_array($qry, NULL, PGSQL_ASSOC)){
					$qry2 = pg_query("SELECT nome FROM usuario WHERE id = ".$p['id_usuario']);
					$nome = pg_fetch_array($qry2, NULL, PGSQL_ASSOC);
					$nome_user = split(" ", $nome['nome']);
					$i++;
					echo "<div class='prancha_lista_pranchas_var' style='display:none;' id='prancha_lista_pranchas".$p['id']."' onclick='javascript: selecionarPranchasNaLista(".$p['id'].",\"".$p['tipo']."\");'>
							<div class='foto_prancha_lista_var'>
								<img src='imagens/site/documento.png' width='20px' />
							</div>
							<div class='nome_prancha_lista_var'>
								".$p['nome']."
							</div>";
							if ($p['id_usuario'] == $_SESSION['id'])
								echo "<div class='fechar_prancha_lista_var' id='botao_x_apagar".$p['id']."' onclick='javascript: apagar_prancha_lista(".$p['id'].")'>
									<img src='imagens/site/ico2.png' width='45px' />
								</div>";
							else
								echo "<div class='botao_null'>
									<img src='imagens/site/transparente.png' width='27px' />
								</div>";
							echo "<div class='data_prancha_lista_var'>
								".mostraData($p['data'])."-".$nome_user[0]."
							</div>
						  </div>";
				
					$_SESSION['vetor_publicas'][] = "prancha_lista_pranchas".$p['id'];
					if ($p['id_usuario'] == $_SESSION['id'])
						$_SESSION['vetor_publicas'][] = "botao_x_apagar".$p['id'];
					
				}
				
				$_SESSION['vetor_publicas'][] = "botao_mais_pranchas_pub";
				$_SESSION['vetor_publicas'][] = "botao_menos_pranchas_pub";
				$_SESSION['vetor_publicas'][] = "botao_voltar_pub";
				
				if ($i == 0) echo "<div class='msg_lista_pranchas'>Não Há Pranchas nesta sessão</div>"; 
		echo '
		</div>
		<input type="hidden" value="" name="tipo" /> <!-- estes inputs guardarao a prancha selecionada -->
		<input type="hidden" value="" name="id" /> 
		<input type="hidden" value="" name="abrirPranchaLista" /> 
		</form>
	</div>
	';
	
	
	    echo'
	<div class="botoes_pranchas_abrir">
			<img src="imagens/site/transparente.png" width="30px" id="botao_aux"/>
			<img src="imagens/site/plusIcon.png" width="22px" id="botao_mais_pranchas_priv" style="display: none;"/>
			<img src="imagens/site/removeIcon.png" width="22px" id="botao_menos_pranchas_priv" style="diplay: none;"/>
			<img src="imagens/site/tela1/voltar.png" width="28px" id="botao_voltar_priv" style="display: none;"/>
			<img src="imagens/site/transparente.png" width="30px" id="botao_aux2"/>
			<img src="imagens/site/plusIcon.png" width="22px" id="botao_mais_pranchas_pub" style="display: none;"/>
			<img src="imagens/site/removeIcon.png" width="22px" id="botao_menos_pranchas_pub" style="display: none;"/>			
			<img src="imagens/site/tela1/voltar.png" width="28px" id="botao_voltar_pub" style="display: none;"/>
	</div>';
?>
