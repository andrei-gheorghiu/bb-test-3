<?php
/**
 * Created by PhpStorm.
 * User: andrei
 * Date: 20.10.2018
 * Time: 21:24
 */

if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is
} else {
    echo "<p>Thanks for using grunt-php :)</p>";
}
?>
