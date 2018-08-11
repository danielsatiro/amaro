<?php
namespace App;

use Exception;

class Arquivo {

	public static function validaArquivo($caminho)
	{
		if (empty($caminho)) {
			throw new Exception('Informe um arquivo!', 1);
		} elseif (!file_exists($caminho)) {
			throw new Exception('Arquivo invalido!', 1);
		}
	}

	public static function lerLinhaALinha(string $caminho)
	{
		$linhas = [];
		$handle = fopen($caminho, 'r');
		while (($linha = fgets($handle, 4096)) !== false) {
			if (!empty(trim($linha))) {
				$linhas[] = explode(' ', trim($linha));
			}	
		}

		fclose($handle);
		return $linhas;
	}

	public static function lerCompleto(string $caminho)
	{
		$conteudo = file_get_contents($caminho);

		if ($conteudo === FALSE) {
			throw new Exception('Falha ao ler arquivo!', 1);
		}
		return $conteudo;
	}

	public static function escreveArquivo(string $caminho, string $conteudo)
	{
		$handle = fopen($caminho, 'w+');
		fwrite($handle, $conteudo);
		fclose($handle);
	}
}