<link rel="stylesheet" type="text/css" href="/div/header.css">
<link rel="stylesheet" type="text/css" href="/logginn/logginn.css">
<script>
	function goBack() {
		window.history.back();
		}

		function hover(element){
			element.setAttribute('src', "/bilder/backButtonHover.png");
		}

		function hoverOut(element){
			element.setAttribute('src', "/bilder/backButton.png");
		}
</script>
<script src="/logginn/loginn.js"></script>
<div id="wrapper">
	<header>
		<button id="tilbake" onClick="goBack()"><img onmouseover="hover(this)" onmouseout="hoverOut(this)" style="height: 30px;" src="/bilder/backButton.png"></button>
		<a id="link" href ="/index.php" ><img id="logo" src="/bilder/logoNy.png" ></a>
	</header>