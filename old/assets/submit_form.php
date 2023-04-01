<form method="POST">
	<?php
	if (!isset($_COOKIE["note_shown"])) {
	?>
		<div id='info_box'>
			<p>Choose the game you made the contract in. Example: If you created a contract in HITMAN 3 set in Miami, choose HITMAN 3 not 2. <span style='color: red; cursor: pointer;' onclick='close_info()'>Close</span></p>
		</div>
	<?php
	}
	?>
	<script>
		function close_info() {
			document.getElementById("info_box").style.display = "none";
		}
	</script>
	<div class="item">
		<div class="city-item">
			<input type="text" placeholder="Title" name="name_title" id="id_title" required maxlength="50">
			<input type="text" placeholder="ID with dashes" name="name_id" id="id_id" required minlength="15" maxlength="15" pattern="[1-3]{1}-(01|02|03|04|05|06|07|08|09|10|11|12|13|16|20|21|22|24|26|27|28|29|30|31|33)-[0-9]{7}-[0-9]{2}" onkeyup="platfunc()">
			<input type="text" placeholder="Author" name="name_author" id="id_author" min="3" required>
			<select name="name_plat" id="id_plat" required>
				<option disabled hidden selected value="">Platform</option>
				<option value="PC">PC</option>
				<option value="PS">PS</option>
				<option value="Xbox">Xbox</option>
				<option value="Stadia">Stadia</option>
			</select>
		</div>
	</div>
	<div class="item">
		<div class="name-item">
			<select name="name_tcount" id="id_tcount" required onchange="check_limit()">
				<option disabled hidden selected value="">T-Count</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
			<select name="name_game" id="id_game" required>
				<option disabled hidden selected value="">Game</option>
				<option value="HITMAN 3">HITMAN 3</option>
				<option value="HITMAN 2">HITMAN 2</option>
				<option value="HITMAN 1">HITMAN</option>
			</select>
		</div>
	</div>
	<div class="item">
		<textarea name="name_more" id="id_more" placeholder="More info"></textarea>
	</div>

	<div class="question">
		<p>Complications<span class="required"></span></p>
		<div class="question-answer checkbox-item">
			<div>
				<ul style="list-style-type: none;">
					<li>
						<input type="checkbox" class="complication" id="complication_1" name="complication1" value="None">
						<label class="check" for="complication_1">
							None
						</label>
					</li>
					<li>
						<input type="checkbox" class="complication" id="complication_2" name="complication2" value="Do Not Get Spotted">
						<label class="check" for="complication_2">
							Do Not Get Spotted
						</label>
					</li>
					<li>
						<input type="checkbox" id="complication_3" name="complication3" class="complication" value="No Recordings">
						<label class="check" for="complication_3">
							No Recordings
						</label>
					</li>
					<li>
						<input type="checkbox" id="complication_4" name="complication4" class="complication" value="No Bodies Found">
						<label class="check" for="complication_4">
							No Bodies Found
						</label>
					</li>
					<li>
						<input type="checkbox" id="complication_5" name="complication5" class="complication" value="Hide All Bodies">
						<label class="check" for="complication_5">
							Hide All Bodies
						</label>
					</li>
					<li>
						<input type="checkbox" id="complication_6" name="complication6" class="complication" value="No Disguise Change">
						<label class="check" for="complication_6">
							No Disguise Change
						</label>
					</li>
					<li>
						<input type="checkbox" id="complication_7" name="complication7" class="complication" value="Headshots Only">
						<label class="check" for="complication_7">
							Headshots Only
						</label>
					</li>
					<li>
						<input type="checkbox" id="complication_8" name="complication8" class="complication" value="Perfect Shooter">
						<label class="check" for="complication_8">
							Perfect Shooter
						</label>
					</li>
					<li>
						<input type="checkbox" id="complication_9" name="complication9" class="complication" value="No Pacifications">
						<label class="check" for="complication_9">
							No Pacifications
						</label>
					</li>
					<li>
						<input type="checkbox" id="complication_10" name="complication10" class="complication" value="Targets Only">
						<label class="check" for="complication_10">
							Targets Only
						</label>
					</li>
					<li>
						<input type="checkbox" id="complication_11" name="complication11" class="complication" value="Only One Exit">
						<label class="check" for="complication_11">
							Only One Exit
						</label>
					</li>
					<li>
						<input type="checkbox" id="complication_12" name="complication12" value="Time Limit">
						<label class="check" for="complication_12">
							Time Limit
						</label>

					</li>
					<li>
						<input name="name_time" id="id_time" placeholder="limit 00:00" required pattern="[0-5]{1}[0-9]{1}:[0-5]{1}[0-9]{1}" hidden disabled>
					</li>
				</ul>
			</div>
		</div>
		<p>Disguises<span class="required"></span></p>
		<div class="question-answer checkbox-item">
			<div>
				<ul style="list-style-type: none;">
					<li>
						<input type="checkbox" id="disguise_1" name="disguise1" value="Any Disguise">
						<label class="check" for="disguise_1">
							Any Disguise
						</label>
					</li>
					<li>
						<input type="checkbox" id="disguise_2" name="disguise2" value="Suit">
						<label class="check" for="disguise_2">
							Suit
						</label>
					</li>
					<li>
						<input type="checkbox" id="disguise_3" name="disguise3" value="Specific">
						<label class="check" for="disguise_3">
							Specific Disguise(s)
						</label>
					</li>
					<li>
						<input name="name_disguise" id="id_disguise" placeholder="specify disguise(s)" required hidden disabled>
					</li>
				</ul>
			</div>
		</div>
		<p>Methods<span class="required"></span></p>
		<div class="question-answer checkbox-item">
			<div>
				<ul style="list-style-type: none;">
					<li>
						<input type="checkbox" id="method_1" name="method1" onchange="check_limit()" value="Any Method">
						<label class="check" for="method_1">
							Any Method
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_2" name="method2" onchange="check_limit()" value="Pistol">
						<label class="check" for="method_2">
							Pistol
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_3" name="method3" onchange="check_limit()" value="Pistol Elimination">
						<label class="check" for="method_3">
							Pistol Elimination
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_4" name="method4" onchange="check_limit()" value="SMG">
						<label class="check" for="method_4">
							SMG
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_5" name="method5" onchange="check_limit()" value="Assault Rifle">
						<label class="check" for="method_5">
							Assault Rifle
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_6" name="method6" onchange="check_limit()" value="Shotgun">
						<label class="check" for="method_6">
							Shotgun
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_7" name="method7" onchange="check_limit()" value="Sniper Rifle">
						<label class="check" for="method_7">
							Sniper Rifle
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_8" name="method8" onchange="check_limit()" value="Explosive Device">
						<label class="check" for="method_8">
							Explosive Device
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_9" name="method9" onchange="check_limit()" value="Fiber Wire">
						<label class="check" for="method_9">
							Fiber Wire
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_10" name="method10" onchange="check_limit()" value="Unarmed">
						<label class="check" for="method_10">
							Unarmed
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_11" name="method11" onchange="check_limit()" value="Poison">
						<label class="check" for="method_11">
							Poison
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_12" name="method12" onchange="check_limit()" value="Consumed Poison">
						<label class="check" for="method_12">
							Consumed Poison
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_13" name="method13" onchange="check_limit()" value="Injected Poison">
						<label class="check" for="method_13">
							Injected Poison
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_14" name="method14" onchange="check_limit()" value="Accident">
						<label class="check" for="method_14">
							Accident
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_15" name="method15" onchange="check_limit()" value="Explosion Accident">
						<label class="check" for="method_15">
							Explosion Accident
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_16" name="method16" onchange="check_limit()" value="Falling Object">
						<label class="check" for="method_16">
							Falling Object
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_17" name="method17" onchange="check_limit()" value="Fall">
						<label class="check" for="method_17">
							Fall
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_18" name="method18" onchange="check_limit()" value="Drowning">
						<label class="check" for="method_18">
							Drowning
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_19" name="method19" onchange="check_limit()" value="Electrocution">
						<label class="check" for="method_19">
							Electrocution
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_20" name="method20" onchange="check_limit()" value="Fire">
						<label class="check" for="method_20">
							Fire
						</label>
					</li>
					<li>
						<input type="checkbox" id="method_21" name="method21" onchange="check_limit()" value="Melee">
						<label class="check" for="method_21">
							Melee
						</label>
					</li>
					<li>
						<input name="name_method_1" id="id_method_1" placeholder="Melee Item" required hidden disabled>
					</li>
					<li>
						<input type="checkbox" id="method_22" name="method22" onchange="check_limit()" value="Thrown">
						<label class="check" for="method_22">
							Thrown
						</label>
					</li>
					<li>
						<input name="name_method_2" id="id_method_2" placeholder="Thrown Item" required hidden disabled>
					</li>
				</ul>
			</div>
		</div>
		<p>Type<span class="required"></span></p>
		<div class="question-answer checkbox-item">
			<div>
				<ul style="list-style-type: none;">
					<li>
						<input type="checkbox" id="type1" name="type1" value="Freeform">
						<label class="check" for="type1">
							Freeform
						</label>
					</li>
					<li>
						<input type="checkbox" id="type2" name="type2" value="Loud Gun">
						<label class="check" for="type2">
							Loud Gun
						</label>
					</li>
					<li>
						<input type="checkbox" id="type3" name="type3" value="Puzzle">
						<label class="check" for="type3">
							Puzzle
						</label>
					</li>
					<li>
						<input type="checkbox" id="type4" name="type4" value="Sniper">
						<label class="check" for="type4">
							Sniper
						</label>
					</li>
					<li>
						<input type="checkbox" id="type5" name="type5" value="Speedrun">
						<label class="check" for="type5">
							Speedrun
						</label>
					</li>
					<li>
						<input type="checkbox" id="type6" name="type6" value="Challenge">
						<label class="check" for="type6">
							Challenge
						</label>
					</li>
					<li>
						<input type="checkbox" id="type7" name="type7" value="Modded">
						<label class="check" for="type7">
							Modded
						</label>
					</li>
					<li>
						<input type="checkbox" id="type8" name="type8" value="Routing">
						<label class="check" for="type8">
							Routing
						</label>
					</li>
					<li>
						<input type="checkbox" id="type9" name="type9" value="Suit Only">
						<label class="check" for="type9">
							Suit Only
						</label>
					</li>
					<li>
						<input type="checkbox" id="type10" name="type10" value="SONKO">
						<label class="check" for="type10">
							SONKO
						</label>
					</li>
					<li>
						<input type="checkbox" id="type11" name="type11" value="Infiltration">
						<label class="check" for="type11">
							Infiltration
						</label>
					</li>
					<li>
						<input type="checkbox" id="type12" name="type12" value="Endurance">
						<label class="check" for="type12">
							Endurance
						</label>
					</li>
					<li>
						<input type="checkbox" id="type13" name="type13" value="Fiber Wire">
						<label class="check" for="type13">
							Fiber Wire
						</label>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="btn-block">
		<button type="submit" name="submit">Send</button>
	</div>
</form>