<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Jogos</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="estilos/style.css">
</head>
<body>
    <?php 
        require_once "includes/banco.php";
        require_once "includes/login.php";
        require_once "includes/funcoes.php";
        $ordem = $_GET["o"] ?? "n";
        $chave = $_GET["c"] ?? "n";
    ?>

    <div id="corpo">
        <?php include_once "topo.php";?>
        <h1>Escolha seu jogo</h1>
        <form method="get" id="busca" action="index.php">
        Ordenar: 
        <a href="index.php?o=n&c=<?=$chave;?>">Nome</a> | 
        <a href="index.php?o=p&c=<?=$chave;?>">Produtora</a> | 
        <a href="index.php?o=n1&c=<?=$chave;?>">Nota Alta</a> | 
        <a href="index.php?o=n2&c=<?=$chave;?>">Nota Baixa</a> |
        <a href="index.php">Mostrar Todos</a> |    
        Buscar: <input type="text" name="c" size="10" maxlength="40">
        <input type="submit" value="Ok">
        </form>
        <table class="listagem">
            <?php 
                $q = "select j.cod, j.nome, g.genero, p.produtora, j.capa from jogos j join generos g on j.genero = g.cod join produtoras p on j.produtora = p.cod ";
                
                if(!empty($chave)) {
                    $q .= "where j.nome like '%$chave%' OR p.produtora like '%$chave%' OR g.genero like '%$chave%'";
                }

                switch ($ordem) {
                    case "p":
                        $q .= "order by p.produtora"; 
                        break;
                    case "n1":
                        $q .= "order by j.nota desc"; 
                        break;
                    case "n2":
                        $q .= "order by j.nota asc"; 
                        break;
                    default:
                        $q .= "order by j.nome"; 
                    }

                $busca = $banco->query($q); 

                if(!$busca) {
                    echo "<tr><td>Infelizmente a busca deu errado<td></tr>";
                }else {
                    if($busca->num_rows == 0) {
                        echo "<tr><td>Nenhum registro encontrado<td></tr>";
                    }else {
                       while($reg=$busca->fetch_object()) {
                        $t = thumb($reg->capa);

                        echo "<tr><td><img class='mini' src='$t'></td>";
                        echo "<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a> [$reg->genero] <br/>$reg->produtora</td>";
                        if (is_admin()) {
                            echo "<td><span class='material-symbols-outlined'>add_circle</span></td>";
                            echo "<td><span class='material-symbols-outlined'>edit</span></td>";
                            echo "<td><span class='material-symbols-outlined'>delete</span></td>";


                        } else if (is_editor()){
                            echo "<td><span class='material-symbols-outlined'>edit</span></td>";
                        }
                        }
                    }
                }
            ?>
        </table>
    </div>
    <?php include_once "rodape.php"; ?>
</body>
</html>