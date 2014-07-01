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


/* FUNCOES SCALA PRANCHA */
function selecionarPranchasNaLista(idp, tipop){
	if (document.frm_abrir_prancha.id.value != "")
		document.getElementById("prancha_lista_pranchas"+document.frm_abrir_prancha.id.value).style.background = "#a0c544";   
	document.frm_abrir_prancha.id.value = idp; 
	document.frm_abrir_prancha.tipo.value = tipop;
	document.getElementById("prancha_lista_pranchas"+idp).style.background = "#ccc";
}

function tela_carregar_ajax(texto){
	$('#div-carregamento-pagina').show();
	document.getElementById('div-carregamento-pagina-content').innerHTML='<div style="background: #fff; padding: 10px; z-index: 9999999; top: 50%; margin-top: -100px; left: 50%; margin-left: -100px; width: 200px; position: absolute;" > '+texto+' <br/><img src="imagens/site/carregando.gif" width="200px" /></div>';
}

function fechar_tela_carregar_ajax(){
	$('#div-carregamento-pagina').hide();
}

function msgOver(texto, delay){
	$('#div-carregamento-pagina').show();
	document.getElementById('div-carregamento-pagina-content').innerHTML='<div style="background: #fff; padding: 10px; z-index: 9999999; margin: 0 auto; top: 200px; display: table; position: relative;" > '+texto+' </div>';
	setTimeout("$('#div-carregamento-pagina').fadeOut('fast')", delay*1000);
}


function pesquisa_lista_prancha(termo, tipo,  iddiv ){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById(iddiv); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "pesquisar_lista_pranchas.php?tipo=" + tipo + "&termo=" + termo, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
}	

function verificarSeTemSom(){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('div_verificar_se_tem_som'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "verificar_se_tem_som.php?id_prancha=" + selecaoGlobal.id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
						$('#dialog_upload_som').dialog('open');
					}
				}
			}
			ajax.send(null); // submete
	}
}

function apagarSom(id){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('div_verificar_se_tem_som'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "apagar_som.php?id=" + id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
						jAlert("Som Apagado, agora o som da imagem vai ser a sua legenda!","Alerta de som");
						$('#dialog_upload_som').dialog('close');
					}
				}
			}
			ajax.send(null); // submete
	}
}	

function apagar_minha_img(id){
	jConfirm('A imagem sera removida definitivamente, deseja continuar?', 'Aviso de Imagem', function(r){ 
		if (r){
			if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
					var ajax = openAjax(); // Inicia o Ajax.
					ajax.open("GET", "apagar_minha_imagem.php?id=" + id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
					ajax.onreadystatechange = function() {
						if(ajax.readyState == 4) { // Quando estiver tudo pronto.
							if(ajax.status == 200) {
								var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
								document.frm_esq_itens.tipo_lista_imagens.value = 1000;
								zerarSelecao();
								escolherCatImagens(8,0);
							}
						}
					}
					ajax.send(null); // submete
			}
		}
	});
}	

