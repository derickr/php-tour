<!DOCTYPE html>
<html>
<head>
	<title>A Tour of PHP: <?= $page['title']; ?></title>
	<link media='all' rel='stylesheet' href='//shared.php.net/styles/defaults.css?filemtime=1732659607'/>
	<link media='all' rel='stylesheet' href='/css/style.css'/>
	<script type="application/javascript" src="/js/ui.js"></script>
	<script type="module" src="/js/interactive-examples.js"></script>
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
			<?php if ($nextTitle !== false): ?>
			<div class="next">
				<a href="<?= $nextPage; ?>"> <?= $nextTitle; ?> » </a>
			</div>
			<?php endif; ?>

			<?php if ($prevTitle !== false): ?>
			<div class="prev">
				<a href="<?= $prevPage; ?>"> « <?= $prevTitle; ?> </a>
			</div>
			<?php endif; ?>

			<ul>
				<?php foreach ($breadCrumps as $breadCrump): ?>
				<li><a href="<?= $breadCrump['page'] ?>"><?= $breadCrump['title'] ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</header>

<table>
<tr>
<td>
	<?= $text; ?>

	<? if ($prevTitle !== false) : ?>
	<button type="button" onClick="goToLesson('<?= $prevPage ?>');">Prev</button>
	<? endif; ?>

	<? if ($nextTitle !== false) : ?>
	<button type="button" onClick="goToLesson('<?= $nextPage ?>');">Next</button>
	<? endif; ?>
</td>
<td id="right">
	<div class="example">
		<div class="example-contents">
			<div id="monaco" class="phpcode">
				<code><?= htmlspecialchars($code); ?></code>
			</div>
		</div>
	</div>
	<div id="outputContainer">
		<div id="outputDiv">
		</div>
	</div>
</td>
</tr>
</table>

</div>
</body>
