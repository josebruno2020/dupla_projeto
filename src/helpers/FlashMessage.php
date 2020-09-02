<?php 

namespace Dupla\Src\Helpers;

trait FlashMessage
{
    public static function mensagem($tipo, $mensagem)
    {
        $_SESSION['tipo'] = $tipo;
        $_SESSION['flash'] = $mensagem;
        
    }
}