function openAjax() {

var ajax;

try{
    ajax = new XMLHttpRequest(); // XMLHttpRequest para browsers decentes, como: Firefox, Safari, dentre outros.
}catch(ee){
    try{
        ajax = new ActiveXObject("Msxml2.XMLHTTP"); // Para o IE da MS
    }catch(e){
        try{
            ajax = new ActiveXObject("Microsoft.XMLHTTP"); // Para o IE da MS
        }catch(E){
            ajax = false;
        }
    }
}
return ajax;
}

/*      Funções Sistema de Varredura      */

function montarListaDePranchasVarredura(){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('dialog_abrirArquivo'); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "montarListaDePranchasVarredura.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa variável (var resultado).
						exibeResultado.innerHTML = resultado;
						//chamar a função para preencher os vetores do menu abrir.
						montarListaDePranchasVarreduraAux();
					}
				}
			}
			ajax.send(null); // submete
	}
}

function montarListaDePranchasVarreduraAux(){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('dialog_abrirArquivo'); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "montarListaDePranchasAux.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa variável (var resultado).
						eval(resultado);
						indice_privadas = 0;
						indice_publicas = 0;
						mostrarListaDePranchas();
					}
				}
			}
			ajax.send(null); // submete
	}
}

function selecionarPranchasNaListaVarredura(idp, tipop){
	if (document.frm_abrir_prancha.id.value != "")
		document.getElementById(document.frm_abrir_prancha.id.value).style.background = "#a0c544";   
	document.frm_abrir_prancha.id.value = idp.substr(22); 
	document.frm_abrir_prancha.tipo.value = tipop;
	document.getElementById(idp).style.background = "#ccc";
	document.frm_abrir_prancha.submit();
}

function apagar_prancha_lista_varredura(id){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var ajax = openAjax(); // Inicia o Ajax.
		ajax.open("GET", "apagar_prancha_lista.php?id=" + id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
		ajax.onreadystatechange = function() {
		if(ajax.readyState == 4) { // Quando estiver tudo pronto.
			if(ajax.status == 200) {
				document.getElementById("prancha_lista_pranchas"+id).style.display = 'none';
				var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa variável (var resultado).
			}
		}
		}
		ajax.send(null); // submete
	}
}

/*
Função recebe o nome do mp3 por parâmetro sem conter no nome o formato do arquivo(Ex: "file"),
esse som deve estar localizado na pasta "INCLUDES/sons"
*/
function executarSom(mp3File){
	//Reproduz o som, somente se o som de varredura estiver ativado no menu de configurações.
	if(estadoSomVarredura == 1){
		$(document).ready(function(){
			$("#som_varredura").jPlayer({
			ready: function () {
				$(this).jPlayer("setMedia", {
				mp3: "../INCLUDES/sons/"+mp3File+".mp3",
				});
			},
			swfPath: "../INCLUDES/js/jPlayer",
			supplied: "mp3"
			});
		});
		
		$("#som_varredura").jPlayer("stop");
		$("#som_varredura").jPlayer("play");
	}
	else
		return;
}

function ativar_varredura(){
	document.form_config_varredura.estadoVarredura.value = 1;
	document.form_config_varredura.submit();
}

/* Área de váriaveis globais utilizadas, principalemente, da varredura do menu inferior e alguma em todas as varredura.
 * 
 * VetorVarreduraMenu       = Vetor com os ids dos ícones do menu inferior
 * VetorVarreduraLayout     = Vetor com os ids dos possiveis layouts do dialog
 * VetorVarreduraVisualizar = Vetor com os ids dos ícones da página visualizarImagensVarredura.php
 * estadoVarreduraFunc1     = 0 - varredura ativada; 1 - varredura desativada 
 * estadoVarCategorias      = 0 - varredura ativada; 1 - varredura desativada 
 * menu_atual				= guarda a posição do vetor que foi selecionada na varredura. Váriável usada em todos os vetores e varreduras.
 * varredura_atual			= Guarda qual lugar esta varrendo para saber qual vetor utilizar ou qual função chamar quando houver um click. 
 * 				'menu_inferior'      - varredura no menu inferior 
 * 				'dialog_layout'      - varredura no dialog de layout
 * 				'pag_visualizar'     - varredura na página visualizar
 * 				'categorias'         - varredura nas categorias
 * 				'selecaoImgComplexa' - varredura complexa na seleção de imagens
 * 				'selecaoImgSimples'  - varredura simples na seleção de imagens
 * 				'selecaoEspacoPrancha' - varredura para selecionar o lugar que a imagem será colocada na prancha
 * tempoVarredura			= guarda o tempo recebido na primeira função de varredura para não ter que passar como parâmetro por muito funções
 * 
 * São utilizadas mais de uma variável para guadar o estado na varredura por serem utilizadas mais de uma função para efetuar
 * a varredura de todos os elementos do sistema. Algumas varreduras não compartilham a mesma função por ficar muito complexo
 * o entendimento do código.
 */