function buscarImgs(cat){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
			var ajax = openAjax(); // Inicia o Ajax.
			var exibeResultado = document.getElementById('listarImagens'); // div que exibir� o resultado da busca.
			ajax.open("GET", "desenha_lista_imagens.php?cat=" + cat, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
}	
	
function escolherCatImagens(n, n2){
	if(document.frm_esq_itens.tipo_lista_imagens.value!=n){
		document.frm_esq_itens.tipo_lista_imagens.value = n;
		buscarImgs(n2);
	} 
	else { 
		document.frm_esq_itens.tipo_lista_imagens.value = '0'; 
		zerarSelecao(); 
		buscarImgs(1000); 
	}
}

function escolherCatImagensHist(n, n2){
	if(document.frm_esq_itens.tipo_lista_imagens.value!=n){
		document.frm_esq_itens.tipo_lista_imagens.value = n;
		buscarImgs(n2); 
	} 
	else { 
		document.frm_esq_itens.tipo_lista_imagens.value = '0'; 
		zerarSelecaoHist(); 
		buscarImgs(1000); 
	}
}

function mostrarListaTextos(n){
	if(document.frm_esq_itens.tipo_lista_imagens.value!=n){
		document.frm_esq_itens.tipo_lista_imagens.value = n;
		buscarTextos();
	} 
	else { 
		document.frm_esq_itens.tipo_lista_imagens.value = '0'; 
		zerarSelecaoHist(); 
		buscarImgs(1000); 
	}
}

function carregandoListaImagens(){
		document.getElementById('lista_imgs').innerHTML = '<div style="top: 50px; width: 24px; height: 24px; position: relative;" ><img src="imagens/site/carregando2.gif" width="24px" height="24px"  /></div>'; 
}

function exportarPDF(msg){
	tela_carregar_ajax(msg);
	setTimeout("fechar_tela_carregar_ajax()",10000);
	location.href = 'exportar_pdf.php';	
}

function apagar_prancha_lista(id){
	jConfirm('A prancha sera apagada definitivamente, deseja continuar?','Aviso de prancha', function(r){
		if (r){
			if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
					var ajax = openAjax(); // Inicia o Ajax.
					ajax.open("GET", "apagar_prancha_lista.php?id=" + id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
					ajax.onreadystatechange = function() {
						if(ajax.readyState == 4) { // Quando estiver tudo pronto.
							if(ajax.status == 200) {
								document.getElementById("prancha_lista_pranchas"+id).style.display = 'none';
								var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
							}
						}
					}
					ajax.send(null); // submete
			}
		}
	});
}

	

// Fun��o que realiza consulta das imagens php e retorna texto no objeto passado (div)
function buscarImagens(categoria, id_div) {
	zerarSelecao();
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById(id_div); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "desenha_lista_imagens.php?cat=" + categoria, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
}	// JavaScript Document

function buscarTextos(){
	zerarSelecao();
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('listarImagens'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "desenha_lista_textos.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
}	// JavaScript Document

// Fun��o que insere prancha sobre prancha 
function inserePranchaPrancha(pranchaorigem, pranchadestino, ocupada) {
	if (ocupada == 1) 
		jConfirm('o Conteudo desta prancha sera apagado, deseja continuar?','Aviso', function(r){ 
			if (r) inserePranchaPranchaAux(pranchaorigem, pranchadestino, ocupada);
		});	
	else
		inserePranchaPranchaAux(pranchaorigem, pranchadestino, ocupada);
}	// JavaScript Document

function inserePranchaPranchaAux(pranchaorigem, pranchadestino, ocupada) {
	zerarSelecao();
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibir� o resultado da busca.
		var ajax = openAjax(); // Inicia o Ajax.
		ajax.open("GET", "insere_prancha_prancha.php?pranchaorigem=" + pranchaorigem + "&pranchadestino=" +pranchadestino, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
		ajax.onreadystatechange = function() {
			if(ajax.readyState == 4) { // Quando estiver tudo pronto.
				if(ajax.status == 200) {
					var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
					exibeResultado.innerHTML = resultado;
				}
			}
		}
		ajax.send(null); // submete
	}
}

function novoLayout(tipo) {
	if (selecaoGlobal.tipo == 2)
		zerarSelecao();
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "verificarnovolayout.php?tipo_novo_layout=" + tipo, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
						eval(resultado);
					}
				}
			}
			ajax.send(null); // submete
	}
}	// JavaScript Document

function mudarQuadro(direcao) {
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "mudar_de_quadro.php?direcao=" + direcao, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;

					}
				}
			}
			ajax.send(null); // submete
	}
}	// JavaScript Document

function selecionar(id, tipo){
	if ((selecaoGlobal.tipo == 1) && (selecaoGlobal.id == id)){
		zerarSelecao();
		return;
	}
	zerarSelecao();
	selecaoGlobal.id = id;
	selecaoGlobal.tipo = tipo;
	if (selecaoGlobal.tipo == 1){ //se for imagem
		document.getElementById("qdr_imagem_lista"+selecaoGlobal.id).style.background = '#eee';
		document.getElementById("qdr_imagem_lista"+selecaoGlobal.id).style.border = '1px dashed #fff';
	}
	else //se for prancha
		document.getElementById("prancha"+selecaoGlobal.id).style.background = '#eee';
	
}

function inserirNaPrancha(idImagem, prancha, ocupada){
	if (ocupada == 1) 
		jConfirm('o Conteudo desta prancha sera apagado, deseja continuar?','Aviso', function(r){ 
			if (r) inserirNaPranchaAux(idImagem, prancha, ocupada);
		});	
	else
		inserirNaPranchaAux(idImagem, prancha, ocupada);
}

