<a href="changeLanguage.php?language=ptbr"><img src="imagens/site/language_ptbr.jpg" /></a>
<a href="changeLanguage.php?language=es"><img src="imagens/site/language_es.png" /></a>
<a href="changeLanguage.php?language=en"><img src="imagens/site/language_en.png" /></a>
<div class="logo_scala_capa">
	<img src="imagens/site/logo_transp.png" alt="logo do scala" width="360px;"/>
	<iframe src="../INCLUDES/termos_de_uso.html" style="margin-top: 5px; border: 1px dashed #115511;" width="100%" height="155px;"></iframe>
	<!--<iframe src="termos_de_uso_scala.pdf" width="100%" frameborder="0" name="rel" id="iFrameRelatorioId" style="margin-top:2px;height:600px;"></iframe> -->
</div>
<div class="forms_capa">
	<div id="frmcadastro">
		<div class="titulo_form"> <?php echo $_str['lblSignUpInOurProject']; ?> </div>
			<form name="frm_cadastro" action="cadastrar.php" method="post" onsubmit="return cadastrar();">
				<fieldset style="border: 0;">
				<table>

					<tr>
						<td align="right">
							<label for="login_cad"><?php echo $_str['lblLogin']; ?>:</label>
						</td>
						<td>
							<input type="text" name="login_cad" id="login_cad" class="inputs" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="senha_cad"><?php echo $_str['lblPassword']; ?>:</label>
						</td>
						<td>
							<input type="password" name="senha_cad" id="senha_cad" value="" class="inputs" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="senha"><?php echo $_str['lblRetypePassword']; ?>:</label>
						</td>
						<td>
							<input type="password" name="confirm_senha" id="confirm_senha" value="" class="inputs" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="nome"><?php echo $_str['lblName']; ?>:</label>
						</td>
						<td>
							<input type="text" name="nome" id="nome" value="" class="inputs" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="cidade"><?php echo $_str['lblCity']; ?>:</label>
						</td>
						<td>
							<input type="text" name="cidade" id="cidade" value=""  class="inputs" />
						</td>
					</tr>
						<tr>
						<td align="right">
							<label for="email"><?php echo $_str['lblEmail']; ?>:</label>
						</td>
						<td>
							<input type="text" name="email" id="email" value=""  class="inputs" />
						</td>
					</tr>
						<tr>
						<td align="right">
							<label for="profissao"><?php echo $_str['lblProfession']; ?>:</label>
						</td>
						<td>
							<input type="text" name="profissao" id="profissao" value=""  class="inputs" />
						</td>
					</tr>
					<tr>
						<td align="right"  height="20px" valign="middle">
							<label for="local"><?php echo $_str['lblAccessPlace']; ?>:</label>
						</td>
						<td height="20px" valign="top" >
							<table>
								<tr>
								 <td valign="middle"><?php echo $_str['lblHouse']; ?></td><td valign="top"><input value="Casa" type="radio" name="local" CHECKED /></td>
								 <td valign="middle"><?php echo $_str['lblSchool']; ?></td><td valign="top"><input value="Escola" type="radio" name="local" /></td>
								 <td valign="middle"><?php echo $_str['lblOthers']; ?></td><td valign="top"><input value="Outros" type="radio" name="local" /></td> 
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td></td>
						<td align="left">
							<a href="../INCLUDES/termos_de_uso_scala.pdf"><?php echo $_str['lblTermsDownload']; ?></a>
						</td>
					</tr>
					<tr>
						<td></td>
						<td align="left">
							<label for="termosdeuso"><?php echo $_str['lblIAcceptTheTerms']; ?>:</label>
							<input type="checkbox" name="termosdeuso" id="termosdeuso" value="1"/> 
						</td>
					</tr>
					<tr>
						<td></td>
						<td align="center" height="40px">
							<a class="cad_capa" href="javascript:void(0);" onclick="cadastrar();"></a>
					</tr>
				</table>
				<p class="validateTips"></p>
				</fieldset>
			</form>
		</div>
	</div>
