<?php

class Uteis
{
    public static function ShowAlert(string $title, string $content)
    {
        echo '
        <script src=\'https://unpkg.com/sweetalert/dist/sweetalert.min.js\'></script>
        <script>
            swal("' . $title . '", "' . $content . '", "warning");
        </script>
        </script>
        ';
    }

    public static function ShowInfo(string $title, string $content)
    {
        echo '
        <script src=\'https://unpkg.com/sweetalert/dist/sweetalert.min.js\'>
        <script>
            swal("' . $title . '", "' . $content . '", "info");
        </script>
        </script>
        ';
    }
} 


?>