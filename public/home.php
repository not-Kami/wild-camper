<?php
foreach($layout['home'] as $component) {
    include 'components/' . $component . '.php';
}
?>