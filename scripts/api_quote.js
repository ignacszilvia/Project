document.addEventListener('DOMContentLoaded', (event) => {
    // Rámutat a HTML elemre ahová bekerül a kód
    const quoteText = document.getElementById('quote-text');
    const quoteAuthor = document.getElementById('quote-author');

    // Az API linkje
    const apiURL = 'https://api.quotable.io/random';

    // Új idézet lekérése
    async function getQuote() {
        try {
            const response = await fetch(apiURL);
            const data = await response.json();

            // A kijelölt elemek frissítése
            quoteText.textContent = `"${data.content}"`;
            quoteAuthor.textContent = `- ${data.author}`;

        } catch (error) {
            console.error('Could not fetch quote:', error);
            quoteText.textContent = 'Failed to load quote.';
            quoteAuthor.textContent = '';
        }
    }
    
    getQuote();
    
});