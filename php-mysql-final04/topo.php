<?php 
    echo "<p class='pequeno'>";

    if (empty($_SESSION['user'])) {
        echo "<a href='user-login.php'>Entrar</a>";
    }

    else {
        echo "Olá, <strong>". $_SESSION['nome'] . "</strong> | ";
        echo "Meus Dados | ";
        if (is_admin()) {
            echo "<a href='user-new.php'>Novo usuário</a> | "; 
            echo "Novo jogo | "; 
        }
        echo "<a href='user-logout.php'>Sair</a>";
    }
    echo "</p>";
?>