<!DOCTYPE html>
<html>
<head>
	<title>A Tour of PHP: Table of Contents</title>
	<link media='all' rel='stylesheet' href='//shared.php.net/styles/defaults.css?filemtime=1732659607'/>
	<link media='all' rel='stylesheet' href='/css/style.css'/>
</head>

<body>
<div name="content">
<header class='clearfix'>
  <div id="mainmenu-toggle-overlay"></div>
  <nav class="fullscreen">
    <div class="mainscreen">
      <a href="/" class="home"><img src="//php.net/images/logo.php?tour" width="48" height="24" alt="php"><span class="subdomain">tour</span></a>
      <ul>
        <li class="active"><a href="./">PHP Tour</a></li>
        <li class=""><a href="//www.php.net/manual/en/langref.php">PHP Documentation</a></li>
      </ul>
    </div>
  </nav>

	<div id="breadcrumbs">
		<div id="breadcrumbs-inner">
			<ul>
				<li><a href="/toc">Table of Contents</a></li>
			</ul>
		</div>
	</div>
</header>

<dl class="toc">
<?php foreach ($index as $sIdx => $subject) : ?>
	<dt><a href="/<?= $sIdx; ?>"><?= $subject['title']; ?></a></dt>
	<?php foreach ($subject['children'] as $lIdx => $lesson) : ?>
		<dd><a href="/<?= $sIdx; ?>/<?= $lIdx; ?>"><?= $lesson['title']; ?></a></dd>
	<?php endforeach ?>
<?php endforeach ?>
</dl>

</div>
</body>
