/*
 * NERDS HOSTING
 * Author: RootSec
 */
var debug = 0;	// debug
var maxSimultaneous = 10;	// broj maksimalno dozvoljenih skeniranja u jednom trenutku
var currentSimultaneous = 0;
var removed=0,retry=[],ajaxHandler=[];	// globals

$(document).ready(function(){
	if (!debug) $(".debug").hide();		// sakrije debug kolonu ako je !debug
});

/*
 * Ovo je sa namerom izbaceno van .ready-ja, da bi sacekali da se ucitaju
 * sve slike (loading animacije) pre nego sto krene da se refreshuje status
 */
$(window).load(function() {
	$(".red").each(function(i) {
		refresh($(this).attr("rel"),$(this).attr("id"),$(this).attr("src"),0);
	});
});

/*
 * Funkcija kupi informacije prikazuje status servera ili restart dugme ako je offline
 */

function refresh(id,count) {
	if (currentSimultaneous>=maxSimultaneous) {
		count++;
		$("#"+id+" td:nth-child(5)").html(count);
		setTimeout("refresh('"+id+"','"+count+"')",100);
		return true;
	} else {
		currentSimultaneous++;
	}
	
	if (count=="-1") $("#"+id+" td:nth-child(5)").html("RETRY!");
	
	retry[id] = setTimeout("refresh('"+id+"','-1');ajaxHandler["+id+"].abort;return true;",10000);	// u slucaju da ne skenira za 10 sekundi, onda pokusa ponovo
	ajaxHandler[id] = $.ajax({
		type: "POST",
		url: "process.php",
		data: {
			'task': 'status',
			'id': id
		},
		dataType: "json",
		success: function(data){
			clearTimeout(retry[id]);		// u slucaju da je uspesno zavrseno, brise setTimeout koji bi trebao da uradi retry
			currentSimultaneous--;
			
			if (data[0].status=="Online") {
				$("#"+id).fadeOut();
				removed++;
				$("#removedServersNotif").show().find("span").text(removed);
			} else {
				restart = "<span class=\"restartBtn\" onclick=\"restartujServer('"+id+"')\">Restartuj</span>";
				$("#"+id+" td:nth-child(3)").html(data.players).next().html((data.status=="1")?'Online':restart);
			}
		}
	});
}
/*
 * Funkcija podesi loading sliku i asinhrono poziva skriptu koja ce restartovati server ako je offline
 */
function restartujServer(id) {
	$("#"+id+" td:nth-child(4)").html("<img src=\"assets/images/status-loader.gif\" /> restarting");
	$.ajax({
		type: "POST",
		url: "process.php",
		data: {
			'task': 'restartServer',
			'serverid': id
		},
		dataType: "json",
		success: function(data){
			refresh(id,0);
		}
	});
}
