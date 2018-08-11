<?php
require_once("vendor/autoload.php");

use App\Arquivo;
use App\Produto;

$arquivo = $argv[1]??'';

try {
	Arquivo::validaArquivo($arquivo);

	$conteudo = json_decode(Arquivo::lerCompleto($arquivo));
} catch (\Exception $e) {
	exit($e->getMessage());
}

foreach ($conteudo->products as $key => $value) {
	$value->tagsVector = Produto::criarVector($value->tags);
}

$caminho = 'saidaVector' . ucfirst($arquivo);
Arquivo::escreveArquivo($caminho, json_encode($conteudo));