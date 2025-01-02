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
            // Get the current directory from the query parameter or default to the root directory
            $currentDir = isset($_GET['dir']) ? $_GET['dir'] : '';

            // Get the absolute path of the current directory
            $currentDirPath = realpath($currentDir ? $currentDir : '.');

            // Ensure the directory stays within the base directory (current working directory)
            if (strpos($currentDirPath, realpath(getcwd())) !== 0) {
                die("Access denied.");
            }

            // If not at the root directory, show the "Up to Parent Directory" link
            if ($currentDir !== '') {
                $parentDir = dirname($currentDir);
                echo "<li class=\"list-group-item\"><a href=\"?dir=$parentDir\">⬆️ Up to Parent Directory</a></li>";
            }

            // Scan the current directory for files and directories
            $files = array_diff(scandir($currentDirPath), array('.', '..')); // Exclude . and ..

            // Define files and folders to hide
            $hidden_files = array('style.css', 'upload.php', 'format', 'frog-face-11.webp');

            foreach ($files as $file) {
                // Skip hidden files and folders
                if (in_array($file, $hidden_files)) {
                    continue;
                }

                // Build the relative path for the file
                $relativePath = ($currentDir !== '' ? $currentDir . '/' : '') . $file;

                // Check if it's a directory or file
                if (is_dir($currentDirPath . DIRECTORY_SEPARATOR . $file)) {
                    echo "<li class=\"list-group-item\"><a href=\"?dir=$relativePath\">📁 $file</a></li>";
                } else {
                    echo "<li class=\"list-group-item\"><a href=\"$relativePath\">📄 $file</a></li>";
                }
            }
            ?>
        </ul>
    </div>

    <!-- Upload form -->
    <form action="format/upload.php" method="POST" enctype="multipart/form-data" class="mb-4">
        <label for="fileUpload">Upload a file:</label>
        <input type="file" name="fileUpload" id="fileUpload" class="form-control mb-2" required>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

</body>
</html>
