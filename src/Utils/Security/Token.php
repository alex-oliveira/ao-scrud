<?php

namespace AoScrud\Security;

class Token
{

    protected static $defaultExpires = 3600;

    /**
     * Retorna um Token com assinado.
     *
     * @param array $data Dados a serem incluidos no Token.
     * @param array $crypt Campos dos dados que devem ser criptografados.
     * @param string $secret Chave secreta da assinatura.
     * @return string
     */
    public static function encode(array $data, array $crypt = [], $secret = null)
    {
        foreach ($crypt as $field)
            $data[$field] = Password::crypt($data[$field]);

        $data['time'] = time();
        $data['signature'] = Signature::sign($data, $secret);

        return Obfuscator::mess($data);
    }

    /**
     * Retorna os dados do Token ou null se for inconsistente.
     *
     * @param string $token
     * @return \stdClass|null
     */
    public static function decode($token)
    {
        return Obfuscator::arrange($token);
    }

    /**
     * @param $token
     * @param null $secret Chave secreta da assinatura.
     * @return null|object
     */
    public static function check($token, $secret = null)
    {
        return Signature::check($token, $secret);
    }

    public static function hasFields($token, $fields = [])
    {
        return true;
    }

    /**
     * Verifica se o token expirou
     *
     * @param $created_at
     * @param null|int $expires
     * @return bool
     */
    public static function hasExpired($created_at, $expires = null)
    {
        is_null($expires) ? $expires = self::$defaultExpires : null;

        if (is_string($created_at)) {
            $created_at = new \DateTime($created_at);
            $created_at = $created_at->getTimestamp();
        }

        $created_at += $expires;
        return time() >= $created_at ? true : false;
    }

}