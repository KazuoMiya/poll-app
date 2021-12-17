<h1>Registerページ</h1>
<!-- <img src="<?php echo BASE_IMAGE_PATH ?>logo.svg" alt=""> -->
<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
    <input type="text" name="id">
    <input type="password" name="pwd">
    <input type="text" name="nickname">
    <input type="submit" value="Regist">
</form>