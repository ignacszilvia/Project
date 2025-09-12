// Megvárja amíg az oldal teljesen betöltött.
document.addEventListener('DOMContentLoaded', function() {

    // Kiválasztja a nyelvi linkeket a lang-menu osztályú elemben.
    const langLinks = document.querySelectorAll('.lang-menu a');

    // Végigmegy az összes linken és egy kattintástfigyelőt ad hozzá.
    langLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            // Meggátolja az oldal újratöltését.
            event.preventDefault();

            // Kiválasztja a data-lang elemből hogy melyik nyelvre lett rákattintva.
            const newLang = this.getAttribute('data-lang');

            // A függvény egy kérést küld a set_language.php szkriptnek.
            fetch('/project/backend/set_language.php', {
                // Adat küldése a szervernek POST metódussal.
                method: 'POST',
                // Ez a fejléc tájékoztatja a szervert, hogy a küldött adatok űrlap formátumban vannak kódolva, vagyis a formátum kulcs-érték párokat használ.
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                // Az érték arra változik amelyik nyelvet kiválasztottuk.
                body: 'lang=' + newLang
            })
                        
            .then(response => {
                // Újratölti az oldalt a kiválasztott nyelvvel.
                if (response.ok) {
                    window.location.reload();
                }
            })
                
            .catch(error => {
                console.error('Error:', error);
            });
          		
        });
      		
    });
  		
});