var VetorVarreduraMenu = new Array ("abrir", "salvar_varredura", "desfaz", "importar","exportar","imprime","escolher_layout","visualizar","limpar","ajuda","sair","desativar_var","categorias","seta_dir_barra_layout","seta_esq_barra_layout");
var VetorVarreduraLayout = new Array ("layout_1","layout_2","layout_3","layout_4","layout_5", "voltar_dialog_layout");
var VetorVarreduraVisualizar= new Array ("seta_esq_visualizar", "seta_dir_visualizar", "voltar_visualizar", "reproduzir_visualizar");
var VetorVarreduraQuadroPranchas= new Array ("pranchas_privadas", "pranchas_publicas", "fechar_dialog_abrir");
var VetorVarreduraDialogSalvar= new Array ("fechar_dialog_salvar", "salvar_dialog_salvar");
var estadoVarreduraFunc1 = -1;
var estadoSomVarredura; //1 -> ativado, 0 -> desativado
var estadoVarCategorias = -1;
var controlaVarredura;
var menu_atual;
var varredura_atual;
var varredura_anterior;
var tempoVarredura;
var teste;
var indice_privadas, indice_publicas, limite_anterior_de_pranchas, limite_de_pranchas , num_pranchas_priv=0, click_voltar_priv=false, click_voltar_pub=false;
var indices_removidos_priv,indices_removidos_pub;


/* Função de varredura utilizada para varrer: Menu Inferior, Dialog com Layouts, Página visualizarImagensVarredura.php
 * Esta função recebe como parâmetro o tempo e um índice j que é utilizado para acessar um posição de determinado vetor. */
function IniciaVarredura(tempo,j){
	var atual;

		j++;
		teste=0; //achar outra solução!!!

		/* Verificar qual a varredura_atual para zerar o j causando assim loop na varredura*/		
		if (varredura_atual == 'menu_inferior') if (j == 15) j = 0;
		if (varredura_atual == 'dialog_layout') if (j == 6) j = 0;
		if (varredura_atual == 'pag_visualizar') if (j == 4) j = 0;
		if (varredura_atual == 'categorias') if (j == 9) j = 0;
		if (varredura_atual == 'dialog_pranchas') if(j == 3) j = 0;
		if (varredura_atual == 'dialog_salvar') if(j == 2) j = 0;

		if (varredura_atual == 'pranchas_privadas'){
			if(click_voltar_priv == true){
				j = indice_privadas;
				click_voltar_priv = false;
			}
			if (VetorVarreduraPranchasPrivadas[j] == null ) j=indice_privadas; //calcular 4 pranchas + 3 botões
			else{
				if(j == indice_privadas+num_pranchas_priv)
					j = parseInt(tam_array_pranchas)+indice_privadas;
				else
					if(j == (parseInt(tam_array_pranchas)+indice_privadas+num_pranchas_priv))
						j = VetorVarreduraPranchasPrivadas.length-3; 

				if(j >= VetorVarreduraPranchasPrivadas.length-3)
					if(document.getElementById(VetorVarreduraPranchasPrivadas[j]).style.display == "none")
						if(document.getElementById(VetorVarreduraPranchasPrivadas[j+1]).style.display != "none")
							j++;
						else
							j = VetorVarreduraPranchasPrivadas.length-1;
			}
		}
		
		if (varredura_atual == 'pranchas_publicas'){
			if(click_voltar_pub == true){
				j = indice_publicas;
				click_voltar_pub = false;
			}
			if (VetorVarreduraPranchasPublicas[j] == null ) j=indice_publicas; //calcular 4 pranchas + 3 botões*
			else{
				if(j==indice_publicas+limite_de_pranchas+1)
					j = VetorVarreduraPranchasPublicas.length-3;

				if(j >= VetorVarreduraPranchasPublicas.length-3)
					if(document.getElementById(VetorVarreduraPranchasPublicas[j]).style.display == "none")
						if(document.getElementById(VetorVarreduraPranchasPublicas[j+1]).style.display != "none")
							j++;
						else
							j = VetorVarreduraPranchasPublicas.length-1;
			}
		}

		menu_atual = j;				//atualiza menu_atual para assim que for selecionada algum item saber
									//qual função saber
		varredura_anterior = varredura_atual;
		tempoVarredura = tempo;

		if (estadoVarreduraFunc1 == 1){
			return;
		}
		
		if (varredura_atual == 'menu_inferior') atual = document.getElementById(VetorVarreduraMenu[j]);
		if (varredura_atual == 'dialog_layout') atual = document.getElementById(VetorVarreduraLayout[j]);
		if (varredura_atual == 'pag_visualizar') atual = document.getElementById(VetorVarreduraVisualizar[j]);
		if (varredura_atual == 'categorias') atual = document.getElementById(VetorVarreduraCategorias[j]);
		if (varredura_atual == 'dialog_pranchas') atual = document.getElementById(VetorVarreduraQuadroPranchas[j]);
		if (varredura_atual == 'pranchas_privadas') atual = document.getElementById(VetorVarreduraPranchasPrivadas[j]);
		if (varredura_atual == 'pranchas_publicas') atual = document.getElementById(VetorVarreduraPranchasPublicas[j]);
		if (varredura_atual == 'dialog_salvar') atual = document.getElementById(VetorVarreduraDialogSalvar[j]);
		
		atual.style.borderColor = cor;
		executarSom("som_de_varredura2");

		if (varredura_atual == 'menu_inferior'){
			adicionarLegenda(VetorVarreduraMenu[j]);
		}
		if(estadoVarreduraFunc1!=1)
			setTimeout("DesfazerEfeitoVarredura("+tempo+","+j+")",tempo);	
		
					
}
		
