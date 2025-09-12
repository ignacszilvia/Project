document.addEventListener("DOMContentLoaded", () => {
    // Ide fog kerülni a gépelt szöveg
    const typedText = document.querySelector(".typed-text");
    
    // Kiválasztja a cursor elemet
    const cursor = document.querySelector(".cursor");

    // Ez tartalmazza a gépelendő szöveget
    const textArray = ["GildedHook"];

    // A tömb indexét követi nyomon
    let textArrayIndex = 0;

    // Az aktuális karakter indexét követi nyomon
    let charIndex = 0;

    // Ez a függvény felelős a gépelési animációért
    const type = () => {
        // Ellenőrzi hogy van-e gépelendő karakter
        if (charIndex <= textArray[textArrayIndex].length - 1) {
            // Eltávolítja a cursor-ról a blink osztályt (nem fog tovább villogni)
            cursor.classList.remove('blink');
            // Hozzáadja a következő karaktert az indexhez
            typedText.textContent += textArray[textArrayIndex].charAt(charIndex);
            // Növeli a karakterindexet
            charIndex++;
            // A setTimeout egy beépített fügyvény, ami egy időzítőt állít be. 120 milliszekundum után elindítja a type függvényt
            setTimeout(type, 120);
            // Ez a folyamat addig folytítódik amíg az összes karakter megjelenik
        } else {
            // A kurzorhoz hozzáadja a blink osztályt
            cursor.classList.add('blink');
        }
    };

    // Véletlenszerű animáció megjelenítése a főoldalon
    // Kiválasztja az elemeket aminek style-box osztálya van
    const styleBoxes = document.querySelectorAll('.style-box');
    if (styleBoxes.length > 0) {
        // Kiválasztja a véletlenszerűen generált elemet
        const randomIndex = Math.floor(Math.random() * styleBoxes.length);
        const randomBox = styleBoxes[randomIndex];
        // Hozzáadja a visible osztályt
        randomBox.classList.add('visible');
    }

    type();
});