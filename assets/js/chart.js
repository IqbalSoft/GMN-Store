let january = $("#january").val();
let february = $("#february").val();
let march = $("#march").val();
let april = $("#april").val();
let may = $("#may").val();
let june = $("#june").val();
let july = $("#july").val();
let august = $("#august").val();
let september = $("#september").val();
let october = $("#october").val();
let november = $("#november").val();
let december = $("#december").val();

var ctx = document.getElementById("myChart");
var chart = new Chart(ctx, {
	// The type of chart we want to create
	type: "line",
	// The data for our dataset
	data: {
		labels: [
			"January",
			"February",
			"March",
			"April",
			"May",
			"June",
			"July",
			"August",
			"September",
			"October",
			"November",
			"December"
		],
		datasets: [
			{
				label: "Monthly sales chart",
				backgroundColor: "rgb(0, 105, 217)",
				borderColor: "rgb(23, 201, 4)",
				data: [
					january,
					february,
					march,
					april,
					may,
					june,
					july,
					august,
					september,
					october,
					november,
					december
				]
			}
		]
	},

	// Configuration options go here
	options: {}
});