/* Função que é chamada na função IniciaVarredura e que tira o foco de um elemento. */
function DesfazerEfeitoVarredura(tempo,j){ 	
	var estado,varredura,indice=j;	
	
	controlaVarredura = 1;
	if(varredura_atual==varredura_anterior){
		varredura = varredura_atual;
	}
	else{
		varredura = varredura_anterior;
		j=-1;
	}
		
	if (varredura == 'menu_inferior') estado = document.getElementById(VetorVarreduraMenu[indice]);
	if (varredura == 'dialog_layout') estado = document.getElementById(VetorVarreduraLayout[indice]);
	if (varredura == 'pag_visualizar') estado = document.getElementById(VetorVarreduraVisualizar[indice]);
	if (varredura == 'categorias') estado = document.getElementById(VetorVarreduraCategorias[indice]);
	if (varredura == 'dialog_pranchas') estado = document.getElementById(VetorVarreduraQuadroPranchas[indice]);
	if (varredura == 'pranchas_privadas') estado = document.getElementById(VetorVarreduraPranchasPrivadas[indice]);
	if (varredura == 'pranchas_publicas') estado = document.getElementById(VetorVarreduraPranchasPublicas[indice]);
	if (varredura == 'dialog_salvar') estado = document.getElementById(VetorVarreduraDialogSalvar[indice]);
	
	estado.style.borderColor = "transparent";
	
	if (varredura_atual == 'menu_inferior')
			removerLegenda(VetorVarreduraMenu[indice]);
	setTimeout("IniciaVarredura("+tempo+","+j+")",10);
	
	return;
}


/* Função para adcionar legendas nos icones do menu inferior, quando a varredura esta sobre ele */
function adicionarLegenda(obj){
	$('#'+obj).mouseenter();
}
function removerLegenda(obj){
	$('#'+obj).mouseout();
}


/* Função que detecta clique do mouse
 * Verificar se o botão foi clicado e se o sistema esta com a varredura ativada. Estará ativada se:
 * 		estadoVarreduraFunc1 = 0, ou estavadoVarcategorias = 0, ou varredura_atual = 6
 * 
 * Esta função deve manter o ifs na ordem em que estão, caso contrário o sistemas pode não funcionar corretamente.
 * Exemplo: se a varredura_atual for 4, ao entrar na função escolherImagemVarredura(), a variável varredura_atual
 * 			receberá o valor 5 e ao retornar entrará no if (...=5).
 * 
 * A variável controlaVarredura é apenas para controle, para que não entre na função antes que a varredura inicie corretamente.
 * Seu valor muda para 1 quando entra nas funções de tirar o foco de um item. 
 * 
 * Para saber o que é cada if, volte no código onde a variável varredura_atual foi criada.
 * */
function clicks(){ 
	
		if (varredura_atual == 'pag_limpar'){
			estadoVarCategorias = 1;
			chamarFuncaoLimpar();
		}

		if ((varredura_atual == 'selecaoEspacoPrancha') && (controlaVarredura == 1)){
			estadoVarreduraPrancha = 1;
			colocarImgSelecionadaNaPrancha();
		}
		if ((varredura_atual == 'selecaoImgSimples') && (controlaVarredura == 1)){
			estadoVarreduraSimplesImgs = 1;		
			selecionarEspacoNaPranchaAux();
		}
		if ((varredura_atual == 'selecaoImgComplexa') && (controlaVarredura == 1)) {
			estadoVarCategorias = 1;
			varreduraSelecaoImagens();	
		}
		if ((varredura_atual == 'categorias') && (controlaVarredura == 1))
			if(VetorVarreduraCategorias[menu_atual]!="catMenuInferior"){
				estadoVarreduraFunc1 = 1;
				escolherImagemVarredura();
			}
			else{
				document.getElementById("catMenuInferior").style.border =  "solid 2px transparent";
				varredura_atual = 'menu_inferior';
				controlaVarredura=0;
			}
			
		if ((varredura_atual == 'dialog_layout') && (controlaVarredura == 1)) chamarFuncaoLayoutEscolhido();			
		if (varredura_atual == 'pag_visualizar') chamarFuncaoMenuVisualizar();
		if (varredura_atual == 'dialog_pranchas') {varreduraComplexaMenuAbrir(); teste=1; return;}
		if(varredura_atual == 'dialog_salvar'){ 
			if(menu_atual == 0){ 
				location.href="index.php?varAtual=menu_inferior";
			}
			if(menu_atual == 1){ 
				salvar_prancha_varredura('privada', document.frm_salvar_prancha_varredura.nome.value);
			}	
		}
		if ((varredura_atual == 'menu_inferior') && (controlaVarredura == 1)){ 
			removerLegenda(VetorVarreduraMenu[menu_atual]);
			chamarFuncaoMenuSelecionado();
		}			 
		if(teste!=1)
			chamarFuncaoMenuAbrir();
			
	//}
}