<script type="text/javascript">
	var login_cad = $( "#login_cad" ),
		senha_cad = $( "#senha_cad" ),
		confirm_senha = $( "#confirm_senha" ),
		nome = $( "#nome" ),
		cidade = $( "#cidade" ),
		email = $( "#email" ),
		profissao = $( "#profissao" ),
		termosdeuso = $( "#termosdeuso" ),
		allFields = $( [] ).add( login_cad ).add( senha_cad ).add( confirm_senha ).add( nome ).add( cidade ).add( email ).add( profissao ).add( termosdeuso ),
		tips = $( ".validateTips" );
	
	function updateTips( t ) {
		tips
			.text( t )
			.addClass( "ui-state-highlight" );
		setTimeout(function() {
			tips.removeClass( "ui-state-highlight", 1500 );
		}, 500 );
	}
	
	function checkLength( o, n, min, max ) {
		if ( o.val().length > max || o.val().length < min ) {
			o.addClass( "ui-state-error" );
			o.focus();
			updateTips( "<?php echo $_str['lblTheSizeOfTheField']; ?> " + n + " <?php echo $_str['lblMustBeBetween']; ?> " +
				min + " <?php echo $_str['lblAnd']; ?> " + max + " <?php echo $_str['lblCharacters']; ?>." );
			return false;
		} else {
			return true;
		}
	}
	
	function checkRegexp( o, regexp, n ) {
		if ( !( regexp.test( o.val() ) ) ) {
			o.addClass( "ui-state-error" );
			o.focus();
			updateTips( n );
			return false;
		} else {
			return true;
		}
	}
	
	function checkMatch( a, b ) {
		if ( a.val() !=  b.val() ) {
			b.addClass( "ui-state-error" );
			b.focus();
			updateTips( "<?php echo $_str['lblPasswordsDoNotMatch']; ?>." );
			return false;
		} else {
			return true;
		}
	}
	
	function checkChecked(t, str){
		if (t[0].checked) {
			return true;
		} else {
			t.focus();
			updateTips( str );
			return false;
		}
	}
	
	function cadastrar(){
		var bValid = true;
		allFields.removeClass( "ui-state-error" );
		bValid = bValid && checkLength( login_cad, "login", 3, 16 );
		bValid = bValid && checkLength( senha_cad, "senha", 5, 16 );
		bValid = bValid &&  checkMatch( senha_cad, confirm_senha );					
		bValid = bValid && checkLength( nome, "nome", 3, 30 );
		bValid = bValid && checkLength( cidade, "cidade", 0, 50 );
		bValid = bValid && checkLength( email, "email", 5, 50 );
		bValid = bValid && checkLength( profissao, "profissao", 0, 50 );
	
		bValid = bValid && checkRegexp( login_cad, /^[a-z]([0-9a-z_])+$/i, "<?php $_str['loginValidate']; ?>" );
		bValid = bValid && checkRegexp( nome, /^[a-z]([0-9a-z ])+$/i, "<?php $_str['nameValidate']; ?>" );
		bValid = bValid && checkRegexp( cidade, /^[a-z]([0-9a-z ])+$/i, "<?php $_str['cityValidate']; ?>" );
		bValid = bValid && checkRegexp( profissao, /^[a-z]([0-9a-z ])+$/i, "<?php $_str['professionValidate']; ?>" );
		bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "<?php $_str['emailValidate']; ?>" );
		bValid = bValid && checkRegexp( senha_cad, /^([0-9a-zA-Z])+$/, "<?php $_str['passwordValidate']; ?>" );
		
		bValid = bValid && checkChecked(termosdeuso, "<?php echo $_str['lblTermsMustBeAccepted']; ?>");
				
		if (bValid)
		  document.frm_cadastro.submit();
		return "#";
	}
</script>



