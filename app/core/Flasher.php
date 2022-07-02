<?php 

class Flasher {

    public static function setFlash($message, $alert_type)
    {
        $_SESSION['flash'] = [
            'message' => $message,
            'alert_type' => $alert_type
        ];
    }

    public static function flash()
    {
        if(isset($_SESSION['flash']))
        {
            echo '<div class="alert alert-'. $_SESSION['flash']['alert_type'] .' alert-dismissible fade show" role="alert">
            '. $_SESSION['flash']['message'] .'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          unset($_SESSION['flash']);
        }
    }
}