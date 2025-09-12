function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("table");

    // Azt figyeli hogy történt-e már sorcsere, ez kezdetben true hogy ez után elinduljon a sorcsere
    switching = true;

    // Rendezés beállítása növekvő sorrendre
    dir = "asc";

    while (switching) {

        // Váltás nincs a rendezésben
        switching = false;
        
        // A táblázat összes változóját eltárolja e rows változóban
        rows = table.rows;

        // Mindegyik soron menjen végig kivéve az elsőt, ami a table header
        for (i = 1; i < (rows.length - 1); i++) {
        // Először nincs rendezés
        
        shouldSwitch = false;
        /// Két elem összehasonlítása
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        // Leellenőrzi hogy a két elemet meg kellen-e cserélni
        if (dir == "asc") {
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            // Ha igen akkor megcseréli és lezárja
            shouldSwitch = true;
            break;
            }          
        } else if (dir == "desc") {
            // Ha igen akkor megcseréli és lezárja
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
            }
        }
        }
        
        // Ha a for ciklusban szükség volt a cserére ez elvégzi
        if (shouldSwitch) {
            // Ez helyezi át a cserélendő sort a másik elé
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            // A while ciklus újra lefut mivel történt csere
            switching = true;
            // Növeli a csere számlálót
            switchcount ++;
        } else {
            // Ha a legutóbbi ciklusban nem történt csere akkor a függvány irányát csökkenőre cseréli
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
