<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="css/output.css">
</head>

<body class="bg-slate-300 font-sans">
    <main class="flex flex-col gap-2 m-4">

        <?php

        $directorio = 'txt/';
        
        // Escanea el directorio y obtiene un array con los nombres de los archivos y directorios
        $files = scandir($directorio);

        foreach ($files as $file) {

            if ($file != '.' && $file != '..') {
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                // Verifica si la extensión es 'txt'
                if ($extension == 'txt') {
                    ?>
                    <article class="overflow-auto rounded-lg sm:shadow-none shadow ">

                        <!-- <h2 class="file-header">
                        <?php echo $file ?>
                    </h2> -->

                        <?php

                        $file_path = $directorio . $file;

                        if (file_exists($file_path) && filesize($file_path) > 0) {
                            ?>
     <table class="w-full sm:max-w-[1080px] p-0 sm:p-4 text-center mx-auto ">
            <thead class="bg-gray-50 border-b-2 border-gray-200">
        <tr>

            <th class="p-3 text-sm font-semibold tracking-wide text-center border-l-2 border-gray-200">a</th>

         <th class="p-3 text-sm font-semibold tracking-wide text-center border-l-2 border-gray-200">
                 Código franciquiado</th>

                                        <th class="p-3 text-sm font-semibold tracking-wide text-center border-l-2 border-gray-200">
                                            Nombre
                                            Completo</th>

                                        <th class="p-3 text-sm font-semibold tracking-wide text-center border-l-2 border-gray-200">
                                            Posición
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center divide-y divide-gray-100">
                                    <?php
                                    $_file = fopen($file_path, 'r');

                                    while (($line = fgets($_file)) !== false) {

                                        $a = substr($line, 0, 1);
                                        $f_cod = substr($line, 1, 6);
                                        $fullname = substr($line, 7, 60);
                                        $position = substr($line, 69, 1);
                                        ?>
                                        <tr class="bg-white p-3">

                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                                <?php echo $a; ?>
                                            </td>

                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                                <?php echo $f_cod; ?>
                                            </td>

                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                                <?php echo $fullname; ?>
                                            </td>

                                            <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                                <?php echo $position; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                                <?php

                                fclose($_file);
                                ?>

                            </table>
                            <?php
                        }

                        ?>
                    </article>
                    <?php
                }

            }
        }
        ?>

    </main>
</body>

</html>