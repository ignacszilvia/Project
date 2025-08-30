// Átállítja a jelszó láthatóságát, azzal hogy í típust jelszóról, szövegre változtatja.

function togglePasswordVisibility() {
    const x = document.getElementById("pass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
} 

// Ezzel a funkcióval az összes elemet kiválasztja aminek az osztálya pass. A for-ral végigmegy az összes mezőn és átállítja a típust jelszóról szövegre.
function togglePasswordVisibilityPage() {
    const passwordFields = document.getElementsByClassName("pass");
    for (let i = 0; i < passwordFields.length; i++) {
        const field = passwordFields[i];
        if (field.type === "password") {
            field.type = "text";
        } else {
            field.type = "password";
        }
    }
}