
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Formulário de Contato</title>
<link href="css.css"rel="stylesheet" type="text/css" />
</head>
	 
<body>
<div id="box">
<div id="formulario">
<form action="" method="post" enctype="multipart/form-data">
<fieldset>
<legend>Fale Conosco</legend>
 
<?php
if("$_POST[nome]" >= '1'){
	 $nome = "$_POST[nome]";
}else{
 $nome = '';
}if("$_POST[email]" >= '1'){
 $email = "$_POST[email]";
}else{
 $email = '';
	}if("$_POST[assunto]" >= '1'){
 $assunto = "$_POST[assunto]";
	}else{
 $assunto = '';
	}if("$_POST[mensagem]" >= '1'){
	 $mensagem = "$_POST[mensagem]";
	}else{
	 $mensagem = '';
	}
	?>
	 
	<?php
if (isset($_POST['enviar']) && $_POST['enviar'] == 'send') {
 
	 $nome =     strip_tags(trim($_POST['nome']));
	 $email =    strip_tags(trim($_POST['email']));
	 $assunto =  strip_tags(trim($_POST['assunto']));
	 $mensagem = strip_tags(trim($_POST['mensagem']));
	 
	 $anexado = $_FILES['arquivo']['name'];
	 $extensao = strtolower(end(explode('.', $anexado)));
	 $extensoes = array ('txt', 'jpg', 'docx'); // AKI VC PODE COLOCAR AS EXTENÇÕES QUE VC AEITARA NO UPLOAD
 $size = $_FILES['arquivo']['size'];
 $maxsize = 1024 * 1024 * 2; // AKI VC ESPECIFICA O TAMANHO DE ARQUIVOS ACEITOS, LEMBRANDO QUE A CONFIGURAÇÃO É LIVE
	 
	 if(empty($anexado)){
	 echo "";
 }elseif(array_search($extensao, $extensoes) === false){
	 $retorno = '<span>o tipo do arquivo é inválido, aceitamos somente txt, jpg, docx</span>';
	 }elseif($size >= $maxsize){
	 $retorno = '<span>arquivo so e permitido com menos de 2mb</span>';
	 }if(empty($nome)) {
 $retorno = '<span>Informe seu nome</span>';
	 }elseif (empty($email)) {
 $retorno = '<span>Informe seu e-mail</span>';
 }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	 $retorno = '<span>Informe um e-mail válido</span>';
 }elseif (empty($assunto)) {
 $retorno = '<span>Digite o assunto!</span>';
 }elseif (empty($mensagem)) {
	 $retorno = '<span>Digite a mensagem</span>';
	 }if (empty($retorno)) {
 
//<input type="hidden" name="enviar" value="send" />
	 
	$date = date("d/m/Y h:i");
	 
	// ****** ATENÇÃO ********
	// ABAIXO ESTÁ A CONFIGURAÇÃO DO SEU FORMULÁRIO.
	// ****** ATENÇÃO ********
	 
	//CABEÇALHO - ONFIGURAÇÕES SOBRE SEUS DADOS E SEU WEBSITE
	 
	$destino = $_POST['destino'];
 
	$nome_do_site="COLOQUE AKI O SEU SITE";
	$email_para_onde_vai_a_mensagem = "COLOQUE AKI O SEU EMAIL";
	$nome_de_quem_recebe_a_mensagem = "COLOQUE AKI O SEU NOME";
	$exibir_apos_enviar='';
 
	//MAIS - CONFIGURAÇOES DA MENSAGEM ORIGINAL
	$cabecalho_da_mensagem_original="From: $emailn";
	$assunto_da_mensagem_original="$assunto";
 
	// FORMA COMO RECEBERÁ O E-MAIL (FORMULÁRIO)
	// ******** OBS: SE FOR ADICIONAR NOVOS CAMPOS, ADICIONE OS CAMPOS NA VARIÁVEL ABAIXO *************
	$configuracao_da_mensagem_original="
	 
	<strong>ENVIADO POR:</strong><br />
	<strong>Nome:</strong> $nome<br />
	<strong>E-mail:</strong> $email<br />
	<strong>Assunto:</strong> $assunto<br /><br />
	<strong>Mensagem:</strong> $mensagem<br /><br />
	 
	ENVIADO EM: $date";
	 
//CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
	// CASO $assunto_digitado_pelo_usuario="s" ESSA VARIAVEL RECEBERA AUTOMATICAMENTE A CONFIGURACAO
	// "Re: $assunto"
	$assunto_da_mensagem_de_resposta = "Recebemos sua mensagem";
	$cabecalho_da_mensagem_de_resposta = "From: $nome_do_site <$email_para_onde_vai_a_mensagem>n";
	$configuracao_da_mensagem_de_resposta="
	 
Obrigado por entrar em contato!<br />
	Estaremos respondendo em breve...<br />
<strong>Atenciosamente $nome_do_site</strong><br /><br />
	Enviado em: $date";
	 
	// ****** IMPORTANTE ********
	// A PARTIR DE AGORA RECOMENDA-SE QUE NÃO ALTERE O SCRIPT PARA QUE O  SISTEMA FINCIONE CORRETAMENTE
	// ****** IMPORTANTE ********
 
//ESSA VARIAVEL DEFINE SE É O USUARIO QUEM DIGITA O ASSUNTO OU SE DEVE ASSUMIR O ASSUNTO DEFINIDO
	//POR VOCÊ CASO O USUARIO DEFINA O ASSUNTO PONHA "s" NO LUGAR DE "n" E CRIE O CAMPO DE NOME
	//'assunto' NO FORMULARIO DE ENVIO
	$assunto_digitado_pelo_usuario="s";
 
//ENVIO DA MENSAGEM ORIGINAL
	 
	$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;
 
if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){
 
 $fp = fopen($_FILES["arquivo"]["tmp_name"],"rb");
	 $anexo = fread($fp,filesize($_FILES["arquivo"]["tmp_name"]));
	 $anexo = base64_encode($anexo);
 
fclose($fp);
	 
$anexo = chunk_split($anexo);
 
	$boundary = "XYZ-" . date("dmYis") . "-ZYX";
	 
	 $mens = "--$boundaryn";
	 $mens .= "Content-Transfer-Encoding: 8bitsn";
	 $mens .= "Content-Type: text/html; charset="UTF-8"nn";
	 $mens .= "$configuracao_da_mensagem_originaln";
 $mens .= "--$boundaryn";
	 $mens .= "Content-Type: ".$arquivo["type"]."n";
 $mens .= "Content-Disposition: attachment; filename="".$arquivo["name"].""n";
 $mens .= "Content-Transfer-Encoding: base64nn";
	 $mens .= "$anexon";
	 $mens .= "--$boundary--rn";
 
	$headers  = "MIME-Version: 1.0n";
	$headers .= "$cabecalho_da_mensagem_original";
	$headers .= "Content-type: multipart/mixed; boundary="$boundary"rn";
	$headers .= "$boundaryn";
	}else{
	 
	$mens = "$configuracao_da_mensagem_originaln";
	 
	$headers  = "MIME-Version: 1.0n";
	$headers .= "$cabecalho_da_mensagem_original";
	$headers .= "Content-Type: text/html; charset="UTF-8"nn";
	}
 
	if ($assunto_digitado_pelo_usuario=="s")
	{
	$assunto = "$assunto_da_mensagem_original";
	};
	$seuemail = "$email_para_onde_vai_a_mensagem";
	mail($seuemail,$assunto,$mens,$headers);
	 
