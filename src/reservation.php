<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Search room</title>

<script LANG="JavaScript">
<!--

function verif_champs(){

	if (document.forms[0].email.value.length<5){
		alert("Veuillez entrer l'adresse mail du demandeur");
		document.forms[0].email.focus();
		return false;
	}
	if (document.forms[0].start_date.value.length<1){
		alert("Veuillez choisir la date de début");
		document.forms[0].start_date.focus();
		return false;
	}
	if (document.forms[0].start_month.value.length<1){
		alert("Veuillez choisir le mois de début");
		document.forms[0].start_month.focus();
		return false;
	}
	if (document.forms[0].start_year.value.length<1){
		alert("Veuillez choisir l'année de début");
		document.forms[0].start_year.focus();
		return false;
	}
	if (document.forms[0].start_hour.value.length<1){
		alert("Veuillez choisir l'heure de début");
		document.forms[0].start_hour.focus();
		return false;
	}
	if (document.forms[0].start_minute.value.length<1){
		alert("Veuillez choisir les minutes de début");
		document.forms[0].start_minute.focus();
		return false;
	}
	if (document.forms[0].end_date.value.length<1){
		alert("Veuillez choisir la date de fin");
		document.forms[0].end_date.focus();
		return false;
	}
	if (document.forms[0].end_month.value.length<1){
		alert("Veuillez choisir le mois de fin");
		document.forms[0].end_month.focus();
		return false;
	}
	if (document.forms[0].end_year.value.length<1){
		alert("Veuillez choisir l'année de fin");
		document.forms[0].end_year.focus();
		return false;
	}
	if (document.forms[0].end_hour.value.length<1){
		alert("Veuillez choisir l'heure de fin");
		document.forms[0].end_hour.focus();
		return false;
	}
	if (document.forms[0].end_minute.value.length<1){
		alert("Veuillez choisir les minutes de fin");
		document.forms[0].end_minute.focus();
		return false;
	}
	
	
	return true;
}

function verif_email (){
	var c=document.forms[0].email.value;
	var test="" + c;
	for(var k = 0; k < test.length;k++){
		var d = test.substring(k,k+1);
		if(d == "@"){
			return true;
		}
	}
	alert("L'adresse email du demandeur n'est pas valide. Merci de vérifier");
	document.forms[0].email.focus();
	return false;
}

function verif_date_time(){
	var start_date=document.forms[0].start_date.value;
	var start_month=document.forms[0].start_month.value;
	var start_year=document.forms[0].start_year.value;
	var end_date=document.forms[0].end_date.value;
	var end_month=document.forms[0].end_month.value;
	var end_year=document.forms[0].end_year.value;
	var start_hour=document.forms[0].start_hour.value;
	var start_minute=document.forms[0].start_minute.value;
	var end_hour=document.forms[0].end_hour.value;
	var end_minute=document.forms[0].end_minute.value;
	
	if(start_date==end_date && start_month==end_month && start_year==end_year){
		if(start_hour==end_hour && start_minute>=end_minute){
			alert("Merci de vérifier les minutes de début");
			document.forms[0].start_minute.focus();
			return false;			
		}
		if(start_hour>end_hour){
			alert("Merci de vérifier l'heure de début");
			document.forms[0].start_hour.focus();
			return false;			
		}
	}
	if(start_month==end_month && start_year==end_year){
		if(start_date>end_date){
			alert("Merci de vérifier la date de début");
			document.forms[0].start_date.focus();
			return false;
		}
	}
	if(start_year==end_year){
		if(start_month>end_month){
			alert("Merci de vérifier le mois de début");
			document.forms[0].start_month.focus();
			return false;
		}
	}
	else{
		if(start_year>end_year){
			alert("Merci de vérifier l'année de début");
			document.forms[0].start_year.focus();
			return false;
		}
	}

	
	return true;	
}
function verif_formulaire(){
	if (verif_champs()==true && verif_email()==true && verif_date_time()==true){
		return true;
	}
	return false;
}

</script>

</head>

<body>
Rechercher une salle
<br><br/>
<form name="reservation" action="recherche.php" method="post" onSubmit="return verif_formulaire()">
<table> 
<tr>
	<td>Demandeur</td>
	<td><input type="text" name="email"></td>
</tr>
</table>

<br/>
<br><br/>
Entrer la date de réservation
<br><br/>
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
	echo '</select>';
	?>
	</td>
	<td>&nbsp; &nbsp; &nbsp;</td>
	<td><input type="submit" name="recherche" value="Rechercher une salle disponible"></td>
</tr>
</table>
</form>


</body>
</html>