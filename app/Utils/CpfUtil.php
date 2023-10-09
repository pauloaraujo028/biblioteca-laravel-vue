<?php

namespace App\Utils;

class CpfUtil
{
  public static function validarCPF($cpf)
  {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if (strlen($cpf) != 11) {
      return false;
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) {
      return false;
    }

    for ($i = 9; $i < 11; $i++) {
      $soma = 0;
      for ($j = 0; $j < $i; $j++) {
        $soma += $cpf[$j] * (($i + 1) - $j);
      }
      $resto = $soma % 11;
      $dv = $resto < 2 ? 0 : 11 - $resto;
      if ($dv != $cpf[$i]) {
        return false;
      }
    }

    return true;
  }
}
