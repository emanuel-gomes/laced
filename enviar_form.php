<?php

    # alterar a variavel abaixo colocando o seu email

    $destinatario = "emanuel.gfsdeveloper@gmail.com";

    $nome = $_REQUEST['nome'];
    $email = $_REQUEST['email'];
    $mensagem = $_REQUEST['mensagem'];

     // monta o e-mail na variavel $body

    $body = "===================================" . "\n";
    $body = $body . "FALE CONOSCO - TESTE COMPROVATIVO" . "\n";
    $body = $body . "===================================" . "\n\n";
    $body = $body . "Nome: " . $nome . "\n";
    $body = $body . "Email: " . $email . "\n";
    $body = $body . "Mensagem: " . $mensagem . "\n\n";
    $body = $body . "===================================" . "\n";

    // envia o email
    mail($destinatario, $assunto , $body, "From: $email\r\n");



?>