//detecta se o usuário pressionar 'esc' e desativa a varredura
		$(document).keyup(function(event) {
			var keycode = (event.keyCode ? event.keyCode : event.which);
				if(keycode == '27' && varredura_atual != null) {//detecta o esc e desativa a varredura, somente se a varredura do sistema estiver ativa
					document.form_config_varredura.estadoVarredura.value = 0;
					document.form_config_varredura.submit();
				}
		});

/* Função que verifica qual o menu que estava em foco quando o usuário clicou e chama função correspondente*/ 
function chamarFuncaoMenuSelecionado(){

	controlaVarredura = 0;
	document.getElementById(VetorVarreduraMenu[menu_atual]).style.border = "solid 2px transparent";

	menu_atual = VetorVarreduraMenu[menu_atual];
	 //Funções do menu inferior disponíveis apenas no acesso direto
	 
	if (menu_atual == "importar")
		msgOver('Esta op&ccedil;&atilde;o est&aacute; dispon&iacute;vel apenas com a varredura <b>desativada</b>.', 3);
	 
	if (menu_atual == "abrir"){
		$('#dialog_abrirArquivo').dialog('open');
		document.getElementById("dialog_abrir_prancha").style.display = "none";
		montarListaDePranchasVarredura();
		varredura_atual = 'dialog_pranchas';
	}
	
	if (menu_atual == "salvar_varredura") {
		varredura_atual = "dialog_salvar";
		$('#dialog_salvar_varredura').dialog('open');
	}
	
	if (menu_atual == "seta_esq_barra_layout") mudarQuadro(-1);
		
	if (menu_atual == "seta_dir_barra_layout") mudarQuadro(1);	 
			
	if (menu_atual == "desfaz") desfazer();

	if (menu_atual == "exportar"){
		msgOver('Esta op&ccedil;&atilde;o est&aacute; dispon&iacute;vel apenas com a varredura <b>desativada</b>.', 3);
	}

	if (menu_atual == "imprime") //antes de chamar a página dar um alert avisando que o sistema nao cobre a varredura da impressao 
		msgOver('Esta op&ccedil;&atilde;o est&aacute; dispon&iacute;vel apenas com a varredura <b>desativada</b>.', 3);
	
	if (menu_atual == "escolher_layout"){
		$('#dialog_escolher_layout').dialog('open');
		varredura_atual = 'dialog_layout';	
		setTimeout("IniciaVarredura("+tempoVarredura+",-1)",20);	
	}
	
	if (menu_atual == "visualizar"){
		estadoVarreduraFunc1 = 1; //Não modificar
		varredura_atual = 'pag_visualizar';
		location.href="visualizar.php?tempoVarredura="+tempoVarredura;
	}
	
	if (menu_atual == "limpar"){
		varredura_atual = 'pag_limpar';
		location.href="limpar_imagens_varredura.php";
	}
	
	if (menu_atual == "ajuda") inTutorial();
	
	if (menu_atual == "sair") location.href = 'index.php?logout=1';
	
	if (menu_atual == "desativar_var"){
		document.form_config_varredura.estadoVarredura.value = 0;
		document.form_config_varredura.submit();
	}

	if (menu_atual == "categorias"){
		varredura_atual = 'categorias';
		controlaVarredura = 0;
		setTimeout("IniciaVarredura("+tempoVarredura+", -1)",20);
	}
	return;	
}

//Função que é chamada quando o usuário clica no ícone de Abrir no menu
function varreduraComplexaMenuAbrir(){
	
	document.getElementById(VetorVarreduraQuadroPranchas[menu_atual]).style.border = "solid 2px transparent";
	
	if(VetorVarreduraQuadroPranchas[menu_atual] == 'pranchas_privadas')
		varredura_atual = 'pranchas_privadas';
		
	if(VetorVarreduraQuadroPranchas[menu_atual] == 'pranchas_publicas')
		varredura_atual = 'pranchas_publicas';
	
	if(VetorVarreduraQuadroPranchas[menu_atual] == 'fechar_dialog_abrir'){
		$('#dialog_abrirArquivo').dialog('close');
		location.href="index.php?varAtual=menu_inferior";
	}
	
	return;
}

