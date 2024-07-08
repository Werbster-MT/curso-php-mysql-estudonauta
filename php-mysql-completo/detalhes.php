<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <?php
        require_once "includes/banco.php";
        require_once "includes/login.php";
        require_once "includes/funcoes.php";
    ?>

    <div id="corpo">
        <?php
        include_once "topo.php";
        $c = $_GET['cod'] ?? 0;
        $busca = $banco->query("select * from jogos where cod='$c'");
        ?>
        <h1>Detalhes do jogo</h1>
        <table class="detalhes">
            <?php
            if (!$busca) {
                echo "Busca falhou! $banco->error";
            } else {
                if ($busca->num_rows == 1) {
                    $reg = $busca->fetch_object();
                    $t = thumb($reg->capa);
                    echo "<tr><td rowspan='3'><img src='$t'></td>";
                    echo "<td><h2>$reg->nome</h2> <br>Nota: " . number_format($reg->nota, 1) . "/10.0";
                    if (is_admin()) {
                        echo " <span class='material-symbols-outlined'>add_circle</span>";
                        echo "<span class='material-symbols-outlined'>edit</span>";
                        echo "<span class='material-symbols-outlined'>delete</span>";


                    } else if (is_editor()){
                        echo " <span class='material-symbols-outlined'>edit</span>";
                    }

                    echo "<tr><td>$reg->descricao</td>";
                } else {
                    echo "<tr><td>Nenhum registro encontrado</td></tr>";
                }
            }
            ?>
        </table>
        <?=voltar()?>
    </div>
    <?php include_once "rodape.php"; ?>
</body>

</html>