<?php

namespace AoScrud\Security;

class Obfuscator
{

    /**
     * Retorna uma string ofuscada a partir de um array.
     *
     * @param array $data
     * @return string
     */
    public static function mess(array $data)
    {
        $data = json_encode($data);

        //-----------------------------//
        // CRIAR ROTINA DE OFUSCAMENTO //
        //-----------------------------//

        return base64_encode($data);
    }

    /**
     * Recupera o array a partir de sua string ofuscada.
     *
     * @param string $data
     * @return array
     */
    public static function arrange($data)
    {
        $data = base64_decode($data);

        //-------------------------------//
        // CRIAR ROTINA DE REORGANIZACAO //
        //-------------------------------//

        return (array)json_decode($data);
    }

}