//Funcão para mostrar até 9 pranchas na lista de pranchas do menu Abrir, tanto para privadas quanto para públicas
function mostrarListaDePranchas(){
	var i, limite=7, nao_achou=-1, cont_pranchas=0;
	var num_pranchas = tam_array_pranchas;

// Obs:	
// ícone de mais pranchas = VetorVarreduraPranchasPublicas.length-3
// ícone de menos pranchas = VetorVarreduraPranchasPublicas.length-2
// ícone de voltar = VetorVarreduraPranchasPublicas.length-1
	
	//mostrar pranchas privadas
	for(i=0; i<num_pranchas; i++){
		if(i>=indice_privadas && i<=indice_privadas+3){
			if(VetorVarreduraPranchasPrivadas[i]!=null){
				document.getElementById(VetorVarreduraPranchasPrivadas[i]).style.display = "table";
				cont_pranchas++;
			}
		}
		else
			if(VetorVarreduraPranchasPrivadas[i]!=null){
				document.getElementById(VetorVarreduraPranchasPrivadas[i]).style.display = "none";
			}
	}

	
	//controle para mostrar os ícones de mais pranchas, menos pranchas
	if(indice_privadas+cont_pranchas >= num_pranchas) //verifica se existe nova página de pranchas
		document.getElementById(VetorVarreduraPranchasPrivadas[VetorVarreduraPranchasPrivadas.length-3]).style.display='none';
	else
		document.getElementById(VetorVarreduraPranchasPrivadas[VetorVarreduraPranchasPrivadas.length-3]).style.display='inline';
	
	if(indice_privadas==0) //verifica se está na primeira página de pranchas
		document.getElementById(VetorVarreduraPranchasPrivadas[VetorVarreduraPranchasPrivadas.length-2]).style.display='none';
	else
		document.getElementById(VetorVarreduraPranchasPrivadas[VetorVarreduraPranchasPrivadas.length-2]).style.display='inline';
	
	document.getElementById(VetorVarreduraPranchasPrivadas[VetorVarreduraPranchasPrivadas.length-1]).style.display='inline';
	
	//mostrar pranchas públicas
	var num_pranchas = VetorVarreduraPranchasPublicas.length-3;
	
	for(i=0; i<VetorVarreduraPranchasPublicas.length-3; i++)
		if(i>=indice_publicas && i<=indice_publicas+limite){
			if(VetorVarreduraPranchasPublicas[i]!=null)
				document.getElementById(VetorVarreduraPranchasPublicas[i]).style.display = "table";
			if(VetorVarreduraPranchasPublicas[i].search("botao_x_apagar") == nao_achou && VetorVarreduraPranchasPublicas[i+1].search("botao_x_apagar") == nao_achou)
				limite --;
		}
		else
			if(VetorVarreduraPranchasPublicas[i]!=null)
				document.getElementById(VetorVarreduraPranchasPublicas[i]).style.display = "none";


	//controle para mostrar os ícones de mais pranchas, menos pranchas
	if(indice_publicas+limite >= num_pranchas) //verifica se existe nova página de pranchas
		document.getElementById(VetorVarreduraPranchasPublicas[VetorVarreduraPranchasPublicas.length-3]).style.display='none';
	else
		document.getElementById(VetorVarreduraPranchasPublicas[VetorVarreduraPranchasPublicas.length-3]).style.display='inline';
	
	if(indice_publicas==0) //se é a primeira pág. de pranchas
		document.getElementById(VetorVarreduraPranchasPublicas[VetorVarreduraPranchasPublicas.length-2]).style.display='none';
	else
		document.getElementById(VetorVarreduraPranchasPublicas[VetorVarreduraPranchasPublicas.length-2]).style.display='inline';
	
	document.getElementById(VetorVarreduraPranchasPublicas[VetorVarreduraPranchasPublicas.length-1]).style.display='inline';
	
	//atualizar variáveis globais
	limite_de_pranchas = limite;
	num_pranchas_priv = cont_pranchas;
	
	return;
}

function chamarFuncaoMenuAbrir(){

	var num_pranchas = VetorVarreduraPranchasPrivadas.length-3;
	
	if (varredura_atual == 'pranchas_privadas'){
	
	//abrir prancha
	if(VetorVarreduraPranchasPrivadas[menu_atual].search('prancha_lista_pranchas')!=-1){ // se é o nome de uma prancha no array da lista de pranchas
		selecionarPranchasNaListaVarredura(VetorVarreduraPranchasPrivadas[menu_atual], "privada");
	}
	else
	//avançar uma página de pranchas
		if(VetorVarreduraPranchasPrivadas[menu_atual] == 'botao_mais_pranchas_priv'){
			indice_privadas = indice_privadas+4;
			mostrarListaDePranchas();	
		}
		else
		 //voltar uma página de pranchas
			if(VetorVarreduraPranchasPrivadas[menu_atual] == 'botao_menos_pranchas_priv'){
				indice_privadas = indice_privadas-4;
				mostrarListaDePranchas();
			}
			else 
			//voltar para varredura complexa entre pranchas privadas, publicas e fechar dialog do abrir
				if(VetorVarreduraPranchasPrivadas[menu_atual] == 'botao_voltar_priv'){
					//indice_privadas=0;
					//montarListaDePranchasVarredura();
					click_voltar_priv = true;
					varredura_atual = 'dialog_pranchas';
				}
				else{ 
					//apagar prancha
						apagar_prancha_lista_varredura(VetorVarreduraPranchasPrivadas[menu_atual].substr(14));
						montarListaDePranchasVarredura();
						varredura_atual = 'pranchas_privadas';
				}
	}

	num_pranchas = VetorVarreduraPranchasPublicas.length-3;

	if (varredura_atual == 'pranchas_publicas'){			
	//abrir prancha
	if(VetorVarreduraPranchasPublicas[menu_atual].search('prancha_lista_pranchas')!=-1){
		selecionarPranchasNaListaVarredura(VetorVarreduraPranchasPublicas[menu_atual], "publica");
	}
	else
		//avançar uma página de pranchas
		if(VetorVarreduraPranchasPublicas[menu_atual] == 'botao_mais_pranchas_pub'){
			indice_publicas = indice_publicas+limite_de_pranchas+1;
			limite_anterior_de_pranchas = limite_de_pranchas;
			mostrarListaDePranchas();
		}
		else 
			//voltar uma página de pranchas
			if(VetorVarreduraPranchasPublicas[menu_atual] == 'botao_menos_pranchas_pub'){
				indice_publicas = indice_publicas-limite_anterior_de_pranchas-1;
				mostrarListaDePranchas();
			}
			else  
				//voltar para varredura complexa entre pranchas privadas, publicas e fechar dialog do abrir
				if(VetorVarreduraPranchasPublicas[menu_atual] == 'botao_voltar_pub'){
					//indice_publicas = 0;
					//montarListaDePranchasVarredura();
					click_voltar_pub = true;
					varredura_atual = 'dialog_pranchas';
				}
				else{ 
					//apagar prancha
					apagar_prancha_lista_varredura(VetorVarreduraPranchasPublicas[menu_atual].substr(14));
					montarListaDePranchasVarredura();
					}
	}
	
	return;
}

