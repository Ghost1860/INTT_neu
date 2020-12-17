function allProducts()
{
	var url = "../php/productREST.php";
	var method = "action=GET";
	url += "?"+method;

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
			           var producttable = request2.responseText;
			           listProduct(productlist,producttable);
		            }
	            };
	            request2.send(null);


		}
	};
	request.send(null);
}


function findProduct()
{

	var url = "../php/productREST.php";
	var method = "action=GET";
	var descVal = document.getElementById("productID").value;
	var descName = document.getElementById("productID").name;
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
			           var producttable = request2.responseText;
			           listProduct(productlist,producttable);
		            }
	            };
	            request2.send(null);


		}
	};
	request.send(null);
}

/*
function getCoords()
{

	var url = "stationREST.php";
	var method = "action=GET";
	var descVal = document.getElementById("stationID").value;
	var descName = document.getElementById("stationID").name;
	url += "?"+method+"&"+descName+"="+descVal;

	var request = new XMLHttpRequest();
	request.open("GET", url);
	request.onload = function()
	{
		if(request.status == 200)
		{
			var stationlist = request.responseText;


                //getTable header for data
				var url2 = "includes/stationtable.json";
	            var request2 = new XMLHttpRequest();
	            request2.open("GET", url2);
	            request2.onload = function()
	            {
		           if(request2.status == 200)
		           {
			           var stationtable = request2.responseText;
			           listStation(stationlist,stationtable);
		            }
	            };
	            request2.send(null);

		}
	};
	request.send(null);
}
*/


function listProduct(productlist, getproducttable)
{
	alert(productlist+getproducttable);
	var list = document.getElementById("list");
	var products = JSON.parse(productlist);
	var producttable = JSON.parse(getproducttable);


	var table = document.createElement("table");
	table.setAttribute("class", "test");

    //table head
    var tablehead = document.createElement("thead");
    var tableRow = document.createElement("tr");

    //wenn die tabllenid nicht angzeigt werden soll, muss h auf 1 gestetzt werden
    var tableattr = 1;
    for(var h = 0; h<tableattr; h++)
    {
    	var json = producttable[0]; //in this case only one object exitsts
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


	for(var j = 0; j < products.length; j++)
	{
	    var mycurrentRow = document.createElement("tr");

	    for(var i = 0; i<tableattr; i++)
	    {
	    	var json = producttable[0];
	    	var jsonval = products[j];
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

function getProductTable()
{

	var url = "../includes/producttable.json";
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
