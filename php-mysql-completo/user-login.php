<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login de Usuário</title>
        <link rel="stylesheet" href="estilos/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

        <style>
            div#corpo {
                width: 270px;
                font-size: 13pt;
            }

            table td{
                padding: 6px;
            }
        </style>
</head>

<body>
    <?php
        require_once "includes/banco.php";
        require_once "includes/login.php";
        require_once "includes/funcoes.php";
    ?>

    <div id="corpo">
        <?php 
            $u = $_POST['usuario'] ?? null;
            $s = $_POST['senha'] ?? null;

            if(is_null($u) || is_null($u)) {
                require "user-login-form.php";
            } else {
                $q = "SELECT * FROM usuarios WHERE usuario = '$u'";
                $busca = $banco->query($q);

                if (!$busca) {
                    echo msg_erro('Falha ao acessar o banco!');
                } else {
                    if ($busca->num_rows > 0) {
                        $reg = $busca->fetch_object();

                        if (testarHash($s, $reg->senha)){
                            echo msg_sucesso("Logado com Sucesso!");
                            $_SESSION['user'] = $reg->usuario;
                            $_SESSION['nome'] = $reg->nome;
                            $_SESSION['tipo'] = $reg->tipo;
                        } 
                        else {
                            echo msg_erro("Senha inválida");
                        }
                    }   
                    else {
                        echo msg_erro("Usuário não existe!");
                    }
                }
            }
            echo voltar();
        ?>
    </div>
</body>
</html>