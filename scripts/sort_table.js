function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("table");
  switching = true;
  // Rendezés beállítása növekvő sorrendre
  dir = "asc";
  while (switching) {
    // Váltás nincs a renezésben
    switching = false;
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
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
