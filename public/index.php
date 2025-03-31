<?php
$uri = $_SERVER['REQUEST_URI'];
preg_match('@(\d+)(/(\d+))?@', $uri, $matches);

$nextPageNr = $prevPageNr = false;
$nextSubPageNr = $prevSubPageNr = false;

$pageNr    = (int) ($matches[1] ?? 0);
$subPageNr = (int) ($matches[3] ?? 0);

$index = include "../pages/index.php";

if (!array_key_exists($pageNr, $index)) {
	$pageNr = 0;
}

$page = $index[$pageNr];
$file_prefix = sprintf("../pages/%03d", $pageNr);

if (!array_key_exists($subPageNr, $index[$pageNr]['children'])) {
	$subPageNr = 0;
}

$breadCrumps = [
	[
		'page' => "/{$pageNr}",
		'title' => $index[$pageNr]['title'],
	],
	[
		'page' => "/{$pageNr}/{$subPageNr}",
		'title' => $index[$pageNr]['children'][$subPageNr]['title'],
	],
];

/* Find Content */
$page = $index[$pageNr]['children'][$subPageNr];
$file_prefix = sprintf("../pages/%03d/%03d", $pageNr, $subPageNr);

if (file_exists("{$file_prefix}.html")) {
	$text = file_get_contents("{$file_prefix}.html");
} else {
	$text = "<h1>This hasn't been written yet</h1><p>{$file_prefix}</p>";
}

if (file_exists("{$file_prefix}.php")) {
	$code = file_get_contents("{$file_prefix}.php");
} else {
	$code = "<?php\n// There is no code yet";
}

/* Previous */
$prevPage = $prevTitle = false;

if ($pageNr > 0) {
	if ($subPageNr == 0) {
		$prevPageNr = $pageNr - 1;
		$prevPage = "/{$prevPageNr}";
		$prevTitle = $index[$prevPageNr]['title'];
	} else {
		$prevSubPageNr = $subPageNr - 1;
		$prevPage = "/{$pageNr}/{$prevSubPageNr}";
		$prevTitle = $index[$pageNr]['children'][$prevSubPageNr]['title'];
	}
} else {
	if ($subPageNr > 0) {
		$prevSubPageNr = $subPageNr - 1;
		$prevPage = "/{$pageNr}/{$prevSubPageNr}";
		$prevTitle = $index[$pageNr]['children'][$prevSubPageNr]['title'];
	}
}

/* Next */
$nextPage = $nextTitle = false;

if ($subPageNr + 1 == count($index[$pageNr]['children'])) {
	if ($pageNr + 1 < count($index)) {
		$nextPageNr = $pageNr + 1;
		$nextPage = "/{$nextPageNr}";
		$nextTitle = $index[$nextPageNr]['title'];
	}
} else {
	$nextSubPageNr = $subPageNr + 1;
	$nextPage = "/{$pageNr}/{$nextSubPageNr}";
	$nextTitle = $index[$pageNr]['children'][$nextSubPageNr]['title'];
}

include '../templates/layout.php';
