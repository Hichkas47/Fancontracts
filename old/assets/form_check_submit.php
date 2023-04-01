<?php
if (isset($_POST["submit"])) {
	$validity = 1;
	$regex = "~[1-3]{1}-(01|02|03|04|05|06|07|08|09|10|11|12|13|16|20|21|22|24|26|27|28|29|30|31|33)-[0-9]{7}-[0-9]{2}~";
	$regex_2 = "~[1-3]{1}-(01|02|03|04|05|06|07|08|09|10|11|12|13|16|20|21|22|24|26)-[0-9]{7}-[0-9]{2}~";
	$regex_1 = "~[1-3]{1}-(01|02|03|04|05|06|07|08|09|10|16)-[0-9]{7}-[0-9]{2}~";
	$arr_loc = ["01" => "ICA Facility, Base", "02" => "Paris", "03" => "Sapienza(main)", "04" => "Sapienza(Icon)", "05" => "Sapienza(Landslide)", "06" => "Marrakesh(main)", "07" => "Marrakesh(HBoS)", "08" => "Bangkok(main)", "16" => "Bangkok(Source)", "09" => "Colorado", "10" => "Hokkaido", "20" => "Hawkes Bay", "11" => "Miami", "12" => "Santa Fortuna", "13" => "Mumbai", "22" => "Whittleton Creek", "21" => "Isle of Sgail", "24" => "New York", "26" => "Haven Island", "27" => "Dubai", "28" => "Dartmoor", "29" => "Berlin", "30" => "Chongqing", "31" => "Mendoza", "33" => "Garden Show"];
	$arr_plat = ['PC', 'PS', 'Xbox', 'Stadia'];
	$arr_plat_old = ['PC', 'PS', 'Xbox'];
	$arr_tcount = ['1', '2', '3', '4', '5'];
	$plat_id_check = ['Stadia' => '1', 'PC' => '1', 'PS' => '2', 'Xbox' => '3'];
	if (!empty($_POST["name_id"]) && isset($_POST["name_id"]) && preg_match($regex, $_POST["name_id"])) {
		$id = $_POST["name_id"]; /**/
		if (!empty($_POST["name_author"]) && isset($_POST["name_author"])) {
			$author = $_POST["name_author"];
			if (isset($_POST["name_tcount"]) && !empty($_POST["name_tcount"]) && in_array($_POST["name_tcount"], $arr_tcount)) {
				$tcount = $_POST["name_tcount"];
				if (isset($_POST["name_plat"]) && !empty($_POST["name_plat"]) && in_array($_POST["name_plat"], $arr_plat)) {
					$platform = $_POST["name_plat"];
					$id_check = substr($id, 2, 2);
					$mission = $arr_loc[$id_check];
					$id_check = substr($id, 0, 1);
					if ($id_check == $plat_id_check[$platform]) {
						$arr_method = ['Any Method', 'Pistol', 'Pistol Elimination', 'SMG', 'Assault Rifle', 'Shotgun', 'Sniper Rifle', 'Explosive Device', 'Fiber Wire', 'Unarmed', 'Poison', 'Consumed Poison', 'Injected Poison', 'Accident', 'Explosion Accident', 'Falling Object', 'Fall', 'Drowning', 'Electrocution', 'Fire', 'Melee', 'Thrown'];
						$arr_comp = ['None', 'Do Not Get Spotted', 'No Recordings', 'No Bodies Found', 'Hide All Bodies', 'No Disguise Change', 'Headshots Only', 'Perfect Shooter', 'No Pacifications', 'Targets Only', 'Only One Exit', 'Time Limit'];
						$complication = $method = $disguise = $type = "";
						for ($i = 1; $i < 13; $i++) {
							$temp = "complication" . $i;
							if (!empty($_POST[$temp]) && isset($_POST[$temp]) && in_array($_POST[$temp], $arr_comp)) {
								if ($temp != "complication12") {
									$complication .= $_POST[$temp] . "-";
								} else {
									if (!empty($_POST['name_time']) && preg_match('~[0-5]{1}[0-9]{1}:[0-5]{1}[0-9]{1}~', $_POST['name_time'])) {
										$complication .= $_POST[$temp] . "(" . $_POST['name_time'] . ")";
									} else {
										$validity = 0;
										header("location: result/?subject=Message&web=complication");
									}
								}
							}
						}
						for ($i = 1; $i < 14; $i++) {
							$temp = "type" . $i;
							if (!empty($_POST[$temp]) && isset($_POST[$temp])) {
								$type .= $_POST[$temp] . "-";
							}
						}
						$count_disg = 0;
						for ($i = 1; $i < 4; $i++) {
							$temp = "disguise" . $i;
							if (!empty($_POST[$temp]) && isset($_POST[$temp])) {
								$count_disg += 1;
								if ($temp != "disguise3") {
									$disguise .= $_POST[$temp] . "-";
								} else {
									if (!empty($_POST['name_disguise'])) {
										$disguise .= $_POST[$temp] . "(" . $_POST['name_disguise'] . ")";
									} else {
										$validity = 0;
										header("location: result/?subject=Message&web=disguise");
									}
								}
							}
						}
						$arr_game = ["HITMAN 3", "HITMAN 2", "HITMAN 1"];
						if (!empty($_POST["name_game"]) && in_array($_POST["name_game"], $arr_game)) {
							$game = $_POST["name_game"];
						} else {
							$validity = 0;
							header("location: result/?subject=Message&web=game");
						}
						if ($game != "HITMAN 3") {
							if (!in_array($platform, $arr_plat_old)) {
								$validity = 0;
								header("location: result/?subject=Message&web=game");
							} else {
								if ($game == "HITMAN 2" && !preg_match($regex_2, $id)) {
									$validity = 0;
									header("location: result/?subject=Message&web=game");
								} else {
									if ($game == "HITMAN 1" && !preg_match($regex_1, $id)) {
										$validity = 0;
										header("location: result/?subject=Message&web=game");
									}
								}
							}
						}
						$count_meth = 0;
						for ($i = 1; $i < 23; $i++) {
							$temp = "method" . $i;
							if (!empty($_POST[$temp]) && isset($_POST[$temp])) {
								$count_meth += 1;
								if ($i < 21) {
									$method .= $_POST[$temp] . "-";
								} else if ($i == 21) {
									if (!empty($_POST['name_method_1'])) {
										$method .= $_POST[$temp] . "(" . $_POST['name_method_1'] . ")";
									} else {
										$validity = 0;
										header("location: result/?subject=Message&web=method");
									}
								} else if ($i == 22) {
									if (!empty($_POST['name_method_2'])) {
										$method .= $_POST[$temp] . "(" . $_POST['name_method_2'] . ")";
									} else {
										$validity = 0;
										header("location: result/?subject=Message&web=method");
									}
								}
							}
						}
						if ($count_meth > $tcount || $count_disg > $tcount) {
							$validity = 0;
							header("location: result/?subject=Message&web=methcount");
						}
						if ($validity == 1) {
							$more = $_POST["name_more"];
							$title = $_POST["name_title"];
							$sql = $conn->prepare("SELECT `contract_id` FROM `contracts` WHERE `contract_id` = ?");
							$sql->bind_param('s', $id); 
							$sql->execute();
    						$result = $sql->get_result();
							$count_dup = mysqli_num_rows($result);
							if ($count_dup < 1) {
								$query = $conn->prepare("INSERT INTO `contracts` (`id`, `title`, `contract_id`, `platform`, `mission`, `target_count`, `type`, `complications`, `disguises`, `methods`, `author`, `more_info`, `game`) 
								VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?)");
								$query->bind_param('ssssisssssss', $title, $id, $platform, $mission, $tcount, $type, $complication, $disguise, $method, $author, $more, $game); 
								$query->execute();
								header("location: result/?subject=Message&web=successful");
							} else {
								header("location: result/?subject=Message&web=exists");
							}
						}
					} else {
						$validity = 0;
						header("location: result/?subject=Message&web=idplat");
					}
				} else {
					$validity = 0;
					header("location: result/?subject=Message&web=platform");
				}
			} else {
				$validity = 0;
				header("location: result/?subject=Message&web=tcount");
			}
		} else {
			$validity = 0;
			header("location: result/?subject=Message&web=author");
		}
	} else {
		$validity = 0;
		header("location: result/?subject=Message:&web=id");
	}
}