function inserirNaPranchaAux(idImagem, prancha, ocupada){
	zerarSelecao(); //zera a sele��o
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "inserir_imagem_prancha.php?id_imagem=" + idImagem + "&prancha=" +prancha, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
}


function salvar_prancha(tipo, nome){
	tela_carregar_ajax('Sua prancha esta sendo salva. Aguarde...');
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "salvar_prancha.php?tipo=" + tipo + "&nome=" + nome, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						fechar_tela_carregar_ajax();
						msgOver("Prancha Salva!", 1);
					}
				}
			}
			ajax.send(null); // submete
	}	
}


function removerPrancha(){
	jConfirm('O conteudo desta prancha sera apagado, deseja continuar?','Aviso',function(r){
		if (r){
			if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
				var exibeResultado = document.getElementById('centro'); // div que exibir� o resultado da busca.
					var ajax = openAjax(); // Inicia o Ajax.
					ajax.open("GET", "remover_prancha.php?id=" + selecaoGlobal.id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
					ajax.onreadystatechange = function() {
						if(ajax.readyState == 4) { // Quando estiver tudo pronto.
							if(ajax.status == 200) {
								var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
								exibeResultado.innerHTML = resultado;
							}
						}
					}
					ajax.send(null); // submete
			}
			zerarSelecao();
		}
	});
}

function sintetizarNomePrancha(){
	alert(selecaoGlobal.id);
	document.getElementById('sintetizador_de_som').innerHTML = '<iframe src="sintetizar_som_prancha.php?id='+selecaoGlobal.id+'" style="display:block; border:0; position: absolute;"></iframe>';
}

function repPrancha(n){
	document.getElementById('sintetizador_de_som').innerHTML = '<iframe src="sintetizar_som_prancha.php?id='+n+'" style="display:block; border:0; position: absolute;"></iframe>';
}

function sintetizarVisualizar(){
	document.getElementById('sintetizador_de_som').innerHTML = '<iframe src="reproduzir_visualizar.php"  style="display:block; border:0;  position: absolute;"></iframe>';
}

function salvar_arquivo(){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "criarArquivo.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						location.href = 'download.php?arquivo='+ resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
}

	
function printDiv(id, pg) {
	var oPrint, oJan;
	oPrint = window.document.getElementById(id).innerHTML;
	oJan = window.open(pg);
	oJan.document.write("<html><head><link href='styles/geral.css' rel='stylesheet' type='text/css' /></head><body>");
	oJan.document.write(oPrint);		
	oJan.document.write("</body></html>");
	oJan.window.print();
	oJan.document.close();
	oJan.focus();
}

function montarVisualizacao(){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('dialog_visualizar'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "montar_visualizacao.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
}

function montarListaDePranchas(){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('dialog_abrirArquivo'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "montarListaDePranchas.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
}

function desfazer(){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "desfazer.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
	zerarSelecao();
}

function alterarLegenda(novalegenda){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			novalegenda = novalegenda.toUpperCase();
			ajax.open("GET", "alterarLegenda.php?idprancha="+ selecaoGlobal.id +"&novalegenda="+novalegenda, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
	zerarSelecao();
}

function zerarSelecao(){
	if (selecaoGlobal.id != -1000 )
		if (selecaoGlobal.tipo == 1){ //se for imagem
		  document.getElementById("qdr_imagem_lista"+selecaoGlobal.id).style.background = 'transparent'; // desselecionar a anterior
		  document.getElementById("qdr_imagem_lista"+selecaoGlobal.id).style.border = '1px dashed transparent';	
		}
		else{ //se for prancha
		  document.getElementById("prancha"+selecaoGlobal.id).style.background = '#ccc'; // desselecionar a anterior
		  fecharOpcoesPrancha();
		}
	selecaoGlobal.id = -1000;
	selecaoGlobal.tipo = 0;
}

function clickPrancha(idPrancha, ocupada){
	if (selecaoGlobal.id != -1000 && selecaoGlobal.tipo == 1){ 
		inserirNaPrancha(selecaoGlobal.id, idPrancha , ocupada);
	}
	else if (selecaoGlobal.id != -1000 && selecaoGlobal.tipo == 2 && selecaoGlobal.id != idPrancha) {
		inserePranchaPrancha(selecaoGlobal.id, idPrancha , ocupada); 
	}
	else if (selecaoGlobal.id == idPrancha && selecaoGlobal.tipo == 2){
		zerarSelecao();
	}
	else if (ocupada == 1){
		selecionar(idPrancha, 2);
		abrirOpcoesPrancha();
	}
}

function redimensionar(){
		location.href='index.php'; 
	}
	

function varGlobal(id, tipo) {
	this.id = id;
	this.tipo = tipo; // 1 -> imagem, 2 -> Prancha / imgusada(HISTORIA)
}	
	

/* FUNCOES SCALAHISTORIA */
function entrarQuadrinho(quadrinho){
	location.href="gerarCancelar.php?id="+quadrinho;
}

function novoLayoutHistoria(tipo) {
	if (selecaoGlobal.tipo == 2)
		zerarSelecao();
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "verificarnovolayout.php?tipo_novo_layout=" + tipo, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;

					}
				}
			}
			ajax.send(null); // submete
	}
}	// JavaScript Document

