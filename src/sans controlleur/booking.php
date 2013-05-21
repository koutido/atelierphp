<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Booking room</title>

<body>
Sélectionner une salle
<form action="check_ressource.php" method="post" name="page_1">
<table> 
<tr>
	<td>Salle</td>
	<td>
	<?php
	echo '<select name="room_number">';
	echo '<option value="" selected></option>';
	echo '<option value="1">Virtuelle 1</option>';
	echo '<option value="2">Virtuelle 2</option>';
	echo '<option value="3">Virtuelle 3</option>';
	echo '<option value="4">Virtuelle 4</option>';
	echo '</select>';
	?>
	</td>
	<td>&nbsp; &nbsp; &nbsp;</td>
	<td>Demandeur</td>
	<td><input type="text" name="email"></td>
</tr>
</table>
<br/>
Entrer la date de réservation

<table> 
<tr>
	<td>De</td>
	<td>
	<?php
	echo '<select name="start_date">';
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
	echo '<select name="start_month">';
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
	echo '<select name="start_year">';
	echo '<option value="2013" selected>2013</option>';
	echo '<option value="2014">2014</option>';
	echo '<option value="2015">2015</option>';
	echo '</select>';
	?>
	</td>
	
	<td>
	<?php
	echo '<select name="start_hour">';
	echo '<option value="" selected></option>';
	echo '<option value="00">00</option>';
	echo '<option value="01">01</option>';
	echo '<option value="02">02</option>';
	echo '<option value="03">03</option>';
	echo '<option value="04">04</option>';
	echo '<option value="05">05</option>';
	echo '<option value="06">06</option>';
	echo '<option value="07">07</option>';
	echo '<option value="08">08</option>';
	echo '<option value="09">09</option>';
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
	echo '</select>';
	?>
	</td>
	<td>h</td>
	<td>
	<?php
	echo '<select name="start_minute">';
	echo '<option value="" selected></option>';
	echo '<option value="00">00</option>';
	echo '<option value="05">05</option>';
	echo '<option value="10">10</option>';
	echo '<option value="15">15</option>';
	echo '<option value="20">20</option>';
	echo '<option value="25">25</option>';
	echo '<option value="30">30</option>';
	echo '<option value="35">35</option>';
	echo '<option value="40">40</option>';
	echo '<option value="45">45</option>';
	echo '<option value="50">50</option>';
	echo '<option value="55">55</option>';
	echo '<option value="60">60</option>';
	echo '</select>';
	?>
	</td>
</tr>

<tr>
	<td>A`</td>
	<td>
	<?php
	echo '<select name="end_date">';
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
	echo '<select name="end_month">';
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
	echo '<select name="end_year">';
	echo '<option value="2013" selected>2013</option>';
	echo '<option value="2014">2014</option>';
	echo '<option value="2015">2015</option>';
	echo '</select>';
	?>
	</td>
	
	<td>
	<?php
	echo '<select name="end_hour">';
	echo '<option value="" selected></option>';
	echo '<option value="00">00</option>';
	echo '<option value="01">01</option>';
	echo '<option value="02">02</option>';
	echo '<option value="03">03</option>';
	echo '<option value="04">04</option>';
	echo '<option value="05">05</option>';
	echo '<option value="06">06</option>';
	echo '<option value="07">07</option>';
	echo '<option value="08">08</option>';
	echo '<option value="09">09</option>';
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
	echo '</select>';
	?>
	</td>
	<td>h</td>
	<td>
	<?php
	echo '<select name="end_minute">';
	echo '<option value="" selected></option>';
	echo '<option value="00">00</option>';
	echo '<option value="05">05</option>';
	echo '<option value="10">10</option>';
	echo '<option value="15">15</option>';
	echo '<option value="20">20</option>';
	echo '<option value="25">25</option>';
	echo '<option value="30">30</option>';
	echo '<option value="35">35</option>';
	echo '<option value="40">40</option>';
	echo '<option value="45">45</option>';
	echo '<option value="50">50</option>';
	echo '<option value="55">55</option>';
	echo '<option value="60">60</option>';
	echo '</select>';
	?>
	</td>
	<td>&nbsp; &nbsp; &nbsp;</td>
	<td><input type="submit" value="Réserver"></td>
</tr>

</table>
</form>


</body>
</html>

