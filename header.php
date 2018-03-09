
<button onClick="goBack()" style="position:absolute; left:20px; top:15px;">Tilbake</button>
<script>
	function goBack() {
		window.history.back();
	}
</script>
<img src="bilder/tempLogo.jpg" href="yogurt/index.php" style="margin:auto; width:600px; display:block;">

<!--if(!loggedinn()){ -->
<div class="loginn">
    <form method="POST" action="Brukerside.php">
        <input type="text" name="bruker" id="Brukernavn" placeholder="BrukerID" style="width: 75px; height: 15px">
        <br>
        <input type="password" name="passord" id="pass" placeholder="Passord" style="width: 75px; height: 15px">
        <br>
        <input type="submit" name="" value="Logg inn" style=" width: 65px; height: 20px">
    </form>
</div>