/*Função que é chamada quando o usuário clica e a varredura esta na página visualizarImagensVarredura.php. */
function chamarFuncaoMenuVisualizar(){
	estadoVarreduraFunc1 = 1;
	menu_atual = VetorVarreduraVisualizar[menu_atual];
	
	if (menu_atual == "seta_esq_visualizar"){
		quadro_atual_visualizar--;
		location.href="visualizar.php?quadro_atual="+quadro_atual_visualizar+ "&tempoVarredura="+tempoVarredura;
	}
	if (menu_atual == "seta_dir_visualizar"){
		quadro_atual_visualizar++;
		location.href="visualizar.php?quadro_atual="+quadro_atual_visualizar+ "&tempoVarredura="+tempoVarredura;
	}
	if (menu_atual == "voltar_visualizar")
		location.href = 'index.php?varAtual=menu_inferior';
		
	if (menu_atual == "reproduzir_visualizar"){
		sintetizarVisualizar();
	}

	return;
}

/*Função que é chamada quando o usuário clica e a varredura estava no dialog de layouts. */
function chamarFuncaoLayoutEscolhido(){
	document.getElementById(VetorVarreduraLayout[menu_atual]).style.border = "solid 2px transparent";
	menu_atual = VetorVarreduraLayout[menu_atual];
	estadoVarreduraFunc1 = 0;

	//Não está perguntando ao usuário ainda
	if (menu_atual == "layout_1"){
		novoLayout(1); $('#dialog_escolher_layout').dialog('close');
	}			
	if (menu_atual == "layout_2"){
		novoLayout(2); $('#dialog_escolher_layout').dialog('close');
	}
	if (menu_atual == "layout_3"){
		novoLayout(3); $('#dialog_escolher_layout').dialog('close');
	}
	if (menu_atual == "layout_4"){
		novoLayout(4); $('#dialog_escolher_layout').dialog('close');	
	}	
	if (menu_atual == "layout_5"){
		novoLayout(5); $('#dialog_escolher_layout').dialog('close');
	}
	else
		$('#dialog_escolher_layout').dialog('close');
		
	varredura_atual = 'menu_inferior';	
	controlaVarredura = 0;
	
	return;
}

function chamarFuncaoLimpar(){
	var atual;

	atual = menu_atual;
	menu_atual = VetorLimparImagens[menu_atual];

	if (menu_atual == "voltar_visualizar") location.href="index.php?varAtual=menu_inferior";
		
	else if (menu_atual == "apagar_tudo") location.href="limpar_imagens_varredura.php?tipo_novo_layout=0";
		
	else if (menu_atual == "seta_dir_visualizar"){	
		quadro_atual_visualizar++;
		location.href="limpar_imagens_varredura.php?quadro_atual="+quadro_atual_visualizar;
	}
	
	else if (menu_atual == "seta_esq_visualizar"){
		quadro_atual_visualizar--;
		location.href="limpar_imagens_varredura.php?quadro_atual="+quadro_atual_visualizar;
	}
	
	else location.href="limpar_imagens_varredura.php?id_prancha_limpar="+atual; 
}

/*    VARREDURA CATEGORIAS   */

