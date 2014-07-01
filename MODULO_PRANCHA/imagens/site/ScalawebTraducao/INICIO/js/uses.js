var imagem = new Image();
imagem.src = "images/c_bp.png";
var imagem2 = new Image();
imagem2.src = "images/c_b.png";

function abreFecha(id) {
	alvo=document.getElementById('cont'+id);
	m=document.getElementById('m'+id);
	if (alvo.style.display == 'none') {
		alvo.style.display = '';
		m.innerHTML='Esconder (-)';
	}
	else {
		alvo.style.display = 'none';
		m.innerHTML='Mostrar (+)';
	}
}

function limpa(id) {
			document.getElementById(id).value='';
			document.getElementById(id).style.color='#000';			
		}
		
function contacaracteres() {
document.getElementById("carac").innerHTML=document.getElementById("resposta").value.length;
}

function pular() {
	if (confirm("Deseja realmente pular esta questao? Voce nao podera mais voltar para responde-la!")) {	
		document.pular.submit();
		carregar();
	}
}

	function validaForm(){
		d = document.cadastro;
		if (d.nome.value == "") {
			alert("O campo cadastro da Equipe deve ser preenchido!");
			carregou();
			return false;			
		}		
		if (d.login.value == "") {
			alert("O campo login da Equipe deve ser preenchido!");
			carregou();
			return false;			
		}
		if (d.senha1.value == "") {
			alert("O campo senha da Equipe deve ser preenchido!");
			carregou();
			return false;			
		}
		if ((d.turma1.value == d.turma2.value) || (d.turma1.value == d.turma3.value) || (d.turma3.value == d.turma2.value))
		{
			alert("Os alunos precisam ser de turma diferentes!");
			carregou();
			return false;			
		}
		if (d.senha1.value != d.senha2.value) {
			alert("As senhas nao conferem!");
			carregou();
			return false;			
		}
		if ((d.nome1.value == "") || (d.nome2.value == "") || (d.nome3.value == "") || (d.email1.value == "") || (d.email2.value == "") || (d.email3.value == "")) {
			alert("Informe todos os dados dos participantes!");
			carregou();
			return false;			
		}
		
      return true;
	}

//barra de status
var load;
var l=0;
function carregou() {
	clearInterval(load); 
	document.getElementById('carregando').style.display='none';
}
function carregar() {
	document.getElementById('carregando').style.display='';
	load=setInterval(function() {	
	l+=1;
	if (l>5) l=1;
	if ($('#loading'+l).css('background-color')=='rgb(204, 204, 204)')
		document.getElementById('loading'+l).style.background='#46A';
	else
		document.getElementById('loading'+l).style.background='#CCC';	
	
	},350);
}

//pagina de contato
function validaContato() {
	d = document.contato;
	
	if ((d.nome.value == '') || (d.email.value == '') || (d.assunto.value == '') || (d.mensagem.value == '')) {
		alert("Preencha todas as informações!");
		carregou();
		return false;
	}
	
	if (d.email.value.indexOf('@') < 1) {
		alert("Este endereço de e-mail não válido!");
		carregou();
		return false;
	}
}
