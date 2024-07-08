<?php 
    function thumb($arq) {
        $caminho = "fotos/$arq";
        if (is_null($arq) || !file_exists($caminho)) {
            return "fotos/indisponivel.png";
        } else {
            return $caminho;
        }
    }

    function voltar() {
        return "<a href='index.php'>
                    <span class='material-symbols-outlined'>
                        arrow_back_ios
                    </span>
                </a>";
    }

    function msg_sucesso($m) {
        return "<div class='sucesso'>
                    <span class='material-symbols-outlined'>
                        check_circle
                    </span> $m
                </div>";
    }

    function msg_aviso($m) {
        return "<div class='aviso'>
                    <span class='material-symbols-outlined'>
                        warning
                    </span> $m
                </div>";
    }

    function msg_erro($m) {
        return "<div class='erro'>
                    <span class='material-symbols-outlined'>
                        error
                    </span> $m
                </div>";
    }
?>