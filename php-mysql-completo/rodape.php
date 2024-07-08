<?php 
    echo "<footer>";
    echo "<p>Acessador por ". $_SERVER['REMOTE_ADDR'] ." em " . date('d/M/Y'). "</p>";
    echo "<p>Desenvolvido por estudonauta &copy; 2024</p>";
    echo "</footer>";
    $banco->close();
?>