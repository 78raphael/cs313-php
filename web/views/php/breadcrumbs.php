<?php

$breadcrumbs = '<nav class="breadcrumbs">';
$breadcrumbs .= '<ul>';

  foreach($crumbs as $key => $value) {
    $breadcrumbs .= '<li><a href="'.$value.'" alt="Link to '.$key.'">'.$key.'</a></li>';
  }

$breadcrumbs .= '</ul>';
$breadcrumbs .= '</nav>';