//ENVIO DE MENSAGEM DE RESPOSTA AUTOMATICA
 
	$headers = "$cabecalho_da_mensagem_de_resposta";
	$headers .= "Content-Type: text/html; charset="UTF-8"nn";
 
	if ($assunto_digitado_pelo_usuario=="s")
	{
	$assunto = "$assunto_da_mensagem_de_resposta";
	}
	else
	{
$assunto = "Re: $assunto";
	};
$mensagem = "$configuracao_da_mensagem_de_resposta";
	mail($email,$assunto,$mensagem,$headers);
	 
	/*echo "<script>window.location='$exibir_apos_enviar'</script>";*/
	echo "<span class="yes">Sua mensagem foi enviada com suscesso, Estaremos respondendo o mais breve possivel!</span>";
	unset($nome, $email, $assunto, $mensagem);
	} else {
	 echo "$retorno";
	 }
	}
	?>
	 
	 <label>
	 <span>Escolha o setor</span>
	 <select name="destino" id="destino">
       <option value="contato@upinside.com.br">Suporte</option>
       <option value="hospedagem@upinside.com.br">Hospedagem</option>
     </select>
	 </label>
	 
	 <label>
	 <span>Nome</span>
	 <input type="text" name="nome" value="<?php echo $nome; ?>" />
	 </label>
	 
	 <label>
	 <span>E-mail</span>
	 <input type="text" name="email" value="<?php echo $email; ?>" />
 </label>
	 
	 <label>
	 <span>Assunto</span>
	 <input type="text" name="assunto" value="<?php echo $assunto; ?>" />
	 </label>
 
	 <label>
	 <span>Mensagem</span>
	 <textarea cols="31" rows="5" name="mensagem"><?php echo $mensagem; ?></textarea>
	 </label>
	 
 <label>
	 <span>Anexar arquivo</span>
	 <input type="file" name="arquivo" size="16" />
	 </label>
	 
	 <input type="hidden" name="enviar" value="send" />
<input type="submit" name="Enviar" />
 
	 </fieldset>
</form>
</div><!--formulario-->
</div>
 
	</body>
	</html>
**************************** AKI TERMINA O CÓDIGO HTML **************************
 
**************************** AKI COMEÇA O CÓDIGO CSS **************************
 
* {paddin:0; margin:0; }
#formulario form { width:300px; display:block; margin:0 auto; background:#fff;
}
#formulario fieldset{ border:0; padding: 0 15px 10px 15px;
}
#formulario legend{ font:18px  Arial, Helvetica, sans-serif; text-align:center; color:#069; font-weight:bold; padding:10px;
}
#formulario label{ display:block; padding:3px 0;
}
#formulario span{ display:block; font:16px "Times New Roman", Times, serif; color:#069; font-weight:bold;
}
#formulario input{ padding:3px; width:260px; border:1px solid #069; font:16px Arial, Helvetica, sans-serif; color: #069; font-weight:bold;
}
#formulario textarea{ padding:3px; width:260px; border:1 solid #069; font:16px Arial, Helvetica, sans-serif; color: #069; font-weight:bold;
}
#formulario .send{ width:120px; display:block; margin:10px auto; cursor:pointer; border:0; background:#069; color:#FFFFFF;
}
#formulario .send:over{ background:#036;
}
 
**************************** AKI TERMINA O CÓDIGO CSS **************************