/* Variáveis utilizadas na varredura das categorias e em todo o processo de selecionar uma imagem e colocá-la na prancha.
 * VetorVarreduraCategorias    = vetor que tem os ids de casa imagem que representa uma categoria
 * VetorVarreduraImgsDivs      = vetor que tem os ids de 4 divs, estas divs são as utilizadasa na varredura complexa durante a seleção de imagens
 * VetorVarreduraImagens       = vetor que leva 32 itens que são os ids das imagens que estão na tela para varredura.
 * estadoVarreduraSimplesImgs  = variável que guarda o estado da varredura simples nas imagens: 0 - ativada, 1 - desativada
 */
var VetorVarreduraCategorias = new Array ("catPessoas","catObjetos","catNatureza","catAcoes","catAlimentos","catSentimentos","catQualidades","catMinhasI", "catMenuInferior");
var VetorVarreduraImgsDivs = new Array (7);
var VetorVarreduraPranchas = new Array("prancha0","prancha1","prancha2","prancha3","prancha4","prancha5","prancha6","prancha7","prancha8","prancha9","prancha10","prancha11");
var VetorVarreduraImagens = new Array(80);
var VetorLimparImagens = new Array(15);
var estadoVarreduraSimplesImgs;
var estadoVarreduraPrancha;
var idImagemVarredura;
var estadoVarCategorias = -1;

/*Função que varre as categorias e 4 divs que separam as imagens em 4 linhas para ser feita a varredura complexa */
function varreduraImgsCatEComplexa(tempo, j){
	var h;
		j++;
				
		if (varredura_atual == 'selecaoImgComplexa'){
			tempoVarredura = tempo;
			if (j == VetorVarreduraImgsDivs.length) j = 0;			
		}
		if (varredura_atual == 'pag_limpar'){
			tempoVarredura = tempo;
			if (VetorLimparImagens[j-1] == "apagar_tudo") j = 0;
		}
				
		menu_atual = j;
		tempo = tempoVarredura;
		
		if (estadoVarCategorias == 1){
			return;
		}	
		
		if (varredura_atual == 'selecaoImgComplexa') atual = document.getElementById(VetorVarreduraImgsDivs[j]);
		if (varredura_atual == 'pag_limpar') atual = document.getElementById(VetorLimparImagens[j]);
		
		atual.style.border = "1px solid "+cor;
		executarSom("som_de_varredura2");
		setTimeout("DesfazerEfeitoVarreduraImgsCatEComplexa("+tempo+","+j+")",tempo);		
			
}

//Função que auxilia na varredura - tira o foco de um item
function DesfazerEfeitoVarreduraImgsCatEComplexa(tempo,j){ 	
	controlaVarredura = 1;
	var atual;
	
	if (varredura_atual == 'selecaoImgComplexa') atual = document.getElementById(VetorVarreduraImgsDivs[j]);
	if (varredura_atual == 'pag_limpar') atual = document.getElementById(VetorLimparImagens[j]);
	
	atual.style.borderColor = "transparent";
	setTimeout("varreduraImgsCatEComplexa("+tempo+","+j+")",10);
	return;
}

/*Função chamada quando o usuário clica durante a varredura nas categorias.
 * Esta função chama a página que busca as 32 primeiras imagens do banco*/
function escolherImagemVarredura(){
	menu_atual++; 
	if (menu_atual >= 8) menu_atual = 0;
	location.href="visualizarImagensVarredura.php?categoria="+menu_atual+"&tempo="+tempoVarredura;
}

/*Função chamada quando o usuário clica e estava ativada a varredura nas cinco divs.
 * Nesta função é identificada qual a div clicada e chamada a função que varre as imagens que estão nela.*/
function varreduraSelecaoImagens(){
	varredura_atual = 'selecaoImgSimples';
	controlaVarredura = 0;
	estadoVarreduraSimplesImgs = 0;
	document.getElementById(VetorVarreduraImgsDivs[menu_atual]).style.border = "none";
	document.getElementById('cancelar_selecao').style.display = "block";
		
	if (VetorVarreduraImgsDivs[menu_atual] == "voltar_escolher_img")location.href="index.php?varAtual=categorias";
	else if (VetorVarreduraImgsDivs[menu_atual] == "escolher_mais_img") location.href="visualizarImagensVarredura.php?categoria=-1&maisImgs=1";	
	else if (VetorVarreduraImgsDivs[menu_atual] == "escolher_menos_img") location.href="visualizarImagensVarredura.php?categoria=-1&maisImgs=-1";	
		
//o primeiro parâmetro é o número da div que será realizada a varredura simples
//e o segundo é qual a posição da primeira imagem dessa div no vetor

	if (menu_atual == 0)
		varreduraSimplesSelecionarImgs(-1,-1);
	
	else if (menu_atual == 1)
		varreduraSimplesSelecionarImgs(11,-1);
	
	else if (menu_atual == 2) 
		varreduraSimplesSelecionarImgs(23,-1);
			
	else if (menu_atual == 3)
		varreduraSimplesSelecionarImgs(35,-1);
		
	else if (menu_atual == 4)
		varreduraSimplesSelecionarImgs(47,-1);
	
}

