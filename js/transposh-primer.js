window.addEventListener("load", function () {
	// Start Priming
	function tp_priming() {

		var tp_list_length = tp_list.length;

		var counter = 0;

		var interval_time = 3000; // 1000 ms = 1 second

		document.getElementById("tp-primer-button").setAttribute("disabled", "disabled");
		document.getElementById("tp-primer-status").className = "tp-primer-start";
		document.getElementById("tp-primer-status").innerHTML = "Start priming.";

		// Start interval
		var interval = setInterval(function () {

			var rest = tp_list.length - counter;

			var remaining_time = rest * interval_time / 1000;

			// Change status.
			var countershow = counter + 1;
			document.getElementById("tp-primer-status").className = "tp-primer-prime";
			document.getElementById("tp-primer-status").innerHTML = "Prime page " + countershow + " of " + tp_list_length + ". Remaining time: " + remaining_time + "sec.";

			// Change src url
			var tp_url = tp_list[counter];
			document.getElementById("tp-primer-iframe").src = tp_url;

			counter++;

			// Stop interval if list end
			if (counter === tp_list_length) {
				clearInterval(interval);
				document.getElementById("tp-primer-button").removeAttribute("disabled");
				document.getElementById("tp-primer-status").className = "tp-primer-done";
				document.getElementById("tp-primer-status").innerHTML = "Done. All " + tp_list_length + " pages primed.";
			}

		}, interval_time);
	}

	document.getElementById("tp-primer-button").onclick = tp_priming;
});