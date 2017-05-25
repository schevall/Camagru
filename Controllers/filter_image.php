<?php
function applyFilter($imgpath, $id_filter = 'filter1') {
    $output = imagecreatefrompng($imgpath);
    switch ($id_filter) {
      case 'filter1':
        $filter = imagecreatefrompng("../config/filters/Pikachu.png");
        break;

      case 'filter2':
        $filter = imagecreatefrompng("../config/filters/sword.png");
        break;

      case 'filter3':
        $filter = imagecreatefrompng("../config/filters/beer.png");
        break;

      case 'filter4':
        $filter = imagecreatefrompng("../config/filters/water.png");
        break;

      case 'filter5':
        $filter = imagecreatefrompng("../config/filters/Tree.png");
        break;
    }
    // $output_width = imagesx($output);
    // $output_height = imagesy($output);
    $output_width = 420;
    $output_height = 315;
    $filter_width = imagesx($filter);
    $filter_height = imagesy($filter);
    $filter_newwidth = $output_width/3;
    $filter_newheight = $output_height/3;

    if ($id_filter == 'filter1') {
      $filter_xpos = $output_width / 3;
      $filter_ypos = $output_height / 3 ;
    } else if ($id_filter == 'filter2') {
      $filter_newwidth = $output_width/1.7;
      $filter_newheight = $output_height/1.7;
      $filter_xpos = $output_width / 3;
      $filter_ypos = $output_height / 3;
    } else if ($id_filter == 'filter3') {
      $filter_xpos = $output_width / 3;
      $filter_ypos = $output_height / 1.5;
    } else if ($id_filter == 'filter4' || $id_filter == 'filter5') {
      $filter_newwidth = $output_width;
      $filter_newheight = $output_height;
      $filter_xpos = 0;
      $filter_ypos = 0;
    }
    $newfilter = imagecreatetruecolor($filter_newwidth, $filter_newheight);
    imagecolortransparent($newfilter, null);
    imagecopyresampled($newfilter, $filter, 0, 0, 0, 0, $filter_newwidth, $filter_newheight, $filter_width, $filter_height);
    // imagecopyresized($newfilter, $filter, 0, 0, 0, 0, $filter_newwidth, $filter_newheight, $filter_width, $filter_height);
    imagecopymerge ($output, $newfilter, $filter_xpos, $filter_ypos, 0, 0, $filter_newwidth, $filter_newheight, 100);
    imagepng($output, $imgpath);
}
?>
