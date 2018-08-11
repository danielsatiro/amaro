<?php
require_once("vendor/autoload.php");

use App\Arquivo;

function validaQuadrado(array $quadrado)
{
	$t = count($quadrado) - 1;
	$totais = [];
	$dD = $dE = 0;
	foreach ($quadrado as $key => $value) {
		$totais[] = array_sum(array_column($quadrado, $key));
		$totais[] = array_sum($value);
		$dD += $quadrado[$t - $key][$key];
		$dE += $quadrado[$t - $key][$t - $key];
	}

	$totais[] = $dD;
	$totais[] = $dE;

	return (count(array_unique($totais)) === 1);
}

$arquivo = $argv[1]??'';

try {
	Arquivo::validaArquivo($arquivo);

	$quadrado = Arquivo::lerLinhaALinha($arquivo);
} catch (\Exception $e) {
	exit($e->getMessage());
}

$ePerfeito = validaQuadrado($quadrado)? 'é': 'não é';

echo "O quadrado $ePerfeito perfeito!";