function insereImagemQuadrinho(X,Y) {
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('tela_quadrinho'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "insere_imagem_quadrinho.php?left=" + (X-5) + "&top=" + (Y-5) + "&id=" + selecaoGlobal.id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
	zerarSelecaoHist();
}	

function zerarSelecaoHist(){
	if (!permissao_para_selecionar) return;
	if (selecaoGlobal.id != -1000 )
		if (selecaoGlobal.tipo == 1){ //se for imagem
		  document.getElementById("qdr_imagem_lista"+selecaoGlobal.id).style.background = 'transparent'; // desselecionar a anterior
		  document.getElementById("qdr_imagem_lista"+selecaoGlobal.id).style.border = '1px dashed transparent';	
		}
		else if (selecaoGlobal.tipo == 2){ //se for imgQuad
		  document.getElementById("imgQuad"+selecaoGlobal.id).style.background = 'transparent'; // desselecionar a anterior
		  document.getElementById("imgQuad"+selecaoGlobal.id).style.border = '1px dashed transparent';
		  fecharOpcoesImgQuad();	 
		}
	selecaoGlobal.id = -1000;
	selecaoGlobal.tipo = 0;
}

function selecionarHist(id, tipo){
	if (!permissao_para_selecionar) return;
	if ((selecaoGlobal.tipo == 1) && (selecaoGlobal.id == id)){
		zerarSelecaoHist();
		return;
	}
	zerarSelecaoHist();
	selecaoGlobal.id = id;
	selecaoGlobal.tipo = tipo;
	if (selecaoGlobal.tipo == 1){ //se for imagem
		document.getElementById("qdr_imagem_lista"+selecaoGlobal.id).style.background = '#eee';
		document.getElementById("qdr_imagem_lista"+selecaoGlobal.id).style.border = '1px dashed #fff';
	}
	else if (selecaoGlobal.tipo == 2){ //se for imgQuad
		document.getElementById("imgQuad"+selecaoGlobal.id).style.background = '#eee';
		document.getElementById("imgQuad"+selecaoGlobal.id).style.border = '1px dashed #fff';
		abrirOpcoesImgQuad();
	}
}

function concluirQuadrinho(){
	location.href='index.php';
}

function limparQuadrinho() {
	permissao_para_selecionar = true;
	jConfirm("Tem certeza que deseja apagar permanentemente o conteudo deste quadrinho?","Aviso", function(r){
		if (r){
			zerarSelecaoHist();
			if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
				var exibeResultado = document.getElementById('tela_quadrinho'); // div que exibir� o resultado da busca.
					var ajax = openAjax(); // Inicia o Ajax.
					ajax.open("GET", "limpar_quadrinho.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
					ajax.onreadystatechange = function() {
						if(ajax.readyState == 4) { // Quando estiver tudo pronto.
							if(ajax.status == 200) {
								var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
								exibeResultado.innerHTML = resultado;
							}
						}
					}
					ajax.send(null); // submete
			}
		}
	});
}

function trocaLugarImagemQuadrinho(X,Y) {
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('tela_quadrinho'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "troca_lugar_img_quadrinho.php?left="+X+"&top="+Y+"&id="+selecaoGlobal.id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
}

function salvar_hist(tipo, nome){
	tela_carregar_ajax('Sua Hist&oacute;ria esta sendo salva. Aguarde...');
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "salvar_hist.php?tipo=" + tipo + "&nome=" + nome, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						fechar_tela_carregar_ajax();
						msgOver("Hist&oacute;ria Salva!", 1);
					}
				}
			}
			ajax.send(null); // submete
	}	
}

