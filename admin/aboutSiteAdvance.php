<?php require_once("db_conn.php")?><?php require_once("adminCheck.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 网站设置 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Jiangting@WiiPu -- http://www.wiipu.com" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </head>
 <?php
	$sqlStr="select  * from wiichat_site limit 0,1";
	$rs=mysql_query($sqlStr);
	$row=mysql_fetch_assoc($rs);
	If(!$row){
		alertInfo("数据库初始化失败！","",0);
	}Else{
		$filter=HTMLDecode($row['site_filter']);
		$mailSMTP=$row["site_mailSMTP"];
		$mailAddress=$row["site_mailAddress"];
		$mailAccount=$row["site_mailAccount"];
		$mailPassword=$row["site_mailPassword"];
		$timezone=$row['site_timezone'];
	}
 ?>
 <body>
 	<div class="bgintor">
		<div class="tit1">
			<ul>
				<li class="l1"><a href="aboutSite.php" target="mainFrame" >基本设置</a> </li>
				<li><a href="#">高级设置</a> </li>
				<li class="l1"><a href="aboutSiteUC.php">UCenter设置</a> </li>
			</ul>		
		</div>
		<div class="listintor">
			<div class="header1"><img src="images/square.gif" width="6" height="6" alt="" />
				<span>位置：聊天室管理 －&gt; <strong>网站高级设置</strong></span>
			</div>
			<div class="header2"><span>网站高级设置</span>
			</div>
			<div class="fromcontent">
				<form id="form2" name="addForm" method="post" action="aboutSite_do.php?act=advance">
					<p>时区
				  <select id="timezone" name="timezone">
					<optgroup label="Africa">
					<option value="Africa/Abidjan"<?php if($timezone=="value") echo " selected='selected'"?>>Abidjan</option>
					<option value="Africa/Accra"<?php if($timezone=="Africa/Accra") echo " selected='selected'"?>>Accra</option>
					<option value="Africa/Addis_Ababa"<?php if($timezone=="Africa/Addis_Ababa") echo " selected='selected'"?>>Addis Ababa</option>
					<option value="Africa/Algiers"<?php if($timezone=="Africa/Algiers") echo " selected='selected'"?>>Algiers</option>
					<option value="Africa/Asmara"<?php if($timezone=="Africa/Asmara") echo " selected='selected'"?>>Asmara</option>

					<option value="Africa/Asmera"<?php if($timezone=="Africa/Asmera") echo " selected='selected'"?>>Asmera</option>
					<option value="Africa/Bamako"<?php if($timezone=="Africa/Bamako") echo " selected='selected'"?>>Bamako</option>
					<option value="Africa/Bangui"<?php if($timezone=="Africa/Bangui") echo " selected='selected'"?>>Bangui</option>
					<option value="Africa/Banjul"<?php if($timezone=="Africa/Banjul") echo " selected='selected'"?>>Banjul</option>
					<option value="Africa/Bissau"<?php if($timezone=="Africa/Bissau") echo " selected='selected'"?>>Bissau</option>
					<option value="Africa/Blantyre"<?php if($timezone=="Africa/Blantyre") echo " selected='selected'"?>>Blantyre</option>
					<option value="Africa/Brazzaville"<?php if($timezone=="Africa/Brazzaville") echo " selected='selected'"?>>Brazzaville</option>
					<option value="Africa/Bujumbura"<?php if($timezone=="Africa/Bujumbura") echo " selected='selected'"?>>Bujumbura</option>
					<option value="Africa/Cairo"<?php if($timezone=="Africa/Cairo") echo " selected='selected'"?>>Cairo</option>

					<option value="Africa/Casablanca"<?php if($timezone=="Africa/Casablanca") echo " selected='selected'"?>>Casablanca</option>
					<option value="Africa/Ceuta"<?php if($timezone=="Africa/Ceuta") echo " selected='selected'"?>>Ceuta</option>
					<option value="Africa/Conakry"<?php if($timezone=="Africa/Conakry") echo " selected='selected'"?>>Conakry</option>
					<option value="Africa/Dakar"<?php if($timezone=="Africa/Dakar") echo " selected='selected'"?>>Dakar</option>
					<option value="Africa/Dar_es_Salaam"<?php if($timezone=="Africa/Dar_es_Salaam") echo " selected='selected'"?>>Dar es Salaam</option>
					<option value="Africa/Djibouti"<?php if($timezone=="Africa/Djibouti") echo " selected='selected'"?>>Djibouti</option>
					<option value="Africa/Douala"<?php if($timezone=="Africa/Douala") echo " selected='selected'"?>>Douala</option>
					<option value="Africa/El_Aaiun"<?php if($timezone=="Africa/El_Aaiun") echo " selected='selected'"?>>El Aaiun</option>
					<option value="Africa/Freetown"<?php if($timezone=="Africa/Freetown") echo " selected='selected'"?>>Freetown</option>

					<option value="Africa/Gaborone"<?php if($timezone=="Africa/Gaborone") echo " selected='selected'"?>>Gaborone</option>
					<option value="Africa/Harare"<?php if($timezone=="Africa/Harare") echo " selected='selected'"?>>Harare</option>
					<option value="Africa/Johannesburg"<?php if($timezone=="Africa/Johannesburg") echo " selected='selected'"?>>Johannesburg</option>
					<option value="Africa/Kampala"<?php if($timezone=="Africa/Kampala") echo " selected='selected'"?>>Kampala</option>
					<option value="Africa/Khartoum"<?php if($timezone=="Africa/Khartoum") echo " selected='selected'"?>>Khartoum</option>
					<option value="Africa/Kigali"<?php if($timezone=="Africa/Kigali") echo " selected='selected'"?>>Kigali</option>
					<option value="Africa/Kinshasa"<?php if($timezone=="Africa/Kinshasa") echo " selected='selected'"?>>Kinshasa</option>
					<option value="Africa/Lagos"<?php if($timezone=="Africa/Lagos") echo " selected='selected'"?>>Lagos</option>
					<option value="Africa/Libreville"<?php if($timezone=="Africa/Libreville") echo " selected='selected'"?>>Libreville</option>

					<option value="Africa/Lome"<?php if($timezone=="Africa/Lome") echo " selected='selected'"?>>Lome</option>
					<option value="Africa/Luanda"<?php if($timezone=="Africa/Luanda") echo " selected='selected'"?>>Luanda</option>
					<option value="Africa/Lubumbashi"<?php if($timezone=="Africa/Lubumbashi") echo " selected='selected'"?>>Lubumbashi</option>
					<option value="Africa/Lusaka"<?php if($timezone=="Africa/Lusaka") echo " selected='selected'"?>>Lusaka</option>
					<option value="Africa/Malabo"<?php if($timezone=="Africa/Malabo") echo " selected='selected'"?>>Malabo</option>
					<option value="Africa/Maputo"<?php if($timezone=="Africa/Maputo") echo " selected='selected'"?>>Maputo</option>
					<option value="Africa/Maseru"<?php if($timezone=="Africa/Maseru") echo " selected='selected'"?>>Maseru</option>
					<option value="Africa/Mbabane"<?php if($timezone=="Africa/Mbabane") echo " selected='selected'"?>>Mbabane</option>
					<option value="Africa/Mogadishu"<?php if($timezone=="Africa/Mogadishu") echo " selected='selected'"?>>Mogadishu</option>

					<option value="Africa/Monrovia"<?php if($timezone=="Africa/Monrovia") echo " selected='selected'"?>>Monrovia</option>
					<option value="Africa/Nairobi"<?php if($timezone=="Africa/Nairobi") echo " selected='selected'"?>>Nairobi</option>
					<option value="Africa/Ndjamena"<?php if($timezone=="Africa/Ndjamena") echo " selected='selected'"?>>Ndjamena</option>
					<option value="Africa/Niamey"<?php if($timezone=="Africa/Niamey") echo " selected='selected'"?>>Niamey</option>
					<option value="Africa/Nouakchott"<?php if($timezone=="Africa/Nouakchott") echo " selected='selected'"?>>Nouakchott</option>
					<option value="Africa/Ouagadougou"<?php if($timezone=="Africa/Ouagadougou") echo " selected='selected'"?>>Ouagadougou</option>
					<option value="Africa/Porto-Novo"<?php if($timezone=="Africa/Porto-Novo") echo " selected='selected'"?>>Porto-Novo</option>
					<option value="Africa/Sao_Tome"<?php if($timezone=="Africa/Sao_Tome") echo " selected='selected'"?>>Sao Tome</option>
					<option value="Africa/Timbuktu"<?php if($timezone=="Africa/Timbuktu") echo " selected='selected'"?>>Timbuktu</option>

					<option value="Africa/Tripoli"<?php if($timezone=="Africa/Tripoli") echo " selected='selected'"?>>Tripoli</option>
					<option value="Africa/Tunis"<?php if($timezone=="Africa/Tunis") echo " selected='selected'"?>>Tunis</option>
					<option value="Africa/Windhoek"<?php if($timezone=="Africa/Windhoek") echo " selected='selected'"?>>Windhoek</option>
					</optgroup>
					<optgroup label="America">
					<option value="America/Adak"<?php if($timezone=="America/Adak") echo " selected='selected'"?>>Adak</option>
					<option value="America/Anchorage"<?php if($timezone=="America/Anchorage") echo " selected='selected'"?>>Anchorage</option>
					<option value="America/Anguilla"<?php if($timezone=="America/Anguilla") echo " selected='selected'"?>>Anguilla</option>
					<option value="America/Antigua"<?php if($timezone=="America/Antigua") echo " selected='selected'"?>>Antigua</option>
					<option value="America/Araguaina"<?php if($timezone=="America/Araguaina") echo " selected='selected'"?>>Araguaina</option>

					<option value="America/Argentina/Buenos_Aires"<?php if($timezone=="America/Argentina/Buenos_Aires") echo " selected='selected'"?>>Argentina - Buenos Aires</option>
					<option value="America/Argentina/Catamarca"<?php if($timezone=="America/Argentina/Catamarca") echo " selected='selected'"?>>Argentina - Catamarca</option>
					<option value="America/Argentina/ComodRivadavia"<?php if($timezone=="America/Argentina/ComodRivadavia") echo " selected='selected'"?>>Argentina - ComodRivadavia</option>
					<option value="America/Argentina/Cordoba"<?php if($timezone=="America/Argentina/Cordoba") echo " selected='selected'"?>>Argentina - Cordoba</option>
					<option value="America/Argentina/Jujuy"<?php if($timezone=="America/Argentina/Jujuy") echo " selected='selected'"?>>Argentina - Jujuy</option>
					<option value="America/Argentina/La_Rioja"<?php if($timezone=="America/Argentina/La_Rioja") echo " selected='selected'"?>>Argentina - La Rioja</option>
					<option value="America/Argentina/Mendoza"<?php if($timezone=="America/Argentina/Mendoza") echo " selected='selected'"?>>Argentina - Mendoza</option>
					<option value="America/Argentina/Rio_Gallegos"<?php if($timezone=="America/Argentina/Rio_Gallegos") echo " selected='selected'"?>>Argentina - Rio Gallegos</option>
					<option value="America/Argentina/Salta"<?php if($timezone=="America/Argentina/Salta") echo " selected='selected'"?>>Argentina - Salta</option>

					<option value="America/Argentina/San_Juan"<?php if($timezone=="America/Argentina/San_Juan") echo " selected='selected'"?>>Argentina - San Juan</option>
					<option value="America/Argentina/San_Luis"<?php if($timezone=="America/Argentina/San_Luis") echo " selected='selected'"?>>Argentina - San Luis</option>
					<option value="America/Argentina/Tucuman"<?php if($timezone=="America/Argentina/Tucuman") echo " selected='selected'"?>>Argentina - Tucuman</option>
					<option value="America/Argentina/Ushuaia"<?php if($timezone=="America/Argentina/Ushuaia") echo " selected='selected'"?>>Argentina - Ushuaia</option>
					<option value="America/Aruba"<?php if($timezone=="America/Aruba") echo " selected='selected'"?>>Aruba</option>
					<option value="America/Asuncion"<?php if($timezone=="America/Asuncion") echo " selected='selected'"?>>Asuncion</option>
					<option value="America/Atikokan"<?php if($timezone=="America/Atikokan") echo " selected='selected'"?>>Atikokan</option>
					<option value="America/Atka"<?php if($timezone=="America/Atka") echo " selected='selected'"?>>Atka</option>
					<option value="America/Bahia"<?php if($timezone=="America/Bahia") echo " selected='selected'"?>>Bahia</option>

					<option value="America/Barbados"<?php if($timezone=="America/Barbados") echo " selected='selected'"?>>Barbados</option>
					<option value="America/Belem"<?php if($timezone=="America/Belem") echo " selected='selected'"?>>Belem</option>
					<option value="America/Belize"<?php if($timezone=="America/Belize") echo " selected='selected'"?>>Belize</option>
					<option value="America/Blanc-Sablon"<?php if($timezone=="America/Blanc-Sablon") echo " selected='selected'"?>>Blanc-Sablon</option>
					<option value="America/Boa_Vista"<?php if($timezone=="America/Boa_Vista") echo " selected='selected'"?>>Boa Vista</option>
					<option value="America/Bogota"<?php if($timezone=="America/Bogota") echo " selected='selected'"?>>Bogota</option>
					<option value="America/Boise"<?php if($timezone=="America/Boise") echo " selected='selected'"?>>Boise</option>
					<option value="America/Buenos_Aires"<?php if($timezone=="America/Buenos_Aires") echo " selected='selected'"?>>Buenos Aires</option>
					<option value="America/Cambridge_Bay"<?php if($timezone=="America/Cambridge_Bay") echo " selected='selected'"?>>Cambridge Bay</option>

					<option value="America/Campo_Grande"<?php if($timezone=="America/Campo_Grande") echo " selected='selected'"?>>Campo Grande</option>
					<option value="America/Cancun"<?php if($timezone=="America/Cancun") echo " selected='selected'"?>>Cancun</option>
					<option value="America/Caracas"<?php if($timezone=="America/Caracas") echo " selected='selected'"?>>Caracas</option>
					<option value="America/Catamarca"<?php if($timezone=="America/Catamarca") echo " selected='selected'"?>>Catamarca</option>
					<option value="America/Cayenne"<?php if($timezone=="America/Cayenne") echo " selected='selected'"?>>Cayenne</option>
					<option value="America/Cayman"<?php if($timezone=="America/Cayman") echo " selected='selected'"?>>Cayman</option>
					<option value="America/Chicago"<?php if($timezone=="America/Chicago") echo " selected='selected'"?>>Chicago</option>
					<option value="America/Chihuahua"<?php if($timezone=="America/Chihuahua") echo " selected='selected'"?>>Chihuahua</option>
					<option value="America/Coral_Harbour"<?php if($timezone=="America/Coral_Harbour") echo " selected='selected'"?>>Coral Harbour</option>

					<option value="America/Cordoba"<?php if($timezone=="America/Cordoba") echo " selected='selected'"?>>Cordoba</option>
					<option value="America/Costa_Rica"<?php if($timezone=="America/Costa_Rica") echo " selected='selected'"?>>Costa Rica</option>
					<option value="America/Cuiaba"<?php if($timezone=="America/Cuiaba") echo " selected='selected'"?>>Cuiaba</option>
					<option value="America/Curacao"<?php if($timezone=="America/Curacao") echo " selected='selected'"?>>Curacao</option>
					<option value="America/Danmarkshavn"<?php if($timezone=="America/Danmarkshavn") echo " selected='selected'"?>>Danmarkshavn</option>
					<option value="America/Dawson"<?php if($timezone=="America/Dawson") echo " selected='selected'"?>>Dawson</option>
					<option value="America/Dawson_Creek"<?php if($timezone=="America/Dawson_Creek") echo " selected='selected'"?>>Dawson Creek</option>
					<option value="America/Denver"<?php if($timezone=="America/Denver") echo " selected='selected'"?>>Denver</option>
					<option value="America/Detroit"<?php if($timezone=="America/Detroit") echo " selected='selected'"?>>Detroit</option>

					<option value="America/Dominica"<?php if($timezone=="America/Dominica") echo " selected='selected'"?>>Dominica</option>
					<option value="America/Edmonton"<?php if($timezone=="America/Edmonton") echo " selected='selected'"?>>Edmonton</option>
					<option value="America/Eirunepe"<?php if($timezone=="America/Eirunepe") echo " selected='selected'"?>>Eirunepe</option>
					<option value="America/El_Salvador"<?php if($timezone=="America/El_Salvador") echo " selected='selected'"?>>El Salvador</option>
					<option value="America/Ensenada"<?php if($timezone=="America/Ensenada") echo " selected='selected'"?>>Ensenada</option>
					<option value="America/Fortaleza"<?php if($timezone=="America/Fortaleza") echo " selected='selected'"?>>Fortaleza</option>
					<option value="America/Fort_Wayne"<?php if($timezone=="America/Fort_Wayne") echo " selected='selected'"?>>Fort Wayne</option>
					<option value="America/Glace_Bay"<?php if($timezone=="America/Glace_Bay") echo " selected='selected'"?>>Glace Bay</option>
					<option value="America/Godthab"<?php if($timezone=="America/Godthab") echo " selected='selected'"?>>Godthab</option>

					<option value="America/Goose_Bay"<?php if($timezone=="America/Goose_Bay") echo " selected='selected'"?>>Goose Bay</option>
					<option value="America/Grand_Turk"<?php if($timezone=="America/Grand_Turk") echo " selected='selected'"?>>Grand Turk</option>
					<option value="America/Grenada"<?php if($timezone=="America/Grenada") echo " selected='selected'"?>>Grenada</option>
					<option value="America/Guadeloupe"<?php if($timezone=="America/Guadeloupe") echo " selected='selected'"?>>Guadeloupe</option>
					<option value="America/Guatemala"<?php if($timezone=="America/Guatemala") echo " selected='selected'"?>>Guatemala</option>
					<option value="America/Guayaquil"<?php if($timezone=="America/Guayaquil") echo " selected='selected'"?>>Guayaquil</option>
					<option value="America/Guyana"<?php if($timezone=="America/Guyana") echo " selected='selected'"?>>Guyana</option>
					<option value="America/Halifax"<?php if($timezone=="America/Halifax") echo " selected='selected'"?>>Halifax</option>
					<option value="America/Havana"<?php if($timezone=="America/Havana") echo " selected='selected'"?>>Havana</option>

					<option value="America/Hermosillo"<?php if($timezone=="America/Hermosillo") echo " selected='selected'"?>>Hermosillo</option>
					<option value="America/Indiana/Indianapolis"<?php if($timezone=="America/Indiana/Indianapolis") echo " selected='selected'"?>>Indiana - Indianapolis</option>
					<option value="America/Indiana/Knox"<?php if($timezone=="America/Indiana/Knox") echo " selected='selected'"?>>Indiana - Knox</option>
					<option value="America/Indiana/Marengo"<?php if($timezone=="America/Indiana/Marengo") echo " selected='selected'"?>>Indiana - Marengo</option>
					<option value="America/Indiana/Petersburg"<?php if($timezone=="America/Indiana/Petersburg") echo " selected='selected'"?>>Indiana - Petersburg</option>
					<option value="America/Indiana/Tell_City"<?php if($timezone=="America/Indiana/Tell_City") echo " selected='selected'"?>>Indiana - Tell City</option>
					<option value="America/Indiana/Vevay"<?php if($timezone=="America/Indiana/Vevay") echo " selected='selected'"?>>Indiana - Vevay</option>
					<option value="America/Indiana/Vincennes"<?php if($timezone=="America/Indiana/Vincennes") echo " selected='selected'"?>>Indiana - Vincennes</option>
					<option value="America/Indiana/Winamac"<?php if($timezone=="America/Indiana/Winamac") echo " selected='selected'"?>>Indiana - Winamac</option>

					<option value="America/Indianapolis"<?php if($timezone=="America/Indianapolis") echo " selected='selected'"?>>Indianapolis</option>
					<option value="America/Inuvik"<?php if($timezone=="America/Inuvik") echo " selected='selected'"?>>Inuvik</option>
					<option value="America/Iqaluit"<?php if($timezone=="America/Iqaluit") echo " selected='selected'"?>>Iqaluit</option>
					<option value="America/Jamaica"<?php if($timezone=="America/Jamaica") echo " selected='selected'"?>>Jamaica</option>
					<option value="America/Jujuy"<?php if($timezone=="America/Jujuy") echo " selected='selected'"?>>Jujuy</option>
					<option value="America/Juneau"<?php if($timezone=="America/Juneau") echo " selected='selected'"?>>Juneau</option>
					<option value="America/Kentucky/Louisville"<?php if($timezone=="America/Kentucky/Louisville") echo " selected='selected'"?>>Kentucky - Louisville</option>
					<option value="America/Kentucky/Monticello"<?php if($timezone=="America/Kentucky/Monticello") echo " selected='selected'"?>>Kentucky - Monticello</option>
					<option value="America/Knox_IN"<?php if($timezone=="America/Knox_IN") echo " selected='selected'"?>>Knox IN</option>

					<option value="America/La_Paz"<?php if($timezone=="America/La_Paz") echo " selected='selected'"?>>La Paz</option>
					<option value="America/Lima"<?php if($timezone=="America/Lima") echo " selected='selected'"?>>Lima</option>
					<option value="America/Los_Angeles"<?php if($timezone=="America/Los_Angeles") echo " selected='selected'"?>>Los Angeles</option>
					<option value="America/Louisville"<?php if($timezone=="America/Louisville") echo " selected='selected'"?>>Louisville</option>
					<option value="America/Maceio"<?php if($timezone=="America/Maceio") echo " selected='selected'"?>>Maceio</option>
					<option value="America/Managua"<?php if($timezone=="America/Managua") echo " selected='selected'"?>>Managua</option>
					<option value="America/Manaus"<?php if($timezone=="America/Manaus") echo " selected='selected'"?>>Manaus</option>
					<option value="America/Marigot"<?php if($timezone=="America/Marigot") echo " selected='selected'"?>>Marigot</option>
					<option value="America/Martinique"<?php if($timezone=="America/Martinique") echo " selected='selected'"?>>Martinique</option>

					<option value="America/Mazatlan"<?php if($timezone=="America/Mazatlan") echo " selected='selected'"?>>Mazatlan</option>
					<option value="America/Mendoza"<?php if($timezone=="America/Mendoza") echo " selected='selected'"?>>Mendoza</option>
					<option value="America/Menominee"<?php if($timezone=="America/Menominee") echo " selected='selected'"?>>Menominee</option>
					<option value="America/Merida"<?php if($timezone=="America/Merida") echo " selected='selected'"?>>Merida</option>
					<option value="America/Mexico_City"<?php if($timezone=="America/Mexico_City") echo " selected='selected'"?>>Mexico City</option>
					<option value="America/Miquelon"<?php if($timezone=="America/Miquelon") echo " selected='selected'"?>>Miquelon</option>
					<option value="America/Moncton"<?php if($timezone=="America/Moncton") echo " selected='selected'"?>>Moncton</option>
					<option value="America/Monterrey"<?php if($timezone=="America/Monterrey") echo " selected='selected'"?>>Monterrey</option>
					<option value="America/Montevideo"<?php if($timezone=="America/Montevideo") echo " selected='selected'"?>>Montevideo</option>

					<option value="America/Montreal"<?php if($timezone=="America/Montreal") echo " selected='selected'"?>>Montreal</option>
					<option value="America/Montserrat"<?php if($timezone=="America/Montserrat") echo " selected='selected'"?>>Montserrat</option>
					<option value="America/Nassau"<?php if($timezone=="America/Nassau") echo " selected='selected'"?>>Nassau</option>
					<option value="America/New_York"<?php if($timezone=="America/New_York") echo " selected='selected'"?>>New York</option>
					<option value="America/Nipigon"<?php if($timezone=="America/Nipigon") echo " selected='selected'"?>>Nipigon</option>
					<option value="America/Nome"<?php if($timezone=="America/Nome") echo " selected='selected'"?>>Nome</option>
					<option value="America/Noronha"<?php if($timezone=="America/Noronha") echo " selected='selected'"?>>Noronha</option>
					<option value="America/North_Dakota/Center"<?php if($timezone=="America/North_Dakota/Center") echo " selected='selected'"?>>North Dakota - Center</option>
					<option value="America/North_Dakota/New_Salem"<?php if($timezone=="America/North_Dakota/New_Salem") echo " selected='selected'"?>>North Dakota - New Salem</option>

					<option value="America/Panama"<?php if($timezone=="America/Panama") echo " selected='selected'"?>>Panama</option>
					<option value="America/Pangnirtung"<?php if($timezone=="America/Pangnirtung") echo " selected='selected'"?>>Pangnirtung</option>
					<option value="America/Paramaribo"<?php if($timezone=="America/Paramaribo") echo " selected='selected'"?>>Paramaribo</option>
					<option value="America/Phoenix"<?php if($timezone=="America/Phoenix") echo " selected='selected'"?>>Phoenix</option>
					<option value="America/Port-au-Prince"<?php if($timezone=="America/Port-au-Prince") echo " selected='selected'"?>>Port-au-Prince</option>
					<option value="America/Porto_Acre"<?php if($timezone=="America/Porto_Acre") echo " selected='selected'"?>>Porto Acre</option>
					<option value="America/Port_of_Spain"<?php if($timezone=="America/Port_of_Spain") echo " selected='selected'"?>>Port of Spain</option>
					<option value="America/Porto_Velho"<?php if($timezone=="America/Porto_Velho") echo " selected='selected'"?>>Porto Velho</option>
					<option value="America/Puerto_Rico"<?php if($timezone=="America/Puerto_Rico") echo " selected='selected'"?>>Puerto Rico</option>

					<option value="America/Rainy_River"<?php if($timezone=="America/Rainy_River") echo " selected='selected'"?>>Rainy River</option>
					<option value="America/Rankin_Inlet"<?php if($timezone=="America/Rankin_Inlet") echo " selected='selected'"?>>Rankin Inlet</option>
					<option value="America/Recife"<?php if($timezone=="America/Recife") echo " selected='selected'"?>>Recife</option>
					<option value="America/Regina"<?php if($timezone=="America/Regina") echo " selected='selected'"?>>Regina</option>
					<option value="America/Resolute"<?php if($timezone=="America/Resolute") echo " selected='selected'"?>>Resolute</option>
					<option value="America/Rio_Branco"<?php if($timezone=="America/Rio_Branco") echo " selected='selected'"?>>Rio Branco</option>
					<option value="America/Rosario"<?php if($timezone=="America/Rosario") echo " selected='selected'"?>>Rosario</option>
					<option value="America/Santarem"<?php if($timezone=="America/Santarem") echo " selected='selected'"?>>Santarem</option>
					<option value="America/Santiago"<?php if($timezone=="America/Santiago") echo " selected='selected'"?>>Santiago</option>

					<option value="America/Santo_Domingo"<?php if($timezone=="America/Santo_Domingo") echo " selected='selected'"?>>Santo Domingo</option>
					<option value="America/Sao_Paulo"<?php if($timezone=="America/Sao_Paulo") echo " selected='selected'"?>>Sao Paulo</option>
					<option value="America/Scoresbysund"<?php if($timezone=="America/Scoresbysund") echo " selected='selected'"?>>Scoresbysund</option>
					<option value="America/Shiprock"<?php if($timezone=="America/Shiprock") echo " selected='selected'"?>>Shiprock</option>
					<option value="America/St_Barthelemy"<?php if($timezone=="America/St_Barthelemy") echo " selected='selected'"?>>St Barthelemy</option>
					<option value="America/St_Johns"<?php if($timezone=="America/St_Johns") echo " selected='selected'"?>>St Johns</option>
					<option value="America/St_Kitts"<?php if($timezone=="America/St_Kitts") echo " selected='selected'"?>>St Kitts</option>
					<option value="America/St_Lucia"<?php if($timezone=="America/St_Lucia") echo " selected='selected'"?>>St Lucia</option>
					<option value="America/St_Thomas"<?php if($timezone=="America/St_Thomas") echo " selected='selected'"?>>St Thomas</option>

					<option value="America/St_Vincent"<?php if($timezone=="America/Abidjan") echo " selected='selected'"?>>St Vincent</option>
					<option value="America/Swift_Current"<?php if($timezone=="America/Swift_Current") echo " selected='selected'"?>>Swift Current</option>
					<option value="America/Tegucigalpa"<?php if($timezone=="America/Tegucigalpa") echo " selected='selected'"?>>Tegucigalpa</option>
					<option value="America/Thule"<?php if($timezone=="America/Thule") echo " selected='selected'"?>>Thule</option>
					<option value="America/Thunder_Bay"<?php if($timezone=="America/Thunder_Bay") echo " selected='selected'"?>>Thunder Bay</option>
					<option value="America/Tijuana"<?php if($timezone=="America/Tijuana") echo " selected='selected'"?>>Tijuana</option>
					<option value="America/Toronto"<?php if($timezone=="America/Toronto") echo " selected='selected'"?>>Toronto</option>
					<option value="America/Tortola"<?php if($timezone=="America/Tortola") echo " selected='selected'"?>>Tortola</option>
					<option value="America/Vancouver"<?php if($timezone=="America/Vancouver") echo " selected='selected'"?>>Vancouver</option>

					<option value="America/Virgin"<?php if($timezone=="America/Virgin") echo " selected='selected'"?>>Virgin</option>
					<option value="America/Whitehorse"<?php if($timezone=="America/Whitehorse") echo " selected='selected'"?>>Whitehorse</option>
					<option value="America/Winnipeg"<?php if($timezone=="America/Winnipeg") echo " selected='selected'"?>>Winnipeg</option>
					<option value="America/Yakutat"<?php if($timezone=="America/Yakutat") echo " selected='selected'"?>>Yakutat</option>
					<option value="America/Yellowknife"<?php if($timezone=="America/Yellowknife") echo " selected='selected'"?>>Yellowknife</option>
					</optgroup>
					<optgroup label="Antarctica">
					<option value="Antarctica/Casey"<?php if($timezone=="Abidjan") echo " selected='selected'"?>>Casey</option>
					<option value="Antarctica/Davis"<?php if($timezone=="Abidjan") echo " selected='selected'"?>>Davis</option>
					<option value="Antarctica/DumontDUrville"<?php if($timezone=="Abidjan") echo " selected='selected'"?>>DumontDUrville</option>

					<option value="Antarctica/Mawson"<?php if($timezone=="Antarctica/Mawson") echo " selected='selected'"?>>Mawson</option>
					<option value="Antarctica/McMurdo"<?php if($timezone=="Antarctica/McMurdo") echo " selected='selected'"?>>McMurdo</option>
					<option value="Antarctica/Palmer"<?php if($timezone=="Antarctica/Palmer") echo " selected='selected'"?>>Palmer</option>
					<option value="Antarctica/Rothera"<?php if($timezone=="Antarctica/Rothera") echo " selected='selected'"?>>Rothera</option>
					<option value="Antarctica/South_Pole"<?php if($timezone=="Antarctica/South_Pole") echo " selected='selected'"?>>South Pole</option>
					<option value="Antarctica/Syowa"<?php if($timezone=="Antarctica/Syowa") echo " selected='selected'"?>>Syowa</option>
					<option value="Antarctica/Vostok"<?php if($timezone=="Antarctica/Vostok") echo " selected='selected'"?>>Vostok</option>
					</optgroup>
					<optgroup label="Arctic">
					<option value="Arctic/Longyearbyen">Longyearbyen</option>

					</optgroup>
					<optgroup label="Asia">
					<option value="Asia/Aden"<?php if($timezone=="Asia/Abidjan") echo " selected='selected'"?>>Aden</option>
					<option value="Asia/Almaty"<?php if($timezone=="Asia/Almaty") echo " selected='selected'"?>>Almaty</option>
					<option value="Asia/Amman"<?php if($timezone=="Asia/Amman") echo " selected='selected'"?>>Amman</option>
					<option value="Asia/Anadyr"<?php if($timezone=="Asia/Anadyr") echo " selected='selected'"?>>Anadyr</option>
					<option value="Asia/Aqtau"<?php if($timezone=="Asia/Aqtau") echo " selected='selected'"?>>Aqtau</option>
					<option value="Asia/Aqtobe"<?php if($timezone=="Asia/Aqtobe") echo " selected='selected'"?>>Aqtobe</option>
					<option value="Asia/Ashgabat"<?php if($timezone=="Asia/Ashgabat") echo " selected='selected'"?>>Ashgabat</option>
					<option value="Asia/Ashkhabad"<?php if($timezone=="Asia/Ashkhabad") echo " selected='selected'"?>>Ashkhabad</option>

					<option value="Asia/Baghdad"<?php if($timezone=="Asia/Baghdad") echo " selected='selected'"?>>Baghdad</option>
					<option value="Asia/Bahrain"<?php if($timezone=="Asia/Bahrain") echo " selected='selected'"?>>Bahrain</option>
					<option value="Asia/Baku"<?php if($timezone=="Asia/Baku") echo " selected='selected'"?>>Baku</option>
					<option value="Asia/Bangkok"<?php if($timezone=="Asia/Bangkok") echo " selected='selected'"?>>Bangkok</option>
					<option value="Asia/Beirut"<?php if($timezone=="Asia/Beirut") echo " selected='selected'"?>>Beirut</option>
					<option value="Asia/Bishkek"<?php if($timezone=="Asia/Bishkek") echo " selected='selected'"?>>Bishkek</option>
					<option value="Asia/Brunei"<?php if($timezone=="Asia/Brunei") echo " selected='selected'"?>>Brunei</option>
					<option value="Asia/Calcutta"<?php if($timezone=="Asia/Calcutta") echo " selected='selected'"?>>Calcutta</option>
					<option value="Asia/Choibalsan"<?php if($timezone=="Asia/Choibalsan") echo " selected='selected'"?>>Choibalsan</option>

					<option value="Asia/Chongqing"<?php if($timezone=="Asia/Chongqing") echo " selected='selected'"?>>Chongqing</option>
					<option value="Asia/Chungking"<?php if($timezone=="Asia/Chungking") echo " selected='selected'"?>>Chungking</option>
					<option value="Asia/Colombo"<?php if($timezone=="Asia/Colombo") echo " selected='selected'"?>>Colombo</option>
					<option value="Asia/Dacca"<?php if($timezone=="Asia/Dacca") echo " selected='selected'"?>>Dacca</option>
					<option value="Asia/Damascus"<?php if($timezone=="Asia/Damascus") echo " selected='selected'"?>>Damascus</option>
					<option value="Asia/Dhaka"<?php if($timezone=="Asia/Dhaka") echo " selected='selected'"?>>Dhaka</option>
					<option value="Asia/Dili"<?php if($timezone=="Asia/Dili") echo " selected='selected'"?>>Dili</option>
					<option value="Asia/Dubai"<?php if($timezone=="Asia/Dubai") echo " selected='selected'"?>>Dubai</option>
					<option value="Asia/Dushanbe"<?php if($timezone=="Asia/Dushanbe") echo " selected='selected'"?>>Dushanbe</option>

					<option value="Asia/Gaza"<?php if($timezone=="Asia/Gaza") echo " selected='selected'"?>>Gaza</option>
					<option value="Asia/Harbin"<?php if($timezone=="Asia/Harbin") echo " selected='selected'"?>>Harbin</option>
					<option value="Asia/Ho_Chi_Minh"<?php if($timezone=="Asia/Ho_Chi_Minh") echo " selected='selected'"?>>Ho Chi Minh</option>
					<option value="Asia/Hong_Kong"<?php if($timezone=="Asia/Hong_Kong") echo " selected='selected'"?>>Hong Kong</option>
					<option value="Asia/Hovd"<?php if($timezone=="Asia/Hovd") echo " selected='selected'"?>>Hovd</option>
					<option value="Asia/Irkutsk"<?php if($timezone=="Asia/Irkutsk") echo " selected='selected'"?>>Irkutsk</option>
					<option value="Asia/Istanbul"<?php if($timezone=="Asia/Istanbul") echo " selected='selected'"?>>Istanbul</option>
					<option value="Asia/Jakarta"<?php if($timezone=="Asia/Jakarta") echo " selected='selected'"?>>Jakarta</option>
					<option value="Asia/Jayapura"<?php if($timezone=="Asia/Jayapura") echo " selected='selected'"?>>Jayapura</option>

					<option value="Asia/Jerusalem"<?php if($timezone=="Asia/Jerusalem") echo " selected='selected'"?>>Jerusalem</option>
					<option value="Asia/Kabul"<?php if($timezone=="Asia/Kabul") echo " selected='selected'"?>>Kabul</option>
					<option value="Asia/Kamchatka"<?php if($timezone=="Asia/Kamchatka") echo " selected='selected'"?>>Kamchatka</option>
					<option value="Asia/Karachi"<?php if($timezone=="Asia/Karachi") echo " selected='selected'"?>>Karachi</option>
					<option value="Asia/Kashgar"<?php if($timezone=="Asia/Kashgar") echo " selected='selected'"?>>Kashgar</option>
					<option value="Asia/Kathmandu"<?php if($timezone=="Asia/Kathmandu") echo " selected='selected'"?>>Kathmandu</option>
					<option value="Asia/Katmandu"<?php if($timezone=="Asia/Katmandu") echo " selected='selected'"?>>Katmandu</option>
					<option value="Asia/Kolkata"<?php if($timezone=="Asia/Kolkata") echo " selected='selected'"?>>Kolkata</option>
					<option value="Asia/Krasnoyarsk"<?php if($timezone=="Asia/Krasnoyarsk") echo " selected='selected'"?>>Krasnoyarsk</option>

					<option value="Asia/Kuala_Lumpur"<?php if($timezone=="Asia/Kuala_Lumpur") echo " selected='selected'"?>>Kuala Lumpur</option>
					<option value="Asia/Kuching"<?php if($timezone=="Asia/Kuching") echo " selected='selected'"?>>Kuching</option>
					<option value="Asia/Kuwait"<?php if($timezone=="Asia/Kuwait") echo " selected='selected'"?>>Kuwait</option>
					<option value="Asia/Macao"<?php if($timezone=="Asia/Macao") echo " selected='selected'"?>>Macao</option>
					<option value="Asia/Macau"<?php if($timezone=="Asia/Macau") echo " selected='selected'"?>>Macau</option>
					<option value="Asia/Magadan"<?php if($timezone=="Asia/Magadan") echo " selected='selected'"?>>Magadan</option>
					<option value="Asia/Makassar"<?php if($timezone=="Asia/Makassar") echo " selected='selected'"?>>Makassar</option>
					<option value="Asia/Manila"<?php if($timezone=="Asia/Manila") echo " selected='selected'"?>>Manila</option>
					<option value="Asia/Muscat"<?php if($timezone=="Asia/Muscat") echo " selected='selected'"?>>Muscat</option>

					<option value="Asia/Nicosia"<?php if($timezone=="Asia/Nicosia") echo " selected='selected'"?>>Nicosia</option>
					<option value="Asia/Novosibirsk"<?php if($timezone=="Asia/Novosibirsk") echo " selected='selected'"?>>Novosibirsk</option>
					<option value="Asia/Omsk"<?php if($timezone=="Asia/Omsk") echo " selected='selected'"?>>Omsk</option>
					<option value="Asia/Oral"<?php if($timezone=="Asia/Oral") echo " selected='selected'"?>>Oral</option>
					<option value="Asia/Phnom_Penh"<?php if($timezone=="Asia/Phnom_Penh") echo " selected='selected'"?>>Phnom Penh</option>
					<option value="Asia/Pontianak"<?php if($timezone=="Asia/Pontianak") echo " selected='selected'"?>>Pontianak</option>
					<option value="Asia/Pyongyang"<?php if($timezone=="Asia/Pyongyang") echo " selected='selected'"?>>Pyongyang</option>
					<option value="Asia/Qatar"<?php if($timezone=="Asia/Qatar") echo " selected='selected'"?>>Qatar</option>
					<option value="Asia/Qyzylorda"<?php if($timezone=="Asia/Qyzylorda") echo " selected='selected'"?>>Qyzylorda</option>

					<option value="Asia/Rangoon"<?php if($timezone=="Asia/Rangoon") echo " selected='selected'"?>>Rangoon</option>
					<option value="Asia/Riyadh"<?php if($timezone=="Asia/Riyadh") echo " selected='selected'"?>>Riyadh</option>
					<option value="Asia/Saigon"<?php if($timezone=="Asia/Saigon") echo " selected='selected'"?>>Saigon</option>
					<option value="Asia/Sakhalin"<?php if($timezone=="Asia/Sakhalin") echo " selected='selected'"?>>Sakhalin</option>
					<option value="Asia/Samarkand"<?php if($timezone=="Asia/Samarkand") echo " selected='selected'"?>>Samarkand</option>
					<option value="Asia/Seoul"<?php if($timezone=="Asia/Seoul") echo " selected='selected'"?>>Seoul</option>
					<option value="Asia/Shanghai"<?php if($timezone=="Asia/Shanghai") echo " selected='selected'"?>>Shanghai</option>
					<option value="Asia/Singapore"<?php if($timezone=="Asia/Singapore") echo " selected='selected'"?>>Singapore</option>
					<option value="Asia/Taipei"<?php if($timezone=="Asia/Taipei") echo " selected='selected'"?>>Taipei</option>

					<option value="Asia/Tashkent"<?php if($timezone=="Asia/Tashkent") echo " selected='selected'"?>>Tashkent</option>
					<option value="Asia/Tbilisi"<?php if($timezone=="Asia/Tbilisi") echo " selected='selected'"?>>Tbilisi</option>
					<option value="Asia/Tehran"<?php if($timezone=="Asia/Tehran") echo " selected='selected'"?>>Tehran</option>
					<option value="Asia/Tel_Aviv"<?php if($timezone=="Asia/Tel_Aviv") echo " selected='selected'"?>>Tel Aviv</option>
					<option value="Asia/Thimbu"<?php if($timezone=="Asia/Thimbu") echo " selected='selected'"?>>Thimbu</option>
					<option value="Asia/Thimphu"<?php if($timezone=="Asia/Thimphu") echo " selected='selected'"?>>Thimphu</option>
					<option value="Asia/Tokyo"<?php if($timezone=="Asia/Tokyo") echo " selected='selected'"?>>Tokyo</option>
					<option value="Asia/Ujung_Pandang"<?php if($timezone=="Asia/Ujung_Pandang") echo " selected='selected'"?>>Ujung Pandang</option>
					<option value="Asia/Ulaanbaatar"<?php if($timezone=="Asia/Ulaanbaatar") echo " selected='selected'"?>>Ulaanbaatar</option>

					<option value="Asia/Ulan_Bator"<?php if($timezone=="Asia/Ulan_Bator") echo " selected='selected'"?>>Ulan Bator</option>
					<option value="Asia/Urumqi"<?php if($timezone=="Asia/Urumqi") echo " selected='selected'"?>>Urumqi</option>
					<option value="Asia/Vientiane"<?php if($timezone=="Asia/Vientiane") echo " selected='selected'"?>>Vientiane</option>
					<option value="Asia/Vladivostok"<?php if($timezone=="Asia/Vladivostok") echo " selected='selected'"?>>Vladivostok</option>
					<option value="Asia/Yakutsk"<?php if($timezone=="Asia/Yakutsk") echo " selected='selected'"?>>Yakutsk</option>
					<option value="Asia/Yekaterinburg"<?php if($timezone=="Asia/Yekaterinburg") echo " selected='selected'"?>>Yekaterinburg</option>
					<option value="Asia/Yerevan"<?php if($timezone=="Asia/Yerevan") echo " selected='selected'"?>>Yerevan</option>
					</optgroup>
					<optgroup label="Atlantic">
					<option value="Atlantic/Azores"<?php if($timezone=="Atlantic/Azores") echo " selected='selected'"?>>Azores</option>

					<option value="Atlantic/Bermuda"<?php if($timezone=="Atlantic/Bermuda") echo " selected='selected'"?>>Bermuda</option>
					<option value="Atlantic/Canary"<?php if($timezone=="Atlantic/Canary") echo " selected='selected'"?>>Canary</option>
					<option value="Atlantic/Cape_Verde"<?php if($timezone=="Atlantic/Cape_Verde") echo " selected='selected'"?>>Cape Verde</option>
					<option value="Atlantic/Faeroe"<?php if($timezone=="Atlantic/Faeroe") echo " selected='selected'"?>>Faeroe</option>
					<option value="Atlantic/Faroe"<?php if($timezone=="Atlantic/Faroe") echo " selected='selected'"?>>Faroe</option>
					<option value="Atlantic/Jan_Mayen"<?php if($timezone=="Atlantic/Jan_Mayen") echo " selected='selected'"?>>Jan Mayen</option>
					<option value="Atlantic/Madeira"<?php if($timezone=="Atlantic/Madeira") echo " selected='selected'"?>>Madeira</option>
					<option value="Atlantic/Reykjavik"<?php if($timezone=="Atlantic/Reykjavik") echo " selected='selected'"?>>Reykjavik</option>
					<option value="Atlantic/South_Georgia"<?php if($timezone=="Atlantic/South_Georgia") echo " selected='selected'"?>>South Georgia</option>

					<option value="Atlantic/Stanley"<?php if($timezone=="Atlantic/Stanley") echo " selected='selected'"?>>Stanley</option>
					<option value="Atlantic/St_Helena"<?php if($timezone=="Atlantic/St_Helena") echo " selected='selected'"?>>St Helena</option>
					</optgroup>
					<optgroup label="Australia">
					<option value="Australia/ACT"<?php if($timezone=="Australia/Abidjan") echo " selected='selected'"?>>ACT</option>
					<option value="Australia/Adelaide"<?php if($timezone=="Australia/Adelaide") echo " selected='selected'"?>>Adelaide</option>
					<option value="Australia/Brisbane"<?php if($timezone=="Australia/Brisbane") echo " selected='selected'"?>>Brisbane</option>
					<option value="Australia/Broken_Hill"<?php if($timezone=="Australia/Broken_Hill") echo " selected='selected'"?>>Broken Hill</option>
					<option value="Australia/Canberra"<?php if($timezone=="Australia/Canberra") echo " selected='selected'"?>>Canberra</option>
					<option value="Australia/Currie"<?php if($timezone=="Australia/Currie") echo " selected='selected'"?>>Currie</option>

					<option value="Australia/Darwin"<?php if($timezone=="Australia/Darwin") echo " selected='selected'"?>>Darwin</option>
					<option value="Australia/Eucla"<?php if($timezone=="Australia/Eucla") echo " selected='selected'"?>>Eucla</option>
					<option value="Australia/Hobart"<?php if($timezone=="Australia/Hobart") echo " selected='selected'"?>>Hobart</option>
					<option value="Australia/LHI"<?php if($timezone=="Australia/LHI") echo " selected='selected'"?>>LHI</option>
					<option value="Australia/Lindeman"<?php if($timezone=="Australia/Lindeman") echo " selected='selected'"?>>Lindeman</option>
					<option value="Australia/Lord_Howe"<?php if($timezone=="Australia/Lord_Howe") echo " selected='selected'"?>>Lord Howe</option>
					<option value="Australia/Melbourne"<?php if($timezone=="Australia/Melbourne") echo " selected='selected'"?>>Melbourne</option>
					<option value="Australia/North"<?php if($timezone=="Australia/North") echo " selected='selected'"?>>North</option>
					<option value="Australia/NSW"<?php if($timezone=="Australia/NSW") echo " selected='selected'"?>>NSW</option>

					<option value="Australia/Perth"<?php if($timezone=="Australia/Perth") echo " selected='selected'"?>>Perth</option>
					<option value="Australia/Queensland"<?php if($timezone=="Australia/Queensland") echo " selected='selected'"?>>Queensland</option>
					<option value="Australia/South"<?php if($timezone=="Australia/South") echo " selected='selected'"?>>South</option>
					<option value="Australia/Sydney"<?php if($timezone=="Australia/Sydney") echo " selected='selected'"?>>Sydney</option>
					<option value="Australia/Tasmania"<?php if($timezone=="Australia/Tasmania") echo " selected='selected'"?>>Tasmania</option>
					<option value="Australia/Victoria"<?php if($timezone=="Australia/Victoria") echo " selected='selected'"?>>Victoria</option>
					<option value="Australia/West"<?php if($timezone=="Australia/West") echo " selected='selected'"?>>West</option>
					<option value="Australia/Yancowinna"<?php if($timezone=="Australia/Yancowinna") echo " selected='selected'"?>>Yancowinna</option>
					</optgroup>

					<optgroup label="Europe">
					<option value="Europe/Amsterdam"<?php if($timezone=="Europe/Abidjan") echo " selected='selected'"?>>Amsterdam</option>
					<option value="Europe/Andorra"<?php if($timezone=="Europe/Andorra") echo " selected='selected'"?>>Andorra</option>
					<option value="Europe/Athens"<?php if($timezone=="Europe/Athens") echo " selected='selected'"?>>Athens</option>
					<option value="Europe/Belfast"<?php if($timezone=="Europe/Belfast") echo " selected='selected'"?>>Belfast</option>
					<option value="Europe/Belgrade"<?php if($timezone=="Europe/Belgrade") echo " selected='selected'"?>>Belgrade</option>
					<option value="Europe/Berlin"<?php if($timezone=="Europe/Berlin") echo " selected='selected'"?>>Berlin</option>
					<option value="Europe/Bratislava"<?php if($timezone=="Europe/Bratislava") echo " selected='selected'"?>>Bratislava</option>
					<option value="Europe/Brussels"<?php if($timezone=="Europe/Brussels") echo " selected='selected'"?>>Brussels</option>

					<option value="Europe/Bucharest"<?php if($timezone=="Europe/Bucharest") echo " selected='selected'"?>>Bucharest</option>
					<option value="Europe/Budapest"<?php if($timezone=="Europe/Budapest") echo " selected='selected'"?>>Budapest</option>
					<option value="Europe/Chisinau"<?php if($timezone=="Europe/Chisinau") echo " selected='selected'"?>>Chisinau</option>
					<option value="Europe/Copenhagen"<?php if($timezone=="Europe/Copenhagen") echo " selected='selected'"?>>Copenhagen</option>
					<option value="Europe/Dublin"<?php if($timezone=="Europe/Dublin") echo " selected='selected'"?>>Dublin</option>
					<option value="Europe/Gibraltar"<?php if($timezone=="Europe/Gibraltar") echo " selected='selected'"?>>Gibraltar</option>
					<option value="Europe/Guernsey"<?php if($timezone=="Europe/Guernsey") echo " selected='selected'"?>>Guernsey</option>
					<option value="Europe/Helsinki"<?php if($timezone=="Europe/Helsinki") echo " selected='selected'"?>>Helsinki</option>
					<option value="Europe/Isle_of_Man"<?php if($timezone=="Europe/Isle_of_Man") echo " selected='selected'"?>>Isle of Man</option>

					<option value="Europe/Istanbul"<?php if($timezone=="Europe/Istanbul") echo " selected='selected'"?>>Istanbul</option>
					<option value="Europe/Jersey"<?php if($timezone=="Europe/Jersey") echo " selected='selected'"?>>Jersey</option>
					<option value="Europe/Kaliningrad"<?php if($timezone=="Europe/Kaliningrad") echo " selected='selected'"?>>Kaliningrad</option>
					<option value="Europe/Kiev"<?php if($timezone=="Europe/Kiev") echo " selected='selected'"?>>Kiev</option>
					<option value="Europe/Lisbon"<?php if($timezone=="Europe/Lisbon") echo " selected='selected'"?>>Lisbon</option>
					<option value="Europe/Ljubljana"<?php if($timezone=="Europe/Ljubljana") echo " selected='selected'"?>>Ljubljana</option>
					<option value="Europe/London"<?php if($timezone=="Europe/London") echo " selected='selected'"?>>London</option>
					<option value="Europe/Luxembourg"<?php if($timezone=="Europe/Luxembourg") echo " selected='selected'"?>>Luxembourg</option>
					<option value="Europe/Madrid"<?php if($timezone=="Europe/Madrid") echo " selected='selected'"?>>Madrid</option>

					<option value="Europe/Malta"<?php if($timezone=="Europe/Malta") echo " selected='selected'"?>>Malta</option>
					<option value="Europe/Mariehamn"<?php if($timezone=="Europe/Mariehamn") echo " selected='selected'"?>>Mariehamn</option>
					<option value="Europe/Minsk"<?php if($timezone=="Europe/Minsk") echo " selected='selected'"?>>Minsk</option>
					<option value="Europe/Monaco"<?php if($timezone=="Europe/Monaco") echo " selected='selected'"?>>Monaco</option>
					<option value="Europe/Moscow"<?php if($timezone=="Europe/Moscow") echo " selected='selected'"?>>Moscow</option>
					<option value="Europe/Nicosia"<?php if($timezone=="Europe/Nicosia") echo " selected='selected'"?>>Nicosia</option>
					<option value="Europe/Oslo"<?php if($timezone=="Europe/Oslo") echo " selected='selected'"?>>Oslo</option>
					<option value="Europe/Paris"<?php if($timezone=="Europe/Paris") echo " selected='selected'"?>>Paris</option>
					<option value="Europe/Podgorica"<?php if($timezone=="Europe/Podgorica") echo " selected='selected'"?>>Podgorica</option>

					<option value="Europe/Prague"<?php if($timezone=="Europe/Prague") echo " selected='selected'"?>>Prague</option>
					<option value="Europe/Riga"<?php if($timezone=="Europe/Riga") echo " selected='selected'"?>>Riga</option>
					<option value="Europe/Rome"<?php if($timezone=="Europe/Rome") echo " selected='selected'"?>>Rome</option>
					<option value="Europe/Samara"<?php if($timezone=="Europe/Samara") echo " selected='selected'"?>>Samara</option>
					<option value="Europe/San_Marino"<?php if($timezone=="Europe/San_Marino") echo " selected='selected'"?>>San Marino</option>
					<option value="Europe/Sarajevo"<?php if($timezone=="Europe/Sarajevo") echo " selected='selected'"?>>Sarajevo</option>
					<option value="Europe/Simferopol"<?php if($timezone=="Europe/Simferopol") echo " selected='selected'"?>>Simferopol</option>
					<option value="Europe/Skopje"<?php if($timezone=="Europe/Skopje") echo " selected='selected'"?>>Skopje</option>
					<option value="Europe/Sofia"<?php if($timezone=="Europe/Sofia") echo " selected='selected'"?>>Sofia</option>

					<option value="Europe/Stockholm"<?php if($timezone=="Europe/Stockholm") echo " selected='selected'"?>>Stockholm</option>
					<option value="Europe/Tallinn"<?php if($timezone=="Europe/Tallinn") echo " selected='selected'"?>>Tallinn</option>
					<option value="Europe/Tirane"<?php if($timezone=="Europe/Tirane") echo " selected='selected'"?>>Tirane</option>
					<option value="Europe/Tiraspol"<?php if($timezone=="Europe/Tiraspol") echo " selected='selected'"?>>Tiraspol</option>
					<option value="Europe/Uzhgorod"<?php if($timezone=="Europe/Uzhgorod") echo " selected='selected'"?>>Uzhgorod</option>
					<option value="Europe/Vaduz"<?php if($timezone=="Europe/Vaduz") echo " selected='selected'"?>>Vaduz</option>
					<option value="Europe/Vatican"<?php if($timezone=="Europe/Vatican") echo " selected='selected'"?>>Vatican</option>
					<option value="Europe/Vienna"<?php if($timezone=="Europe/Vienna") echo " selected='selected'"?>>Vienna</option>
					<option value="Europe/Vilnius"<?php if($timezone=="Europe/Vilnius") echo " selected='selected'"?>>Vilnius</option>

					<option value="Europe/Volgograd"<?php if($timezone=="Europe/Volgograd") echo " selected='selected'"?>>Volgograd</option>
					<option value="Europe/Warsaw"<?php if($timezone=="Europe/Warsaw") echo " selected='selected'"?>>Warsaw</option>
					<option value="Europe/Zagreb"<?php if($timezone=="Europe/Zagreb") echo " selected='selected'"?>>Zagreb</option>
					<option value="Europe/Zaporozhye"<?php if($timezone=="Europe/Zaporozhye") echo " selected='selected'"?>>Zaporozhye</option>
					<option value="Europe/Zurich"<?php if($timezone=="Europe/Zurich") echo " selected='selected'"?>>Zurich</option>
					</optgroup>
					<optgroup label="Indian">
					<option value="Indian/Antananarivo"<?php if($timezone=="Indian/Antananarivo") echo " selected='selected'"?>>Antananarivo</option>
					<option value="Indian/Chagos"<?php if($timezone=="Indian/Chagos") echo " selected='selected'"?>>Chagos</option>
					<option value="Indian/Christmas"<?php if($timezone=="Indian/Christmas") echo " selected='selected'"?>>Christmas</option>

					<option value="Indian/Cocos"<?php if($timezone=="Indian/Cocos") echo " selected='selected'"?>>Cocos</option>
					<option value="Indian/Comoro"<?php if($timezone=="Indian/Comoro") echo " selected='selected'"?>>Comoro</option>
					<option value="Indian/Kerguelen"<?php if($timezone=="Indian/Kerguelen") echo " selected='selected'"?>>Kerguelen</option>
					<option value="Indian/Mahe"<?php if($timezone=="Indian/Mahe") echo " selected='selected'"?>>Mahe</option>
					<option value="Indian/Maldives"<?php if($timezone=="Indian/Maldives") echo " selected='selected'"?>>Maldives</option>
					<option value="Indian/Mauritius"<?php if($timezone=="Indian/Mauritius") echo " selected='selected'"?>>Mauritius</option>
					<option value="Indian/Mayotte"<?php if($timezone=="Indian/Mayotte") echo " selected='selected'"?>>Mayotte</option>
					<option value="Indian/Reunion"<?php if($timezone=="Indian/Reunion") echo " selected='selected'"?>>Reunion</option>
					</optgroup>

					<optgroup label="Pacific">
					<option value="Pacific/Apia">Apia</option>
					<option value="Pacific/Auckland"<?php if($timezone=="Pacific/Auckland") echo " selected='selected'"?>>Auckland</option>
					<option value="Pacific/Chatham"<?php if($timezone=="Pacific/Chatham") echo " selected='selected'"?>>Chatham</option>
					<option value="Pacific/Easter"<?php if($timezone=="Pacific/Easter") echo " selected='selected'"?>>Easter</option>
					<option value="Pacific/Efate"<?php if($timezone=="Pacific/Efate") echo " selected='selected'"?>>Efate</option>
					<option value="Pacific/Enderbury"<?php if($timezone=="Pacific/Enderbury") echo " selected='selected'"?>>Enderbury</option>
					<option value="Pacific/Fakaofo"<?php if($timezone=="Pacific/Fakaofo") echo " selected='selected'"?>>Fakaofo</option>
					<option value="Pacific/Fiji"<?php if($timezone=="Pacific/Fiji") echo " selected='selected'"?>>Fiji</option>

					<option value="Pacific/Funafuti"<?php if($timezone=="Pacific/Funafuti") echo " selected='selected'"?>>Funafuti</option>
					<option value="Pacific/Galapagos"<?php if($timezone=="Pacific/Galapagos") echo " selected='selected'"?>>Galapagos</option>
					<option value="Pacific/Gambier"<?php if($timezone=="Pacific/Gambier") echo " selected='selected'"?>>Gambier</option>
					<option value="Pacific/Guadalcanal"<?php if($timezone=="Pacific/Guadalcanal") echo " selected='selected'"?>>Guadalcanal</option>
					<option value="Pacific/Guam"<?php if($timezone=="Pacific/Guam") echo " selected='selected'"?>>Guam</option>
					<option value="Pacific/Honolulu"<?php if($timezone=="Pacific/Honolulu") echo " selected='selected'"?>>Honolulu</option>
					<option value="Pacific/Johnston"<?php if($timezone=="Pacific/Johnston") echo " selected='selected'"?>>Johnston</option>
					<option value="Pacific/Kiritimati"<?php if($timezone=="Pacific/Kiritimati") echo " selected='selected'"?>>Kiritimati</option>
					<option value="Pacific/Kosrae"<?php if($timezone=="Pacific/Kosrae") echo " selected='selected'"?>>Kosrae</option>

					<option value="Pacific/Kwajalein"<?php if($timezone=="Pacific/Kwajalein") echo " selected='selected'"?>>Kwajalein</option>
					<option value="Pacific/Majuro"<?php if($timezone=="Pacific/Majuro") echo " selected='selected'"?>>Majuro</option>
					<option value="Pacific/Marquesas"<?php if($timezone=="Pacific/Marquesas") echo " selected='selected'"?>>Marquesas</option>
					<option value="Pacific/Midway"<?php if($timezone=="Pacific/Midway") echo " selected='selected'"?>>Midway</option>
					<option value="Pacific/Nauru"<?php if($timezone=="Pacific/Nauru") echo " selected='selected'"?>>Nauru</option>
					<option value="Pacific/Niue"<?php if($timezone=="Pacific/Niue") echo " selected='selected'"?>>Niue</option>
					<option value="Pacific/Norfolk"<?php if($timezone=="Pacific/Norfolk") echo " selected='selected'"?>>Norfolk</option>
					<option value="Pacific/Noumea"<?php if($timezone=="Pacific/Noumea") echo " selected='selected'"?>>Noumea</option>
					<option value="Pacific/Pago_Pago"<?php if($timezone=="Pacific/Pago_Pago") echo " selected='selected'"?>>Pago Pago</option>

					<option value="Pacific/Palau"<?php if($timezone=="Pacific/Palau") echo " selected='selected'"?>>Palau</option>
					<option value="Pacific/Pitcairn"<?php if($timezone=="Pacific/Pitcairn") echo " selected='selected'"?>>Pitcairn</option>
					<option value="Pacific/Ponape"<?php if($timezone=="Pacific/Ponape") echo " selected='selected'"?>>Ponape</option>
					<option value="Pacific/Port_Moresby"<?php if($timezone=="Pacific/Port_Moresby") echo " selected='selected'"?>>Port Moresby</option>
					<option value="Pacific/Rarotonga"<?php if($timezone=="Pacific/Rarotonga") echo " selected='selected'"?>>Rarotonga</option>
					<option value="Pacific/Saipan"<?php if($timezone=="Pacific/Saipan") echo " selected='selected'"?>>Saipan</option>
					<option value="Pacific/Samoa"<?php if($timezone=="Pacific/Samoa") echo " selected='selected'"?>>Samoa</option>
					<option value="Pacific/Tahiti"<?php if($timezone=="Pacific/Tahiti") echo " selected='selected'"?>>Tahiti</option>
					<option value="Pacific/Tarawa"<?php if($timezone=="Pacific/Tarawa") echo " selected='selected'"?>>Tarawa</option>

					<option value="Pacific/Tongatapu"<?php if($timezone=="Pacific/Tongatapu") echo " selected='selected'"?>>Tongatapu</option>
					<option value="Pacific/Truk"<?php if($timezone=="Pacific/Truk") echo " selected='selected'"?>>Truk</option>
					<option value="Pacific/Wake"<?php if($timezone=="Pacific/Wake") echo " selected='selected'"?>>Wake</option>
					<option value="Pacific/Wallis"<?php if($timezone=="Pacific/Wallis") echo " selected='selected'"?>>Wallis</option>
					<option value="Pacific/Yap"<?php if($timezone=="Pacific/Yap") echo " selected='selected'"?>>Yap</option>
					</optgroup>
					<optgroup label="标准时间（UTC）">
					<option value="UTC">标准时间（UTC）</option>
					</optgroup>
					<optgroup label="手动指定偏差">
					<option value="Etc/GMT-12">UTC-12</option>

					<option value="Etc/GMT-11:30"<?php if($timezone=="Etc/GMT-11:30") echo " selected='selected'"?>>UTC-11:30</option>
					<option value="Etc/GMT-11"<?php if($timezone=="Etc/GMT-11") echo " selected='selected'"?>>UTC-11</option>
					<option value="Etc/GMT-10:30"<?php if($timezone=="Etc/GMT-10:30") echo " selected='selected'"?>>UTC-10:30</option>
					<option value="Etc/GMT-10"<?php if($timezone=="Etc/GMT-10") echo " selected='selected'"?>>UTC-10</option>
					<option value="Etc/GMT-9:30"<?php if($timezone=="Etc/GMT-9:30") echo " selected='selected'"?>>UTC-9:30</option>
					<option value="Etc/GMT-9"<?php if($timezone=="Etc/GMT-9") echo " selected='selected'"?>>UTC-9</option>
					<option value="Etc/GMT-8:30"<?php if($timezone=="Etc/GMT-8:30") echo " selected='selected'"?>>UTC-8:30</option>
					<option value="Etc/GMT-8"<?php if($timezone=="Etc/GMT-8") echo " selected='selected'"?>>UTC-8</option>
					<option value="Etc/GMT-7:30"<?php if($timezone=="Etc/GMT-7:30") echo " selected='selected'"?>>UTC-7:30</option>

					<option value="Etc/GMT-7"<?php if($timezone=="Etc/GMT-7") echo " selected='selected'"?>UTC-7</option>
					<option value="Etc/GMT-6:30"<?php if($timezone=="Etc/GMT-6:30") echo " selected='selected'"?>>UTC-6:30</option>
					<option value="Etc/GMT-6"<?php if($timezone=="Etc/GMT-6") echo " selected='selected'"?>>UTC-6</option>
					<option value="Etc/GMT-5:30"<?php if($timezone=="Etc/GMT-5:30") echo " selected='selected'"?>>UTC-5:30</option>
					<option value="Etc/GMT-5"<?php if($timezone=="Etc/GMT-5") echo " selected='selected'"?>>UTC-5</option>
					<option value="Etc/GMT-4:30"<?php if($timezone=="Etc/GMT-4:30") echo " selected='selected'"?>>UTC-4:30</option>
					<option value="Etc/GMT-4"<?php if($timezone=="Etc/GMT-4") echo " selected='selected'"?>>UTC-4</option>
					<option value="Etc/GMT-3:30"<?php if($timezone=="Etc/GMT-3:30") echo " selected='selected'"?>>UTC-3:30</option>
					<option value="Etc/GMT-3"<?php if($timezone=="Etc/GMT-3") echo " selected='selected'"?>>UTC-3</option>

					<option value="Etc/GMT-2:30"<?php if($timezone=="Etc/GMT-2:30") echo " selected='selected'"?>>UTC-2:30</option>
					<option value="Etc/GMT-2"<?php if($timezone=="Etc/GMT-2") echo " selected='selected'"?>>UTC-2</option>
					<option value="Etc/GMT-1:30"<?php if($timezone=="Etc/GMT-1:30") echo " selected='selected'"?>>UTC-1:30</option>
					<option value="Etc/GMT-1"<?php if($timezone=="Etc/GMT-1") echo " selected='selected'"?>>UTC-1</option>
					<option value="Etc/GMT-0:30"<?php if($timezone=="Etc/GMT-0:30") echo " selected='selected'"?>>UTC-0:30</option>
					<option value="Etc/GMT+0"<?php if($timezone=="Etc/GMT+0") echo " selected='selected'"?>>UTC+0</option>
					<option value="Etc/GMT+0:30"<?php if($timezone=="Etc/GMT+0:30") echo " selected='selected'"?>>UTC+0:30</option>
					<option value="Etc/GMT+1"<?php if($timezone=="Etc/GMT+1") echo " selected='selected'"?>>UTC+1</option>
					<option value="Etc/GMT+1.:30"<?php if($timezone=="Etc/GMT+1.:30") echo " selected='selected'"?>>UTC+1:30</option>

					<option value="Etc/GMT+2"<?php if($timezone=="Etc/GMT+2") echo " selected='selected'"?>>UTC+2</option>
					<option value="Etc/GMT+2:30"<?php if($timezone=="Etc/GMT+2:30") echo " selected='selected'"?>>UTC+2:30</option>
					<option value="Etc/GMT+3"<?php if($timezone=="Etc/GMT+3") echo " selected='selected'"?>>UTC+3</option>
					<option value="Etc/GMT+3:30"<?php if($timezone=="Etc/GMT+3:30") echo " selected='selected'"?>>UTC+3:30</option>
					<option value="Etc/GMT+4"<?php if($timezone=="Etc/GMT+4") echo " selected='selected'"?>>UTC+4</option>
					<option value="Etc/GMT+4:30"<?php if($timezone=="Etc/GMT+4:30") echo " selected='selected'"?>>UTC+4:30</option>
					<option value="Etc/GMT+5"<?php if($timezone=="Etc/GMT+5") echo " selected='selected'"?>>UTC+5</option>
					<option value="Etc/GMT+5:30"<?php if($timezone=="Etc/GMT+5:30") echo " selected='selected'"?>>UTC+5:30</option>
					<option value="Etc/GMT+5:45"<?php if($timezone=="Etc/GMT+5:45") echo " selected='selected'"?>>UTC+5:45</option>

					<option value="Etc/GMT+6"<?php if($timezone=="Etc/GMT+6") echo " selected='selected'"?>>UTC+6</option>
					<option value="Etc/GMT+6:30"<?php if($timezone=="Etc/GMT+6:30") echo " selected='selected'"?>>UTC+6:30</option>
					<option value="Etc/GMT+7"<?php if($timezone=="Etc/GMT+7") echo " selected='selected'"?>>UTC+7</option>
					<option value="Etc/GMT+7:30"<?php if($timezone=="Etc/GMT+7:30") echo " selected='selected'"?>>UTC+7:30</option>
					<option value="Etc/GMT+8"<?php if($timezone=="Etc/GMT+8") echo " selected='selected'"?>>UTC+8</option>
					<option value="Etc/GMT+8:30"<?php if($timezone=="Etc/GMT+8:30") echo " selected='selected'"?>>UTC+8:30</option>
					<option value="Etc/GMT+8:45"<?php if($timezone=="Etc/GMT+8:45") echo " selected='selected'"?>>UTC+8:45</option>
					<option value="Etc/GMT+9"<?php if($timezone=="Etc/GMT+9") echo " selected='selected'"?>>UTC+9</option>
					<option value="Etc/GMT+9:30"<?php if($timezone=="Etc/GMT+9:30") echo " selected='selected'"?>>UTC+9:30</option>

					<option value="Etc/GMT+10"<?php if($timezone=="Etc/GMT+10") echo " selected='selected'"?>>UTC+10</option>
					<option value="Etc/GMT+10:30"<?php if($timezone=="Etc/GMT+10:30") echo " selected='selected'"?>>UTC+10:30</option>
					<option value="Etc/GMT+11"<?php if($timezone=="Etc/GMT+11") echo " selected='selected'"?>>UTC+11</option>
					<option value="Etc/GMT+11:30"<?php if($timezone=="Etc/GMT+11:30") echo " selected='selected'"?>>UTC+11:30</option>
					<option value="Etc/GMT+12"<?php if($timezone=="Etc/GMT+12") echo " selected='selected'"?>>UTC+12</option>
					<option value="Etc/GMT+12:45"<?php if($timezone=="Etc/GMT+12:45") echo " selected='selected'"?>>UTC+12:45</option>
					<option value="Etc/GMT+13"<?php if($timezone=="Etc/GMT+13") echo " selected='selected'"?>>UTC+13</option>
					<option value="Etc/GMT+13:45"<?php if($timezone=="Etc/GMT+13:45") echo " selected='selected'"?>>UTC+13:45</option>
					<option value="Etc/GMT+14"<?php if($timezone=="Etc/GMT+14") echo " selected='selected'"?>>UTC+14</option>
					</optgroup></select>				
				</p>
					<p>SMTP服务器：<input name="smtp" class="in1" type="text" value="<?php echo $mailSMTP?>"/></p>
					<p>Email地址：<input name="address" class="in1" type="text" value="<?php echo $mailAddress?>"/></p>
					<p>Email帐号：<input name="account" class="in1" type="text" value="<?php echo $mailAccount?>"/></p>
					<p>Email密码：<input name="password" class="in1" type="password" value="<?php echo $mailPassword?>"/></p>
					<p><span class='red'>内容过滤：(不允许出现的字词。词之间用逗号分开)</span></p>
					<p class="txt">
						<textarea name="filter" cols="60" rows="6"><?php echo $filter;?></textarea>
					</p>
					<div class="btn">
						<input type="image" src="images/submit1.gif" width="56" height="20" alt="提交"/>
					</div>
				</form>
			</div>
		</div>
	</div>
 </body>
</html>
