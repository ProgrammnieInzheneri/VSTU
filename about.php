<?php
require_once 'bootstrap.php';

$param['title']=$config['site_title'];

//Html код основной части страницы
echo
        '';
$c = '
<!DOCTYPE html>
<html>
<body>
<div class="row">
   <div class="col-lg-4 col-md-4 col-sm-12">
    <img align="center" src="images/team_1.jpg" class="img-fluid">
    <span class="text-justify">Володимир Зеленський</span>
   </div>
   <div class="col-lg-8 col-md-8 col-sm-12 desc">

    <h3><font color="#FF6600">НАША КОМАНДА</font></h3>
    <p>
       ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
     tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
     quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
     consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
     cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
     proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
   </div>
  </div>
</body>
</html>';
$param['content'] = $c;
template($param);
