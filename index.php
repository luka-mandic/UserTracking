<?php

require_once("includes/header.php");
require_once("includes/Database.php");
require_once("includes/User.php");
?>

<div class="container">
    <div class="jumbotron text-center">
      <h1 class="display-4">Hello, world!</h1>
      <p class="lead">This is a simple application that collects data about its users!</p>
      <hr class="my-4">
      <p>Login to see the data</p>
      <p class="lead">
        <a class="btn btn-primary btn-lg" href="login.php" role="button">Log in</a>
      </p>
    </div>
</div>


</body>
</html>


<?php

$user = new User();

$user->getLocationInfoByIp();
$user->getBrowserInfo();
$user->getOSInfo();


if($user->isUnique()){
	$user->saveUser();
}
