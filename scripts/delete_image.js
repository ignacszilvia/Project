document.addEventListener('DOMContentLoaded', function() {

    const deletedImagesInput = document.getElementById('deleted-images-input');
    const imageContainer = document.getElementById('existing-images-container');

    imageContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-image-btn')) {
            const imageItem = event.target.closest('.image-preview-item');
            if (imageItem) {
                const imagePath = imageItem.dataset.path;
                
                if (deletedImagesInput.value === '') {
                    deletedImagesInput.value = imagePath;
                } else {
                    deletedImagesInput.value += ',' + imagePath;
                }
                
                imageItem.remove();
            }
        }
    });
});