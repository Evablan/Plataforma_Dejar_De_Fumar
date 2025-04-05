<?php

class Seguridad
{
    public function __construct(Type $var = null) {
        $this->var = $var;
    }

    public function limpiar($infor)
    {

        $limpia1=strip_tags($infor);
        $limpia2=htmlspecialchars($limpia1);
        return $limpia2;


    }

}





?>