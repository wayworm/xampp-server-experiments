<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ted Files</title>
    <link rel="stylesheet" href="format/style.css">
    <link rel="icon" href="format/frog-face-11.webp" type="image/x-icon" />
</head>
<body class="bg-light text-dark">
    <div class="container mt-5">
        <h1 class="text-center text-primary">Shared Files</h1>
        <ul class="list-group mt-4">
            <?php

            // Get the base directory (relative to the script)
            $baseDir = realpath(getcwd()); // Change this to a specific subdirectory if needed
            $currentDir = isset($_GET['dir']) ? $_GET['dir'] : '.';

            // Ensure the directory stays within the base directory
            $currentDirPath = realpath($baseDir . DIRECTORY_SEPARATOR . $currentDir);

            if (strpos($currentDirPath, $baseDir) !== 0) {
                die("Access denied."); // Prevent navigation outside the base directory
            }

            // Generate the "Up" link if not at the root
            if ($currentDir !== 'shared_files') {
                $parentDir = dirname($currentDir);
                echo "<li class=\"list-group-item\"><a href=\"?dir=$parentDir\">⬆️ Up to Parent Directory</a></li>";
            }

            $dir = '.';
            $d = 'uploads';
            $files = array_diff(scandir($dir), array('.','..', 'index.php')); // Exclude index.php

            // Define files to hide
            $hidden_files = array('frog-face-11.webp','style.css','upload.php','format');

            foreach ($files as $file) {
                 if (in_array($file, $hidden_files)) {
                     continue; // Skip hidden files
                 }
                echo "<li><a href=\"$file\">$file</a></li>";
                }
            ?>
        </ul>
    </div>

    <!-- confused by github not working -->
    <form action="format/upload.php" method="POST" enctype="multipart/form-data" class="mb-4">
    <label for="fileUpload">Upload a file:</label>
    <input type="file" name="fileUpload" id="fileUpload" class="form-control mb-2" required>
    <button type="submit" class="btn btn-primary">Upload</button>
    </form>

</body>

<footer> "Yo mama" </footer>

</html>
