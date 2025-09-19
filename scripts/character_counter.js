// Kiválasztja az elemet a description id-vel
const textarea = document.getElementById('description');
// Kiválasztja az elemet ahová a karakterek száma lesz megjelenítve
const countSpan = document.getElementById('charCount');

// Karakterek megszámolása
function countCharacters() {
  const currentLength = textarea.value.length;
  countSpan.innerText = currentLength;
}

// Ha a mezőbe elkezd valaki írni a számolás elkezdődik
textarea.addEventListener('input', countCharacters);

// A projekt szerkesztése felületen ennek segítségével megmutatja hány karaktert tartalmaz a mező
countCharacters();