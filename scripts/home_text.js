document.addEventListener("DOMContentLoaded", () => {
    const typedText = document.querySelector(".typed-text");
    const cursor = document.querySelector(".cursor");
    const textArray = ["GildedHook"];
    let textArrayIndex = 0;
    let charIndex = 0;

    const type = () => {
        if (charIndex <= textArray[textArrayIndex].length - 1) {
            cursor.classList.remove('blink');
            typedText.textContent += textArray[textArrayIndex].charAt(charIndex);
            charIndex++;
            setTimeout(type, 120);
        } else {
            cursor.classList.add('blink');
        }
    };

    const styleBoxes = document.querySelectorAll('.style-box');
    if (styleBoxes.length > 0) {
        const randomIndex = Math.floor(Math.random() * styleBoxes.length);
        const randomBox = styleBoxes[randomIndex];
        randomBox.classList.add('visible');
    }

    type();
});