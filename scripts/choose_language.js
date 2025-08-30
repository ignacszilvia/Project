// MEgvárja amíg az oldal teljesen betöltött
document.addEventListener('DOMContentLoaded', function() {
    const langLinks = document.querySelectorAll('.lang-menu a');

    langLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            // Meggátolja az oldal újratöltését
            event.preventDefault();

            // Kiszedi a data-langból hogy melyik nyelvre lett rákattintva
            const newLang = this.getAttribute('data-lang');

            // Elküldi a szervernek a kódot
            fetch('/project/backend/set_language.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'lang=' + newLang
            })
                        
            .then(response => {
                // Újratölti az oldalt a kiválasztott nyelvvel
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