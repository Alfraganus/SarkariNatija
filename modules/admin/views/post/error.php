<?php
use yii\helpers\Url;
?>
<div class="container" style="margin:100px">
<center>
<div class="alert alert-danger">
  <strong><h1>Sorry! however the request file <i><span style='color:blue'>"<?=$link?>"</span></i> was not found in database! Please choose another one</h1></strong>  
</div>
 <h2><a href="<?=Url::previous('post');?>"><button class="btn btn-primary">Back to post</button></a></h2>
</center>
</div>