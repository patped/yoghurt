<?php
function tilsynsrapport($tilsynid) {
	require_once '../database.php';
	$db = kobleOpp();
	$sql = "SELECT tilsynsobjektid, status, dato, tilsynsbesoektype FROM Tilsynsrapporter WHERE tilsynid LIKE ?;";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, 's', $tilsynid);
	mysqli_stmt_execute($stmt);
	$svar = mysqli_stmt_get_result($stmt);
	lukk($db);
	return mysqli_fetch_assoc($svar);
}
?>