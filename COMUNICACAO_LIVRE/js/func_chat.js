<script type="text/javascript">
    function envia(){
		document.frm_escrever.escrever.value = document.getElementById('chat_mensagem').innerHTML;
		document.frm_escrever.submit();
	}
	function appendImg(obj){
		window.alert(obj);
	}
</script>

<script type="text/javascript" language="javascript">
$(function($) {
	$("#frm_escrever").submit(function() {
		var mensagem = $("#escrever").val();
		$.post('envia_mensagem.php', {mensagem: mensagem }, function(resposta) {
					$("#escrever").val("");
		});
	});
});
</script>



<script type="text/javascript">
	function limpa(){
	
		document.getElementById("chat_mensagem").innerHTML=""; 

	};
</script>

<script>	
	setInterval(function() {
	$("#chat_frases_montadas").load("mostra_frases_montadas.php");
	}, 1000);
</script>
