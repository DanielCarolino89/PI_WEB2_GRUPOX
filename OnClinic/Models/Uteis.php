<?php

class Uteis
{
    public static function ShowAlert(string $title, string $content)
    {
        echo "
        <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
        <script>
            window.onload = function() {
                swal({$title}, {$content}, 'warning');
            };
        </script>
        </script>
        ";
    }

    public static function ShowInfo(string $title, string $content)
    {
        echo "
        <script type='text/javascript' src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'>
        <script>
        window.onload = function() {
            swal({$title}, {$content}, 'info');
        };
        </script>
        </script>
        ";
    }
} 


?>