function toggleNewBrandInput() {
    var selectBox = document.getElementById('brand');
    var newBrandInput = document.getElementById('new_brand_name');
    if (selectBox.value === 'new_brand') {
        newBrandInput.style.display = 'block';
        newBrandInput.setAttribute('required', 'required');
    } else {
        newBrandInput.style.display = 'none';
        newBrandInput.removeAttribute('required');
    }
}

/* Ha a brand id-val rendelkező lenyíló menüben új márka hozzáadását választjuk, a new_brand_name id-val rendelkező beviteli mező megjelenik. Ennek erdetileg display:none a megjelenítési formája ami a css fájlban található meg*/