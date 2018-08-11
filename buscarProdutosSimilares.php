<?php
require_once("vendor/autoload.php");

use App\Arquivo;
use App\Produto;

$arquivo = $argv[1]??'';
$id = $argv[2]??0;

try {
	Arquivo::validaArquivo($arquivo);

	$conteudo = json_decode(Arquivo::lerCompleto($arquivo));
} catch (\Exception $e) {
	exit($e->getMessage());
}

$conteudo->productsIndexed = [];
array_walk($conteudo->products, function ($item) use (&$conteudo) {
	$conteudo->productsIndexed[$item->id] = $item;
});

if (!isset($conteudo->productsIndexed[$id])) {
	exit('Produto não encontrado');
}

$produto = $conteudo->productsIndexed[$id];
unset($conteudo->productsIndexed[$id]);
$distancia = [];
foreach ($conteudo->productsIndexed as $key => $value) {
	$distancia[$key] = Produto::calcularDistanciaEuclidiana($produto->tagsVector, $value->tagsVector);
}

arsort($distancia);

echo "Os três produtos mais similares ao produto $id ({$produto->name}) são:", PHP_EOL;

foreach (array_slice($distancia, 0, 3, true) as $key => $value) {
	echo "- {$conteudo->productsIndexed[$key]->id} ({$conteudo->productsIndexed[$key]->name}) com S={$value}", PHP_EOL;
}