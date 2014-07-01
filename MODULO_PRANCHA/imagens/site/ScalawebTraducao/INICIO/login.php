<div style="position: absolute; left:0; top:0; height: 70px;">
	<a href="http://www.ufrgs.br/"><img src="imagens/site/ufrgs.gif" alt="ufrgs" height="70px" border=0 /></a>
</div>
<div id="frmlogin" class="log_form">
	<a onclick="javascript: location.href='index.php?pag=equipe'" href="javascript: void(0);">
		<div class="link_equipe"> 
			<img src="imagens/site/equipe.gif" width="20px" height="20px" border=0 alt="Equipe Scalaweb" /> 
			<?php echo $_str['lblTeam']; ?> Scalaweb
		</div>
	</a>
	<form name="frm_login" action="logar.php" method="post">
	<fieldset style="border: 0;">
	<table style="float: right;">
		<tr>
			<td>
				<label for="login"><?php echo $_str['lblLogin']; ?>:</label>
			</td>
			<td>
				<input type="text" name="login" id="login" class="inputs" />
			</td>
			<td>
				<label for="senha"><?php echo $_str['lblPassword']; ?>:</label>
			</td>
			<td>
				<input type="password" name="senha" id="senha" value="" class="inputs" />
			</td>
			<td>
				<a class="log_capa" href="javascript: document.frm_login.submit();" ></a>
			</td>
		</tr>
		<tr><td></td><td></td><td></td>
		<td>
			<a href="index.php?pag=esqueci_dados" style="color: #fff; text-decoration: underline; font-size: 9px; float: right;"><?php echo $_str['lblForgotData']; ?></a>
		</td>
		</tr>
	</table>
	</fieldset>
	</form>
</div>
</div>
<script type="text/javascript">
</script>



