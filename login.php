<?phprequire_once 'bootstrap.php';if (isset($_POST['login'],$_POST['password'])){    $q='SELECT * FROM admin WHERE '.        '(login=\''.addslashes($_POST['login']).'\') AND '.        '(password=\''.getHash($_POST['password']).'\')';    $r=mysqli_query($link,$q);    if ($r){        if (mysqli_num_rows($r)>0){            $row=mysqli_fetch_array($r);            $_SESSION['Id']=$row['id'];        }    };    header('location:'.$config['site_url']);}else{    $c =        '<form class="col-md-3" method="post" action="login.php">            <input name="login" class="form-group form-control" type="text" placeholder="Логин"/>            <input name="password" class="form-group form-control" type="password" placeholder="Пароль"/>            <input class="form-group form-control btn-primary" type="submit" value="Войти"/>        </form>';    $param['title'] = 'Login | '.$config['site_title'];    $param['content'] = $c;    template($param);}