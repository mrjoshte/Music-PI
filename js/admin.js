$(document).ready(function()
{
	$("#username").ready(function()
	{
		setUsername();
	});
	$("#playlist").ready(function()
	{
		setPlaylist();
	});
	$("#aliases").ready(function()
	{
		setAliases();
	});
	$("#schedule").ready(function()
	{
		setDropdowns();
	});
	$("#chSpotUP").click(function()
	{
		updateSpotify();
	});
	$("#chSpotPlay").click(function()
	{
		updatePlaylist();
	});
});

function setUsername()
{
	$.get("/php/spot.php", function(data)
	{
		$("#username").attr("placeholder", data);
	});
}

function setPlaylist()
{
	$.get("/php/playlist.php", function(data)
	{
		$("#playlist").attr("placeholder", data);
	});
}

function setAliases()
{
	$.get("/php/alias.php", function(data)
	{
		table = "<table class='table' id='aliases'>";
			
		keys = Object.keys(data);
		for (var i = 0; i < keys.length; i++)
		{
			table += "<tr id='" + i + "'><td>" + keys[i] + "</td><td>" + data[keys[i]] + "</td><td><button type='button' class='btn btn-danger' onclick='removeAlias(\"" +  keys[i] + "\"," + i + ")'>Remove</button></td></tr>";
		}

		table += "<tr id='newAlias'><td><input type='text' id='actual'></td><td><input type='text' id='alias'></td><td><button type='button' class='btn btn-success' onclick='addAlias()'>Add</button></td></tr>";

		table += "</table>";
		$("#aliases").html(table);
	}, "json");
}

function setDropdowns()
{
	$.get("php/schedule.php", function(data)
	{
		current = data;

		table = "<table class='table'>"; 		

		days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
		for (i = 0; i < 5; i++)
		{
			table += "<tr><td>" + days[i] + "</td>";
			cStart = current[i]["start"];
			cEnd = current[i]["end"];
			select = "<td>Start: <select id='" + days[i] + "Start'>";
			for (j = 0; j < 24; j++)
			{
				if (cStart == j)
				{
					select += "<option selected='selected' value='" + j + "'>" + j + ":00</option>";
				}
				else
				{
					select += "<option value='" + j + "'>" + j + ":00</option>";
				}
			}
			table += select + "</select></td>";
//			table += select + "</select><select>";
//			table += (current[i]["start"].split(" ")[1] === "am") ? "<option selected='selected' value='AM'>AM</option><option" : "<option value='AM'>AM</option><option selected='selected'";
//			table += " value='PM'>PM</option></select></td>";

			select = "<td>End: <select id='" + days[i] + "End'>";
			for (j = 0; j < 24; j++)
			{
				if (cEnd == j)
				{
					select += "<option selected='selected' value='" + j + "'>" + j + ":00</option>";
				}
				else
				{
					select += "<option value='" + j + "'>" + j + ":00</option>";
				}
			}
			table += select + "</select></td></tr>";
//			table += select + "</select><select>";
//			table += (current[i]["end"].split(" ")[1] === "am") ? "<option selected='selected' value='AM'>AM</option><option" : "<option value='AM'>AM</option><option selected='selected'";
//			table += " value='PM'>PM</option></select></td></tr>";

		}
		table += "</table>";
		$("#schedule").append(table);
	}, "json");
	$("#updateSch").click(function()
	{
		updateSchedule();
	});
}

function updateSpotify()
{
	var user = $("#username").val();
	var pass = $("#password").val();
	$.post("php/updateCred.php", {user: user, pass: pass});
	$("#username").val("");
	$("#password").val("");
	$("#username").attr("placeholder", user);
}

function updatePlaylist()
{
	var playlist = $("#playlist").val();
	$.post("php/updatePlay.php", {playlist: playlist});
	$("#playlist").val("");
	$("#playlist").attr("placeholder", playlist);
}

function removeAlias(key, i)
{
	$.post("php/removeAlias.php", {key: key});
	$("#" + i + "").remove();
}

function addAlias()
{
	var actual = $("#actual").val();
	var alias = $("#alias").val();
	$.post("php/addAlias.php", {actual: actual, alias: alias}, function(data)
	{
		newId = data - 1;
		newRow = "<tr id='" + newId + "'><td>" + actual + "</td><td>" + alias + "</td><td><button type='button' class='btn btn-danger' onclick='removeAlias(\"" + actual + "\"," + newId + ")'>Remove</button></td></tr>";
		$("#newAlias").insertBefore(newRow);
		location.reload();
	});
}

function updateSchedule()
{
	console.log("hello");
	var 
	days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
	for (i = 0; i < 5; i++)
	{
		
	}
}
