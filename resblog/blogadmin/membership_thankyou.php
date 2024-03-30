<?php
	$currentDirectory = dirname(__FILE__);
	require_once("$currentDirectory/defaultLang.php");
	require_once("$currentDirectory/language.php");
	require_once("$currentDirectory/lib.php");
	require_once("$currentDirectory/header.php");

	if (isset($_GET['redir']) && $_GET['redir'] == 1) {
		echo '<META HTTP-EQUIV="Refresh" CONTENT="5;url=index.php?signIn=1">';
	}
?>

<center>
	<div style="width: 500px; text-align: left;">
		<h1 class="TableTitle"><?php echo htmlspecialchars($Translation['thanks']); ?></h1>

		<img src="handshake.jpg"><br><br>
		<div class="TableBody">
			<?php printf($Translation['sign in no approval'], htmlspecialchars($Translation['sign in'])); ?>
		</div><br>
		<div class="TableBody">
			<?php printf($Translation['sign in wait approval'], htmlspecialchars($Translation['sign in'])); ?>
		</div>
	</div>
</center>

<?php require_once("$currentDirectory/footer.php"); ?>
