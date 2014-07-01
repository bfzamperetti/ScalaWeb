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

function selecionarPranchasNaLista(idp, tipop){
	if (document.frm_abrir_prancha.id.value != "")
		document.getElementById("prancha_lista_pranchas"+document.frm_abrir_prancha.id.value).style.background = "#a0c544";   
	document.frm_abrir_prancha.id.value = idp; 
	document.frm_abrir_prancha.tipo.value = tipop;
	document.getElementById("prancha_lista_pranchas"+idp).style.background = "#ccc";
}

function pesquisa_lista_prancha(termo, tipo,  iddiv ){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById(iddiv); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "pesquisar_lista_pranchas.php?tipo=" + tipo + "&termo=" + termo, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
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
}	

function escolherCatImagens(n, n2){
	if(document.frm_esq_itens.tipo_lista_imagens.value!=n){ 
		document.frm_esq_itens.tipo_lista_imagens.value = n;
		carregandoListaImagens(); 
		if (buscarImgs(n2)) if (buscarImgs(n2)) buscarImgs(n2); //chama 3 vezes para corrigir um bug (se chamar apenas uma vez, mostra apenas a metade da lista.)
	} 
	else { 
		document.frm_esq_itens.tipo_lista_imagens.value = '0'; 
		zerarSelecao(); 
		buscarImgs(1000); 
	}
}

function carregandoListaImagens(){
		document.getElementById('lista_imgs').innerHTML = '<div style="top: 50px; width: 24px; height: 24px; position: relative;" ><img src="imagens/site/carregando2.gif" width="24px" height="24px"  /></div>'; 
}

function apagar_prancha_lista(id){
	if (!confirm('A prancha sera apagada definitivamente, deseja continuar?')) return;
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

// Função que realiza consulta das imagens php e retorna texto no objeto passado (div)
function buscarImagens(categoria, id_div) {
	zerarSelecao();
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById(id_div); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "desenha_lista_imagens.php?cat=" + categoria, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
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
}	// JavaScript Document

// Função que insere prancha sobre prancha 
function inserePranchaPrancha(pranchaorigem, pranchadestino, ocupada) {
	if (ocupada == 1) if (!confirm('o Conteudo desta prancha sera apagado, deseja continuar?')) return; // se a prancha estiver ocupada e a resposta da mensagem for não, ele sai da função
	zerarSelecao();
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "insere_prancha_prancha.php?pranchaorigem=" + pranchaorigem + "&pranchadestino=" +pranchadestino, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
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
}	// JavaScript Document


function novoLayout(tipo) {
	if (selecaoGlobal.tipo == 2)
		zerarSelecao();
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "verificarnovolayout.php?tipo_novo_layout=" + tipo, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
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
}	// JavaScript Document

function mudarQuadro(direcao) {
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "mudar_de_quadro.php?direcao=" + direcao, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
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
}	// JavaScript Document

function selecionar(id, tipo){
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
	if (ocupada == 1) if (!confirm('o Conteudo desta prancha sera apagado, deseja continuar?')) return; // se a prancha estiver ocupada e a resposta da mensagem for não, ele sai da função
	zerarSelecao(); //zera a seleção
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "inserir_imagem_prancha.php?id_imagem=" + idImagem + "&prancha=" +prancha, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
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
}

function removerPrancha(){
	if (!confirm('O conteudo desta prancha sera apagado, deseja continuar?')) return; // se a prancha estiver ocupada e a resposta da mensagem for não, ele sai da função
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "remover_prancha.php?id=" + selecaoGlobal.id, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
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
	zerarSelecao();
}

function sintetizarNomePrancha(){
	document.getElementById('sintetizador_de_som').innerHTML = '<iframe src="sintetizar_som_prancha.php?id='+selecaoGlobal.id+'" style="display:none;"></iframe>';
}

function sintetizarVisualizar(){
	document.getElementById('sintetizador_de_som').innerHTML = '<iframe src="reproduzir_visualizar.php" style="display:none;"></iframe>';
}

function salvar(){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "criarArquivo.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(ajax.status == 200) {
						var resultado = ajax.responseText; // Coloca o resultado (da busca) retornado pelo Ajax nessa variável (var resultado).
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
		var exibeResultado = document.getElementById('dialog_visualizar'); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "montar_visualizacao.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
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
}

function montarListaDePranchas(){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('dialog_abrirArquivo'); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "montarListaDePranchas.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
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
}

function desfazer(){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			ajax.open("GET", "desfazer.php", true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
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
	zerarSelecao();
}

function alterarLegenda(novalegenda){
	if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById('centro'); // div que exibirá o resultado da busca.
			var ajax = openAjax(); // Inicia o Ajax.
			novalegenda = novalegenda.toUpperCase();
			ajax.open("GET", "alterarLegenda.php?idprancha="+ selecaoGlobal.id +"&novalegenda="+novalegenda, true); // Envia o termo da busca como uma querystring, nos possibilitando o filtro na busca.
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



