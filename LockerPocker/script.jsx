$(document).ready(function() {
    // Cargar datos al cargar la página
    loadTable('asignaciones', '#asignacionesTable');
    loadTable('lockers', '#lockersTable');
    loadTable('usuarios', '#usuariosTable');
});

function loadTable(tableName, tableId) {
    $.ajax({
        url: 'getData.php',
        type: 'POST',
        data: { table: tableName },
        success: function(data) {
            $(tableId).html(data);
        }
    });
}
