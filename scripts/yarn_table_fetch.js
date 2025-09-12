async function loadYarnTable() {
    const url = "/project/yarn_table.php";

    try {
        const response = await fetch(url);
        const text = await response.text();

        document.getElementById("yarns-table").innerHTML = text;
    } catch (error) {
        console.error(error.message);
    }
}