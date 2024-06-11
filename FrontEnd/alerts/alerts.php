<?php
if (isset($_COOKIE['error'])) {
    ?>
    <div class="flex items-center justify-center gap-x-1 rounded-md bg-red-50 px-2 py-1 text-sm font-medium text-red-700 ring-1 ring-inset ring-red-600/10 w-full"
        role="alert"
        id="alert">
        <strong class="text-sm">¡Algo salió mal!</strong>
        <?php echo $_COOKIE['error'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
}

if (isset($_COOKIE['success'])) {
    ?>
    <div class="flex items-center gap-x-1 rounded-md relative px-2 py-3 bg-green-50 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20"
        role="alert" id="alert">
        <strong>¡Genial!</strong>
        <?php echo $_COOKIE['success'] ?>
        <button type="button" class="btn-close" id="close-alert" aria-label="Close"></button>
    </div>
    <?php
}
if (isset($_COOKIE['error']) || isset($_COOKIE['success'])) {
    ?>
    <script>
        // Esperar a que se cargue completamente el DOM
        document.addEventListener('DOMContentLoaded', function () {
            var e = document.getElementById('alert');

            setTimeout(() => {
                // Verificar si el elemento existe antes de intentar eliminarlo
                if (e) {
                    // Eliminar el elemento del DOM
                    e.remove();
                }
            }, 2000);

            // Agregar un evento al botón de cerrar alerta
            document.getElementById('close-alert').addEventListener('click', () => {
                // Verificar si el elemento existe antes de intentar eliminarlo
                if (e) {
                    // Eliminar el elemento del DOM
                    e.remove();
                }
            });
        });
    </script>
    <?php
}
?>