/*Função que varre cada imagem para que usuário selecione e ela seja colocada na prancha*/
function varreduraSimplesSelecionarImgs(j,temp,j_aux){	
	var tempo;
		
		tempo = tempoVarredura;
		j++;
		
		//alert(j+"   "+VetorVarreduraImagens.length);
		//alert(varredura_atual);
		if (temp!=-1){
			if ((j%12) == 0){ j_aux = j-12; j = VetorVarreduraImagens.length-1; }
			else if(j>=VetorVarreduraImagens.length)
					j = j_aux;
			//if (VetorVarreduraImagens.length == j) j = ((Math.floor(j/12))*12);
		}
	
		menu_atual = j;	
		
		if (estadoVarreduraSimplesImgs == 1){			
			return;
		}
		
		atual = document.getElementById(VetorVarreduraImagens[j]);
		atual.style.border = "solid 2px "+cor;
		executarSom("som_de_varredura2");
		
		setTimeout("DesfazerEfeitoVarreduraSimplesImgs("+j+","+j_aux+")",tempo);	
}

//Função auxiliar a varredura nas imagens - tira o foco da imagem e chama a função que coloca o foco na próxima
function DesfazerEfeitoVarreduraSimplesImgs(j,j_aux){ 	
	controlaVarredura = 1;	
	var atual;
	atual = document.getElementById(VetorVarreduraImagens[j]);
	atual.style.border = "solid 2px transparent";
	setTimeout("varreduraSimplesSelecionarImgs("+j+",0,"+j_aux+")",20);
	return;
}

function selecionarEspacoNaPranchaAux(){
	varredura_atual = 'selecaoEspacoPrancha';
	estadoVarreduraPrancha = 0;
		
	if (VetorVarreduraImagens[menu_atual] == "voltar_escolher_img")location.href="index.php?varAtual=menu_inferior";
	else if (VetorVarreduraImagens[menu_atual] == "escolher_mais_img") location.href="visualizarImagensVarredura.php?categoria=-1&maisImgs=1";	
	else if (VetorVarreduraImagens[menu_atual] == "escolher_menos_img") location.href="visualizarImagensVarredura.php?categoria=-1&maisImgs=-1";	
	else if (VetorVarreduraImagens[menu_atual] == "cancelar_selecao"){
			varredura_atual = "selecaoImgComplexa";
			document.getElementById("cancelar_selecao").style.display = "none";
		}
	else location.href="index.php?idImgVar="+VetorVarreduraImagens[menu_atual]+"&tempo="+tempoVarredura;
}

//'menu_inferior' 'dialog_layout' 'pag_visualizar' 'categorias' 'selecaoImgComplexa''selecaoImgSimples' 'selecaoEspacoPrancha'
function SelecionaEspacoNaPrancha(jMax,tempo,j){

		j++;
	   	
		tempoVarredura = tempo;
		
		if (j == jMax) j = 0;
		 
		if (estadoVarreduraPrancha == 1){			
			return;
		}
		
		menu_atual = j;	

		document.getElementById(VetorVarreduraPranchas[j]).style.border = "1px solid "+cor;
		executarSom("som_de_varredura2");
		setTimeout("DesfazerSelecionaEspacoNaPrancha("+jMax+","+j+","+tempo+")",tempo);	
}

function DesfazerSelecionaEspacoNaPrancha(jMax,j,tempo){ 	
	controlaVarredura = 1;	
	var atual;
	atual = document.getElementById(VetorVarreduraPranchas[j]);
	atual.style.border = "1px dashed #aaa";
	setTimeout("SelecionaEspacoNaPrancha("+jMax+","+tempo+","+j+")",10);
	return;
}

function colocarImgSelecionadaNaPrancha(){
	var ocupada = 0;

	if (ocupada == 1) 
		jConfirm('o Conteudo desta prancha sera apagado, deseja continuar?','Aviso', function(r){ 
			if (r) inserirNaPranchaAuxVarredura(ocupada);
		});	
	else
		inserirNaPranchaAuxVarredura(ocupada); 
}

function inserirNaPranchaAuxVarredura(ocupada){
	zerarSelecao(); //zera a seleção
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "inserir_imagem_prancha.php?id_imagem=" + idImagemVarredura + "&prancha=" +menu_atual, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa variável (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
	menu_atual = -3;
	setTimeout("escolherImagemVarredura()",1000);
}

function salvar_prancha_varredura(tipo, nome){
	tela_carregar_ajax('Sua prancha esta sendo salva. Aguarde...');
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "salvar_prancha.php?tipo=" + tipo + "&nome=" + nome, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						fechar_tela_carregar_ajax();
						msgOver("Prancha Salva!", 1);
						location.href="index.php?varAtual=menu_inferior";
					}
				}
			}
			ajax.send(null); // submete
	}	
}

/* 	VARREDURA HISTÓRIA */
var VetorVarreduraMenuHistoria = new Array ("abrir", "salvar_varredura", "desfaz", "importar","exportar","imprime","escolher_layout","visualizar","limpar","ajuda","sair","categorias","seta_dir_barra_layout","seta_esq_barra_layout");

function IniciarVarreduraHistoria(array, tempo){
	tamanhoArray = array.size();

	for(i=0; i<=tamanhoArray; i++){
		
	}

}
