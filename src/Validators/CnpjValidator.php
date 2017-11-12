<?php

namespace AoScrud\Validators;

class CnpjValidator
{

    /**
     * CNPJs que seriam válidos pelos calculos, mas que na verdade são inválidos.
     * @var array
     */
    protected $invalids = [
        '00000000000000', '11111111111111', '22222222222222', '33333333333333', '44444444444444',
        '55555555555555', '66666666666666', '77777777777777', '88888888888888', '99999999999999'
    ];

    public function validate($attribute, $value, $parameters, $validator)
    {
        # Filtra o que não for numero para permitir diferentes
        # formacaçoes, tais como: "00.000.000/0000-00", "00000000000000" e "00 000 000 0000 00".

        $cnpj = preg_replace('/\D/', '', $value);

        if (strlen($cnpj) != 14)
            return false;

        if (in_array($cnpj, $this->invalids))
            return false;

        $num = array();
        for ($i = 0; $i < (strlen($cnpj)); $i++)
            $num[] = $cnpj[$i];

        # Calcula e compara o primeiro dígito verificador.

        $j = 5;
        for ($i = 0; $i < 4; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $j = 9;
        for ($i = 4; $i < 12; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $resto = $soma % 11;
        $dg = $resto < 2 ? 0 : 11 - $resto;
        if ($dg != $num[12])
            return false;

        # Calcula e compara o segundo dígito verificador.

        $j = 6;
        for ($i = 0; $i < 5; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $j = 9;
        for ($i = 5; $i < 13; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $resto = $soma % 11;
        $dg = $resto < 2 ? 0 : 11 - $resto;
        if ($dg != $num[13])
            return false;

        return true;
    }

}