function salvar_arquivo_hist(){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "criarArquivo.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						location.href = 'download.php?arquivo='+ resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
}

function montarListaDeHist(){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('dialog_abrirArquivo'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "montarListaDeHist.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
}

function pesquisa_lista_hist(termo, tipo,  iddiv ){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById(iddiv); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "pesquisar_lista_hist.php?tipo=" + tipo + "&termo=" + termo, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
}	

function selecionarHistNaLista(idp, tipop){
	if (document.frm_abrir_hist.id.value != "")
		document.getElementById("hist_lista_"+tipop+"_hist"+document.frm_abrir_hist.id.value).style.background = "#a0c544";   
	document.frm_abrir_hist.id.value = idp; 
	document.frm_abrir_hist.tipo.value = tipop;
	document.getElementById("hist_lista_"+tipop+"_hist"+idp).style.background = "#ccc";
}

function apagar_hist_lista(id){
	jConfirm('A historia sera apagada definitivamente, deseja continuar?','Aviso',function(r){
		if (r){
			if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
					var ajax = openAjax(); // Inicia o Ajax.
					ajax.open("GET", "apagar_hist_lista.php?id=" + id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
					ajax.onreadystatechange = function() {
						if(ajax.readyState == 4) { // Quando estiver tudo pronto.
							if(ajax.status == 200) {
								document.getElementById("hist_lista_hist"+id).style.display = 'none';
								var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
							}
						}
					}
					ajax.send(null); // submete
			}
		}
	});
}

function ampliarEReduzir(tam) {
	if (!permissao_para_selecionar) return;
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('tela_quadrinho'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "ampliarereduzir.php?tam="+tam+"&id="+selecaoGlobal.id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
						var id = selecaoGlobal.id;
						zerarSelecaoHist();	
						selecionarHist(id, 2);
					}
				}
			}
			ajax.send(null); // submete
	}
}

function mudarAngulo(ang) {
	if (!permissao_para_selecionar) return;
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('tela_quadrinho'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "mudarangulo.php?ang="+ang+"&id="+selecaoGlobal.id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
						var id = selecaoGlobal.id;
						zerarSelecaoHist();	
						selecionarHist(id, 2);
					}
				}
			}
			ajax.send(null); // submete
	}
}

function mudarProf(prof) {
	if (!permissao_para_selecionar) return;
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('tela_quadrinho'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "mudarprofundidade.php?prof="+prof+"&id="+selecaoGlobal.id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						var res = resultado.split("quebrarParaAjustarQuadroSelecionado");
						if (typeof(res[1]) != 'undefined'){
							exibeResultado.innerHTML = res[1];
							zerarSelecaoHist();	
							selecionarHist(res[0], 2);
						}
						else{
							exibeResultado.innerHTML = resultado;
							var id = selecaoGlobal.id;
							zerarSelecaoHist();	
							selecionarHist(id, 2);
						}
					}
				}
			}
			ajax.send(null); // submete
	}
}

function mudarCorCenario(cor) {
	if (!permissao_para_selecionar) return;
	zerarSelecaoHist();	
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('tela_quadrinho'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "mudar_cor_cenario.php?cor="+cor, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
	$('#dialog_escolher_cor_cenario').dialog('close');
	$('#dialog_cenario').dialog('close');
}

function mudarImagemCenario(urlimg) {
	if (!permissao_para_selecionar) return;
	zerarSelecaoHist();	
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('tela_quadrinho'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "mudar_imagem_cenario.php?img="+urlimg, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
	$('#dialog_escolher_imagem_cenario').dialog('close');
	$('#dialog_cenario').dialog('close');
}

function inverter() {
	if (!permissao_para_selecionar) return;
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('tela_quadrinho'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "inverter.php?id="+selecaoGlobal.id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
						var id = selecaoGlobal.id;
						zerarSelecaoHist();	
						selecionarHist(id, 2);
					}
				}
			}
			ajax.send(null); // submete
	}
}

