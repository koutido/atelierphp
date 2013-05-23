<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Search mode</title>


</head>

<body>
Affichage des réservations
<br><br/>
<form name="Display" id="display" method="post" action="display_room.php" >
<table> 
	<tr>
		<td><input type="submit" name="all" value="Afficher toutes les réservations"></td>
	</tr>	
</table>

<br> <br>
<table> 
<tr>
	<td>Recherche par date</td>
	<td>&nbsp; &nbsp;</td>
	<td>
	<?php
	echo '<select name="jour">';
	echo '<option value="" selected></option>';
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option>';
	echo '<option value="3">3</option>';
	echo '<option value="4">4</option>';
	echo '<option value="5">5</option>';
	echo '<option value="6">6</option>';
	echo '<option value="7">7</option>';
	echo '<option value="8">8</option>';
	echo '<option value="9">9</option>';
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '<option value="13">13</option>';
	echo '<option value="14">14</option>';
	echo '<option value="15">15</option>';
	echo '<option value="16">16</option>';
	echo '<option value="17">17</option>';
	echo '<option value="18">18</option>';
	echo '<option value="19">19</option>';
	echo '<option value="20">20</option>';
	echo '<option value="21">21</option>';
	echo '<option value="22">22</option>';
	echo '<option value="23">23</option>';
	echo '<option value="24">24</option>';
	echo '<option value="25">25</option>';
	echo '<option value="26">26</option>';
	echo '<option value="27">27</option>';
	echo '<option value="28">28</option>';
	echo '<option value="29">29</option>';
	echo '<option value="30">30</option>';	
	echo '<option value="31">31</option>';
	echo '</select>';
	?>
	</td>
	
	<td>
	<?php
	echo '<select name="mois">';
	echo '<option value="" selected></option>';
	echo '<option value="1">1</option>';
	echo '<option value="2">2</option>';
	echo '<option value="3">3</option>';
	echo '<option value="4">4</option>';
	echo '<option value="5">5</option>';
	echo '<option value="6">6</option>';
	echo '<option value="7">7</option>';
	echo '<option value="8">8</option>';
	echo '<option value="9">9</option>';
	echo '<option value="10">10</option>';
	echo '<option value="11">11</option>';
	echo '<option value="12">12</option>';
	echo '</select>';
	?>
	</td>
	
	<td>
	<?php
	echo '<select name="an">';
	echo '<option value="2013" selected>2013</option>';
	echo '<option value="2014">2014</option>';
	echo '<option value="2015">2015</option>';
	echo '</select>';
	?>
	</td>
	<td>&nbsp; &nbsp; &nbsp;</td>
	<td><input type="submit" name="date" value="Valider"></td>
</tr>
</table>

<br> <br>
<table>
	<tr>
		<td>Recherche par email</td>
		<td>&nbsp; &nbsp;</td>
		<td><input type="email" name="email"></td>
		<td>&nbsp; &nbsp; &nbsp;</td>
		<td><input type="submit" name="adresse" value="Valider"></td>
	</tr>
</table>

<br> <br>
<table>
	<tr>
		<td>Recherche par code PIN</td>
		<td>&nbsp; &nbsp;</td>
		<td><input type="number" name="pin"></td>
		<td>&nbsp; &nbsp; &nbsp;</td>
		<td><input type="submit" name="code" value="Valider"></td>
	</tr>
</table>

</html>
