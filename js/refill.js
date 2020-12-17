function allRefill()
{
	var url = "../php/refillREST.php";
	var method = "action=GET";
	url += "?"+method;

	var request = new XMLHttpRequest();
	request.open("GET", url);
	request.onload = function()
	{
		if(request.status == 200)
		{
			var refilllist = request.responseText;


                //getTable header for data
				var url2 = "../includes/refilltable.json";
	            var request2 = new XMLHttpRequest();
	            request2.open("GET", url2);
	            request2.onload = function()
	            {
		           if(request2.status == 200)
		           {
			           var refilltable = request2.responseText;
			           listRefill(refilllist,refilltable);
		            }
	            };
	            request2.send(null);


		}
	};
	request.send(null);
}


function findRefill()
{

	var url = "../php/refillREST.php";
	var method = "action=GET";
	var descVal = document.getElementById("refillID").value;
	var descName = document.getElementById("refillID").name;
	url += "?"+method+"&"+descName+"="+descVal;

	var request = new XMLHttpRequest();
	request.open("GET", url);
	request.onload = function()
	{
		if(request.status == 200)
		{
			var productlist = request.responseText;

                //getTable header for data
				var url2 = "../includes/producttable.json";
	            var request2 = new XMLHttpRequest();
	            request2.open("GET", url2);
	            request2.onload = function()
	            {
		           if(request2.status == 200)
		           {
			           var refillttable = request2.responseText;
			           listProduct(productlist,producttable);
		            }
	            };
	            request2.send(null);


		}
	};
	request.send(null);
}

function listRefill(refilllist, getrefilltable)
{
	alert(refilllist+getrefilltable);
	var list = document.getElementById("list");
	var refill = JSON.parse(refilllist);
	var refilltable = JSON.parse(getrefilltable);


	var table = document.createElement("table");
	table.setAttribute("class", "test");

    //table head
    var tablehead = document.createElement("thead");
    var tableRow = document.createElement("tr");

    //wenn die tabllenid nicht angzeigt werden soll, muss h auf 1 gestetzt werden
    var tableattr = 1;
    for(var h = 0; h<tableattr; h++)
    {
    	var json = refilltable[0]; //in this case only one object exitsts
    	var key = "td"+h;
    	var tableval = json[key];
    	if(tableval != undefined)
    	{
    		var tableCell = document.createElement("td");
    	    var cellContent = document.createTextNode(tableval);
    	    tableCell.appendChild(cellContent);
    	    tableRow.appendChild(tableCell);

    	    tableattr++;
    	}
    }
    tablehead.appendChild(tableRow); alert("länge des tableheaders"+ tableattr);



    //table body
	var tablebody = document.createElement("tbody");


	for(var j = 0; j < refill.length; j++)
	{
	    var mycurrentRow = document.createElement("tr");

	    for(var i = 0; i<tableattr; i++)
	    {
	    	var json = refilltable[0];
	    	var jsonval = refill[j];
	    	var key = "td" + i;
	    	var value = json[key];
	        var tableval = jsonval[value];
	        if(tableval != undefined)
	        {
	            var mycurrentCell = document.createElement("td");
		        var mycurrentText = document.createTextNode(tableval);
		        mycurrentCell.appendChild(mycurrentText);
		        mycurrentRow.appendChild(mycurrentCell);
	        }
	    }
        tablebody.appendChild(mycurrentRow);
    }



	table.appendChild(tablehead);
	table.appendChild(tablebody);
	list.appendChild(table);
}


function getRefillTable()
{

	var url = "../includes/refilltable.json";
	var request = new XMLHttpRequest();
	alert(url);
	request.open("GET", url);
	request.onload = function()
	{
		if(request.status == 200)
		{
			var erg = request.responseText;
			return erg;
		}
	};
	request.send(null);
}
