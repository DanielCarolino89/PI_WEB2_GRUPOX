<?php

class Notificator
{
    private static $message = null;

    public static function Alert(string $title, string $content)
    {
        Notificator::$message = '
        <script>
            swal("' . $title . '", "' . $content . '", "warning");
        </script>
        ';
    }

    public static function Inform(string $title, string $content)
    {
        Notificator::$message = '
        <script>
            swal("' . $title . '", "' . $content . '", "info");
        </script>
        ';
    }

    public static function Error(string $title, string $content)
    {
        Notificator::$message = '
        <script>
            swal("' . $title . '", "' . $content . '", "error");
        </script>
        ';
    }

    public static function ContainsMessage()
    {
        return Notificator::$message != null;
    }

    public static function ShowMessage()
    {
        echo Notificator::$message;
        Notificator::$message = null;
    }
} 


?>