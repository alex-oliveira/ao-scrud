<?php

namespace AoScrud\Security;

class Signature
{

    /**
     * Recebe um array e retorna o mesmo com a assinatura.
     *
     * @param array $data
     * @param string $algorithm
     * @param null $secret
     * @return string
     */
    public static function sign(array $data, $secret = null, $algorithm = 'SHA512')
    {
        if (is_null($secret))
            $secret = env('APP_KEY');

        $algorithm = substr($algorithm, (($p = strpos($algorithm, '-')) !== FALSE ? $p + 1 : 0));
        $algorithm = in_array($algorithm, hash_algos()) ? $algorithm : 'SHA512';

        return hash_hmac($algorithm, json_encode($data), $secret);
    }

    /**
     * Recebe um array assinado e verifica se a assinatura válida.
     *
     * @param array $data
     * @param string $algorithm
     * @param string $field
     * @param null $secret
     * @return bool
     */
    public static function check(array $data, $secret = null, $algorithm = 'SHA512', $field = 'signature')
    {
        if (is_null($secret))
            $secret = env('APP_KEY');

        # invalido se não tem assinatura
        if (empty($data[$field]))
            return false;

        # isolando a "signature"
        $signature = $data[$field];
        unset($data[$field]);

        # retorna resultado da comparação das assinaturas
        return $signature == self::sign($data, $secret, $algorithm);
    }

}