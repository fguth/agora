<?php
header("content-type: application/json", true);

/**
 * ABSTRAI DADOS DE $_POST
 */

$diretorio = $_POST["diretorio"];

/**
 * INICALIZA
 */

$dados = new stdClass();
$dados->diretorio = null;
$dados->arquivos = array();
$dados->pastas = array();
$dados->erro = false;

$diretorio = str_replace("\\", "/", $diretorio);

if (preg_match("/^\.\//", $diretorio)) {
	$diretorio = substr($diretorio, 2);
}

if (preg_match("/\/$/", $diretorio)) {
	$diretorio = substr($diretorio, 0, -1);
}

$dados->diretorio = $diretorio;

if (empty($diretorio)) {
	$diretorio = "../../";
} else {
	$diretorio = "../../" . $diretorio;
}

/**
 * EXECUTA A VARREDURA
 */

if (is_dir($diretorio)) {
	$sistema = opendir($diretorio);
	
	while (($item = readdir($sistema)) !== false) {
		if (is_dir($diretorio . "/" . $item)) {
			if ($item != "." && $item != "..") {
				$pasta = new stdClass();
				
				$pasta->nome = $item;
				
				array_push($dados->pastas, $pasta);
			}
		} else if (is_file($diretorio . "/" . $item)) {
			$arquivo = new stdClass();
			
			$arquivo->nome = $item;
			$arquivo->tamanho = filesize($diretorio . "/" . $item);
			
			array_push($dados->arquivos, $arquivo);
		}
	}
	
	closedir($sistema);
} else {
	$dados->erro = true;
}

/**
 * RETORNA OS DADOS EM JSON
 */

echo(json_encode($dados));
?>