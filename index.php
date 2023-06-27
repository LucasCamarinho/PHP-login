
<?php

$erronome = "";
$erroemail = "";
$errosenha = "";
$errorepetesenha = "";


if ($_SERVER ['REQUEST_METHOD'] == 'POST'){

  //VERIVICAR SE O CAMPO ESTA PREENCHIDO
  if (empty($_POST['nome'])){
    $erronome = "preencha o NOME";
  }else{
  //LIMPAR VALOR VINDO DO POST
    $nome = clearPost($_POST['nome']);
  

  //VERIFICAR SE TEM APENAS LETRAS
  if(!preg_match("/^[a-zA-Z-' ]*$/",$nome)){
    $erronome ="Apenas letra são aceitas nesse campo";
  }
}


  //VERIVICAR CAMPO E-MAIL
  if (empty($_POST['email'])){
      $erroemail = "preencha o campo E-MAIL";
  }else{
    $email = clearPost($_POST['email']);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $erroemail = "E-mail invalido!";
    }
  }


  //VERIFICAR CAMPO SENHA
  if (empty($_POST['senha'])){
    $errosenha = "Preencha o campo SENHA";
  }else{
    $senha = clearPost($_POST['senha']);
    if(strlen($senha) <6){
      $errosenha = "Senha precisa ter no mínimo 6 digitos";
  }
}



  if (empty($_POST['repete_senha'])){
    $errorepetesenha = "Confirme sua SENHA";
  }else{
    $repete_senha = clearPost($_POST['repete_senha']);
    if($repete_senha !== $senha){
    $errorepetesenha = "As senhas NÃO são iguais";
  }
}


  // SE NAO TIVER ERRO ENVIAR PARA A PAGINA DE OBRIGADO
  if(($erronome=="") && ($erroemail=="") && ($errosenha=="") && ($errorepetesenha=="")){
    header('Location: obrigado.php');
  }

}





  function clearPost($V){
    $V = trim($V);
    $V = stripslashes($V);
    $V = htmlspecialchars($V);
    return $V;
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação de Formulário</title>
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
    <main>
    <h1><span>PHP</span><br>Validação de Formulário</h1>

     <form method="post">

        <!-- NOME COMPLETO -->
        <label> Nome Completo </label>
        <input type="text" <?php if(!empty($erronome)){echo "class='invalido'";}?><?php if (isset($_POST['nome'])){echo "value='".$_POST['nome']."'";}?> name="nome" placeholder="Digite seu nome">
        <br><span class="erro"><?php echo $erronome?></span>

        <!-- EMAIL -->
        <label> E-mail </label>
        <input type="email" <?php if(!empty($erroemail)){echo "class='invalido'";}?><?php if (isset($_POST['email'])){echo "value='".$_POST['email']."'";}?> name="email" placeholder="email@provedor.com">
        <br><span class="erro"><?php echo $erroemail?></span>

        <!-- SENHA -->
        <label> Senha </label>
        <input type="password" <?php if(!empty($errosenha)){echo "class='invalido'";}?><?php if (isset($_POST['senha'])){echo "value='".$_POST['senha']."'";}?> name="senha" placeholder="Digite uma senha">
        <br><span class="erro"><?php echo $errosenha?></span>

        <!-- REPETE SENHA -->
        <label> Repete Senha </label>
        <input type="password" <?php if(!empty($errorepetesenha)){echo "class='invalido'";}?><?php if (isset($_POST['repete_senha'])){echo "value='".$_POST['repete_senha']."'";}?> name="repete_senha" placeholder="Repita a senha">
        <br><span class="erro"><?php echo $errorepetesenha?></span>

        <button type="submit"> Enviar Formulário </button>

      </form>
    </main>
</body>
</html>