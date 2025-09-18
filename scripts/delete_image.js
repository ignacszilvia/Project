document.addEventListener('DOMContentLoaded', function() {

    // Kiválasztja ezekkel az id-vel ellátott elemeket. Ebbe a mezőbe írja ki a törlendő elemek útvonalait.
    const deletedImagesInput = document.getElementById('deleted-images-input');

    //Meglévő képeket tartalmazó elem
    const imageContainer = document.getElementById('existing-images-container');

    // az imageContainer változóhoz hozzáad egy klikkeseményt
    imageContainer.addEventListener('click', function(event) {
        // Leellenőrzi hogy a megfelelő elemre történt a kattintás
        if (event.target.classList.contains('delete-image-btn')) {
            // Megkeresi a legközelebbi elemet amely rendelkezik ezzel az osztállyal
            const imageItem = event.target.closest('.image-preview-item');
            // Lekéri a kép útvonalát
            if (imageItem) {
                const imagePath = imageItem.dataset.path;
                
                // A kód leellenőrzi hogy a beviteli menző üres-e
                if (deletedImagesInput.value === '') {
                    //Ha még üres akkor beírja az úrvonalát a imagePath elembe
                    deletedImagesInput.value = imagePath;
                } else {
                    // Ha nem üres akkor a kép útvonalát hozzáteszi vesszővel elválasztva és egy lista jön létre a törlendő képek útvonalaiból
                    deletedImagesInput.value += ',' + imagePath;
                }
                
                // Kép eltávolítása az oldalról
                imageItem.remove();
            }
        }
    });
});