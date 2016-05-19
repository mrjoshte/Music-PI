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
	$("#daily").ready(function()
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
		table = "<table class='table'>";
			
		keys = Object.keys(data);
		for (var i = 0; i < keys.length; i++)
		{
			table += "<tr><td>" + keys[i] + "</td><td>" + data[keys[i]] + "</td><td><button type='button' class='btn btn-danger' id='" + keys[i] + "'>Remove</button></td></tr>";
		}

		table += "<tr><td><input type='text' id='actual'></td><td><input type='text' id='alias'></td><td><button type='button' class='btn btn-success' id='addAlias'>Add</button></td></tr>";

		table += "</table>";
		$("#aliases").html(table);
	}, "json");
}

function setDropdowns()
{
	$.get("php/schedule.php", function(data)
	{
		var current = data;
	
		days = ["monday", "tuesday", "wednesday", "thursday", "friday"];
		for (i = 0; i < 5; i++)
		{
			cStart = current[i]["start"].split(" ")[0];
			cEnd = current[i]["end"].split(" ")[0];
			select = "Start:<select id='" + days[i] + "Start'>";
			for (j = 1; j < 13; j++)
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
			$("#" + days[i]).append(select + "</select>");

			select = "End:<select id='" + days[i] + "End'>";
			for (j = 1; j < 13; j++)
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
			$("#" + days[i]).append(select + "</select>\n");
			$("#" + days[i]).append("<select><option value='AM'>AM</option><option value='PM'>PM</option></select>");
		}
	}, "json");
}

function updateSpotify()
{
	var user = $("#username").val();
	var pass = $("#password").val();
	$.post("php/updateCred.php", {user: user, pass: pass}, function(data)
	{
		$("#usrResult").text(data);
	});
	$("#username").val("");
	$("#password").val("");
	setUsername();
}

function updatePlaylist()
{
	var playlist = $("#playlist").val();
	$.post("php/updatePlay.php", {playlist: playlist}, function(data)
	{
		console.log(data);
	});
	$("#playlist").val("");
	setPlaylist();
}
