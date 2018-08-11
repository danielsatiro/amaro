<?php

namespace App;

class Produto {
	const TAGS = [
			'neutro',
			'veludo',
			'couro',
			'basics',
			'festa',
			'workwear',
			'inverno',
			'boho',
			'estampas',
			'balada',
			'colorido',
			'casual',
			'liso',
			'moderno',
			'passeio',
			'metal',
			'viagem',
			'delicado',
			'descolado',
			'elastano'
		];

	public static function criarVector(array $tagsProduto) : array
	{
		$tagsVector = [];
		foreach (self::TAGS as $key => $value) {
			if (in_array($value, $tagsProduto)) {
				$tagsVector[$key] = 1;
				continue;
			}
			$tagsVector[$key] = 0;
		}
		return $tagsVector;
	}

	public static function calcularDistanciaEuclidiana(array $v1, array $v2) : float
	{
		$somatoria = 0;
		foreach ($v1 as $key => $value) {
			$somatoria += pow($value - $v2[$key], 2);
		}

		$d = sqrt($somatoria);

		return 1/(1 + $d);
	}
}