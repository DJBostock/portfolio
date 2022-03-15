let apiQuotes = [];

function newQuote() {
	let quoteIndex = Math.floor(Math.random() * apiQuotes.length);
	console.log(apiQuotes[quoteIndex]);
}

async function getQuotes() {
	const apiUrl =
		"https://jacintodesign.github.io/quotes-api/data/quotes.json";
	try {
		const response = await fetch(apiUrl);
		apiQuotes = await response.json();
		newQuote();
	} catch (error) {
		// Handle Error Here.
		alert(error);
	}
}

getQuotes();
