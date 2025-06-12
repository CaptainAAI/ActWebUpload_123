
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar File</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-purple-200 via-pink-100 to-blue-100 flex items-center justify-center">
    <div class="max-w-3xl w-full mx-auto bg-white/80 shadow-2xl rounded-2xl p-10 border border-purple-200 backdrop-blur">
        <h2 class="text-3xl font-extrabold mb-6 text-purple-700 text-center tracking-wide">Daftar File yang Diunggah</h2>

        <?php
        // Handle file deletion
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
            $fileToDelete = basename($_POST['delete']); // amankan nama file
            $filePath = "uploads/" . $fileToDelete;

            if (file_exists($filePath)) {
                unlink($filePath);
                echo "<p class='text-green-600 mb-4 text-center'>File <strong>$fileToDelete</strong> berhasil dihapus.</p>";
            } else {
                echo "<p class='text-red-600 mb-4 text-center'>File tidak ditemukan.</p>";
            }
        }
        ?>

        <ul class="space-y-6">
        <?php
        $dir = "uploads/";
        if (is_dir($dir)) {
            $files = array_diff(scandir($dir), array('.', '..'));
            if (count($files) > 0) {
                foreach ($files as $file) {
                    $path = $dir . $file;
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']);

                    echo "<li class='bg-white/90 border border-purple-100 p-5 rounded-xl shadow-md hover:shadow-xl transition'>
                            <div class='flex flex-col md:flex-row md:items-center md:justify-between gap-3'>
                                <span class='font-semibold text-purple-700 break-all'>$file</span>
                                <div class='flex gap-2'>
                                    <a href='$path' target='_blank' class='flex items-center gap-1 px-3 py-1 rounded text-blue-700 hover:bg-blue-50 transition'>
                                        <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M15 10l4.553 2.276A2 2 0 0121 14.118V17a2 2 0 01-2 2H5a2 2 0 01-2-2v-2.882a2 2 0 01.447-1.842L8 10m7-6v6m0 0l-3-3m3 3l3-3\" /></svg>
                                        Lihat
                                    </a>
                                    <a href='$path' download class='flex items-center gap-1 px-3 py-1 rounded text-green-700 hover:bg-green-50 transition'>
                                        <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12\" /></svg>
                                        Download
                                    </a>
                                    <form method='post' class='inline' onsubmit=\"return confirm('Yakin ingin menghapus file ini?');\">
                                        <input type='hidden' name='delete' value='$file'>
                                        <button type='submit' class='flex items-center gap-1 px-3 py-1 rounded text-red-700 hover:bg-red-50 transition'>
                                            <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M6 18L18 6M6 6l12 12\" /></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>";

                    if ($isImage) {
                        echo "<div class='mt-4 flex justify-center'><img src='$path' alt='$file' class='max-w-xs max-h-60 rounded-lg border-2 border-purple-200 shadow' /></div>";
                    }

                    echo "</li>";
                }
            } else {
                echo "<li class='text-center text-gray-500'>Tidak ada file yang diunggah.</li>";
            }
        } else {
            echo "<li class='text-center text-red-500'>Folder uploads tidak ditemukan.</li>";
        }
        ?>
        </ul>

        <a href="index.html" class="mt-8 inline-block text-purple-600 hover:underline hover:text-purple-800 transition text-lg font-semibold">← Kembali ke Upload</a>
    </div>
</body>
</html>