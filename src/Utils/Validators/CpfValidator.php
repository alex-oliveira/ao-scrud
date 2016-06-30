<?php

namespace AoScrud\Utils\Validators;

class CpfValidator
{

    /**
     * CPFs que seriam válidos pelos calculos, mas que na verdade são inválidos.
     * @var array
     */
    protected $invalids = [
        '00000000000', '11111111111', '22222222222', '33333333333', '44444444444',
        '55555555555', '66666666666', '77777777777', '88888888888', '99999999999'
    ];

    public function validate($attribute, $value, $parameters, $validator)
    {
        # Filtra o que não for numero para permitir diferentes
        # formacaçoes, tais como: "000.000.000-00", "00000000000" e "000 000 000 00".

        $cpf = preg_replace('/\D/', '', $value);

        if (strlen($cpf) != 11)
            return false;

        if (in_array($cpf, $this->invalids))
            return false;

        $num = array();
        for ($i = 0; $i < 11; $i++)
            $num[] = $cpf[$i];

        # Calcula e compara o primeiro dígito verificador.

        $j = 10;
        for ($i = 0; $i < 9; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $resto = $soma % 11;
        $dg = $resto < 2 ? 0 : 11 - $resto;
        if ($dg != $num[9])
            return false;

        # Calcula e compara o segundo dígito verificador.

        $j = 11;
        for ($i = 0; $i < 10; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }

        $soma = array_sum($multiplica);
        $resto = $soma % 11;
        $dg = $resto < 2 ? 0 : 11 - $resto;
        if ($dg != $num[10])
            return false;

        return true;
    }

}
