/* eslint-disable no-undef */
window.addEventListener( 'load', () => {
	/**
	 * Start Priming.
	 */
	function tpPriming() {
		const tpListLength = tpList.length;

		let counter = 0;

		// 1000 ms = 1 second
		const intervalTime = 3000;

		document.getElementById( 'tp-primer-button' ).setAttribute( 'disabled', 'disabled' );
		document.getElementById( 'tp-primer-status' ).className = 'tp-primer-start';
		document.getElementById( 'tp-primer-status' ).innerHTML = tpPrimerObj.tpTpStartPriming;

		// Start interval
		const interval = setInterval( () => {
			const rest = tpList.length - counter;

			const remainingTime = rest * intervalTime / 1000;

			// Change status.
			const countershow = counter + 1;
			document.getElementById( 'tp-primer-status' ).className = 'tp-primer-prime';
			document.getElementById( 'tp-primer-status' ).innerHTML = `${tpPrimerObj.tpTpPrimePage} ${countershow} ${tpPrimerObj.tpTpOf} ${tpListLength}. ${tpPrimerObj.tpTpRemainingTime}: ${remainingTime}${tpPrimerObj.tpTpSec}.`;

			// Change src url
			const tpUrl = tpList[ counter ];
			document.getElementById( 'tp-primer-iframe' ).src = tpUrl;

			counter++;

			// Stop interval if list end
			if ( counter === tpListLength ) {
				clearInterval( interval );
				document.getElementById( 'tp-primer-button' ).removeAttribute( 'disabled' );
				document.getElementById( 'tp-primer-status' ).className = 'tp-primer-done';
				document.getElementById( 'tp-primer-status' ).innerHTML = `Done. All ${tpListLength} pages primed.`;
			}
		}, intervalTime );
	}

	document.getElementById( 'tp-primer-button' ).onclick = tpPriming;
} );