function excluirImgQuad() {
	if (!permissao_para_selecionar) return;
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('tela_quadrinho'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "excluir_imgquad.php?id="+selecaoGlobal.id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
	zerarSelecaoHist();					
}

function alterarNarracao(texto) {
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('narracao'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "alterar_narracao.php?texto="+texto, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}		
}

function clickImgQuad(idImgQuad){
	if ((selecaoGlobal.id == idImgQuad) && (selecaoGlobal.tipo == 2)) { 
		zerarSelecaoHist();
	}
	else if (selecaoGlobal.id == -1000){
		selecionarHist(idImgQuad, 2);
	}
	else
		selecaoGlobal.tipo = -selecaoGlobal.tipo; //controle para nao entrar na fun��o de clique da tela ao mesmo tempo 
	selecaoGlobal.tipo = -selecaoGlobal.tipo; //controle para nao entrar na fun��o de clique da tela ao mesmo tempo 
}

function cancelarQuadrinho(){
	location.href='cancelar.php';
}

function desfazerQuadrinho(){
	if (!permissao_para_selecionar) return;
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('tela_quadrinho'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "verificaDesfazer.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
	zerarSelecaoHist();
}

function sintetizarVisualizarHist(){
	document.getElementById('sintetizador_de_som').innerHTML = '<iframe src="reproduzir_visualizar.php"  style="display:block; border:0;  position: absolute;"></iframe>';
}

function alterarTextoBalao(novotexto) {
	permissao_para_selecionar = true;
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('tela_quadrinho'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "alterar_texto_balao.php?id="+selecaoGlobal.id+"&texto="+novotexto, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
						var id = selecaoGlobal.id;
						zerarSelecaoHist();	
						selecionarHist(id, 2);
					}
				}
			}
			ajax.send(null); // submete
	}
}

function montarVisualizacaoHist(){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('dialog_visualizar'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "montar_visualizacao.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
}

function montarAlterarTextoBalao() {
	permissao_para_selecionar = false;
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('texto_balao'+selecaoGlobal.id); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "montar_alterar_texto_balao.php?id="+selecaoGlobal.id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						exibeResultado.innerHTML = resultado;
					}
				}
			}
			ajax.send(null); // submete
	}
}

function sintetizarNarracao(){
	document.getElementById('sintetizador_de_som').innerHTML = '<iframe src="sintetizar_narracao.php" style="display:block; border:0; width:10px; height: 10px; position: absolute;"></iframe>';
}

function apagar_minha_img_hist(id){
	if (!permissao_para_selecionar) return;
	jConfirm('A imagem sera removida definitivamente, deseja continuar?','Aviso',function(r){
		if (r){
			if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
					var ajax = openAjax(); // Inicia o Ajax.
					ajax.open("GET", "apagar_minha_imagem.php?id=" + id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
					ajax.onreadystatechange = function() {
						if(ajax.readyState == 4) { // Quando estiver tudo pronto.
							if(ajax.status == 200) {
								var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
								document.frm_esq_itens.tipo_lista_imagens.value = 1000;
								zerarSelecaoHist();
								escolherCatImagensHist(8,0);
							}
						}
					}
					ajax.send(null); // submete
			}
		}
	});
}	

function abrirOpcoesImgQuad(){
		if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('dialog_opcoes_imgquad'); // div que exibir� o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "montar_texto_img_quad.php?id="+selecaoGlobal.id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						if (resultado != '')
							eval(resultado);
					}
				}
			}
			ajax.send(null); // submete
		}
		document.getElementById("aumentaquad").style.display = "block";
		document.getElementById("diminuiquad").style.display = "block";
		document.getElementById("frentequad").style.display = "block";
		document.getElementById("atrasquad").style.display = "block";
		document.getElementById("girarquad").style.display = "block";
		document.getElementById("inverterquad").style.display = "block";
		document.getElementById("excluirquad").style.display = "block";
}

function fecharOpcoesImgQuad(){
		document.getElementById("textoquad").style.display = "none";
		document.getElementById("aumentaquad").style.display = "none";
		document.getElementById("diminuiquad").style.display = "none";
		document.getElementById("frentequad").style.display = "none";
		document.getElementById("atrasquad").style.display = "none";
		document.getElementById("girarquad").style.display = "none";
		document.getElementById("inverterquad").style.display = "none";
		document.getElementById("excluirquad").style.display = "none";
}

function exportarPDF_hist(){
	tela_carregar_ajax("Aguarde. A Hist&oacute;ria esta sendo gerada...");
	setTimeout("fechar_tela_carregar_ajax()",10000);
	location.href = 'criar_pasta_exportar.php';	
}


