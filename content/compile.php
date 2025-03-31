<?php
require 'vendor/autoload.php';

$document = new ezcDocumentRst();
$document->loadFile( 'tour.rst' );

$docbook = $document->getAsDocBook()->getDomDocument();

$currentSubjectNr = 0;
$currentPageNr = 0;
$index = [];

foreach ($docbook->childNodes as $node)
{
	if ( !$node instanceof DOMElement || $node->tagName !== 'article' )
	{
		continue;
	}

	loopArticle( $node );
}

unset( $index[$currentSubjectNr] );
var_export( $index );

function loopArticle( DomElement $e )
{
	foreach ($e->childNodes as $node)
	{
		if ( $node instanceof DOMElement && $node->tagName == 'section' )
		{
			loopTopSection( $node );
		}
	}
}

function loopTopSection( DomElement $e )
{
	global $index;
	global $currentSubjectNr;
	global $currentPageNr;

	foreach ($e->childNodes as $node)
	{
		if ( $node instanceof DomElement && $node->tagName == 'section' )
		{
			loopTopSectionElements( $node );
			$currentSubjectNr++;
			$currentPageNr = 0;
			$index[$currentSubjectNr]['children'] = [];
		}
	}
}

function loopTopSectionElements( DomElement $e )
{
	$currentTitle = '';

	foreach ($e->childNodes as $node)
	{
		if ( $node instanceof DomElement )
		{
			if ( $node->tagName == 'title' )
			{
				$currentTitle = $node->textContent;
			}
			if ( $node->tagName == 'section' )
			{
				processSubject( $currentTitle, $node );
			}
		}
	}
}

function processSubject( string $currentTitle, $node )
{
	global $index;
	global $currentSubjectNr;
	global $currentPageNr;

	$index[$currentSubjectNr]['title'] = $currentTitle;

	$currentTitle = '';
	$paras = [];
	$code = '';

	foreach ($node->childNodes as $node )
	{
		if ( $node instanceof DomElement )
		{
			if ( $node->tagName == 'title' )
			{
				$currentTitle = $node->textContent;
			}
			if ( $node->tagName == 'para' )
			{
				$paras[] = processPara( $node );
			}
			if ( $node->tagName === 'literallayout' )
			{
				$code .= $node->nodeValue;
			}
		}
	}

	processPage( $currentTitle, $paras, $code );
	$currentPageNr++;
}

function processPage( string $title, array $paras, string $code )
{
	global $index;
	global $currentSubjectNr;
	global $currentPageNr;


	$content = "<h1>$title</h1>\n\n";

	foreach ($paras as $para) {
		$content .= "<p>{$para}</p>\n";
	}

	var_dump($currentSubjectNr, $currentPageNr, $content, $code);
	$index[$currentSubjectNr]['children'][$currentPageNr]['title'] = $title;
}

function processPara( DomElement $node )
{
	$text = '';

	foreach ($node->childNodes as $node )
	{
		$text .= match ( true )
		{
			$node instanceof DomText => $node->textContent,
			$node instanceof DomElement && $node->tagName == 'literal' => "<code>{$node->nodeValue}</code>",
		};
	}

	return $text;
}
