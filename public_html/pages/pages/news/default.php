<?php 
//REMOTE CHECK
if ($remote['is_remote'] != True) {
$con=mysqli_connect($database['host'],$database['user'],$database['pass'],$database['name']);
                if (mysqli_connect_errno())
                  { echo "Failed to connect to MySQL: " . mysqli_connect_error(); }
                  
                $result = mysqli_query($con,"SELECT * FROM news ORDER BY id DESC");
                $news_items = array();
                
                while($row = mysqli_fetch_array($result))
                  { array_push($news_items, array('id'=>$row['id'], 'posted_by'=>$row['posted_by'], 'news_subject'=>$row['news_subject'], 'news_text'=>$row['news_text'], 'news_date'=>$row['news_date'], 'news_edit'=>$row['news_edit'])); }                  
                mysqli_close($con);
} else {
	$contents = file_get_contents($settings_array['local_files']."/site_data.json", true);
	$contents = json_decode($contents, true);
	$news_items = $contents['news'];
}
?>

<div class="row">
<div class="col-md-12">
  <ul class="timeline">
<?php

if (count($news_items) > 0) {
  for ($b = 0; $b <= count($news_items) - 1; $b++) {
  $news_bg="bg-yellow";
  if ($b % 2 == 0) {
	$news_bg="bg-purple";
  }
?>
    <li>
    <i class="fa fa-paperclip <?php echo $news_bg; ?>"></i>
      <div class="timeline-item">
      <span class="time"><i class="fa fa-clock-o"></i> <?php echo "posted ".$news_items[$b]['news_date']; ?></span>
      <h3 class="timeline-header"><?php echo $news_items[$b]['news_subject']; ?> - by <?php echo $news_items[$b]['posted_by']; ?></h3>
      <div class="timeline-body">
	<?php echo $news_items[$b]['news_text']; ?>
	<br>
      </div>
<?php 
if($news_items[$b]['news_edit'] != '0') { 
?>
      <span class="time"><i class="fa fa-clock-o"></i> <?php echo "edited ".$news_items[$b]['news_edit']; ?></span>
      <h3 class="timeline-header">&nbsp</h3>
<?php 
} 
if(isset($_SESSION['user_id'])) {
?>
      <div class='timeline-footer'>
        <div class="row">
        <div class="col-md-1">
        <form role="form" method="post" action="index.php?action=admin&page=news&method=edit">
          <input type="hidden" name="news_id" value="<?php echo $news_items[$b]['id']; ?>">
          <input type="hidden" name="news_subject" value="<?php echo $news_items[$b]['news_subject']; ?>">
          <input type="hidden" name="news_text" value="<?php echo $news_items[$b]['news_text']; ?>">
            <button type="submit" class="btn btn-primary" name="edit"><i class="fa fa-pencil"></i> Edit News</button>        
        </form>      
        </div>
        <div class="col-md-1">  
        <form role="form" method="post" action="handler.php">    
          <input type="hidden" name="action" value="admin">
          <input type="hidden" name="page" value="<?php echo $page; ?>">
          <input type="hidden" name="news_id" value="<?php echo $news_items[$b]['id']; ?>">
            <button type="submit" class="btn btn-danger" name="delete_news"><i class="fa fa-times"></i> Delete</button>
        </form>
        </div>
        </div>
      </div>
<?php
}
?>
    </li>
<?php 
  }
} else {

?>
    <li>
    <i class="fa fa-paperclip bg-yellow"></i>
      <div class="timeline-item">
      <span class="time"><i class="fa fa-clock-o"></i> -</span>
      <h3 class="timeline-header">-</h3>
      <div class="timeline-body">
	No news
	<br>
      </div>    </li>
<?php 
}
?>
    <li>
      <i class="fa fa-bars"></i>
    </li>
  </ul>
  </div><!-- /.col -->
</div>
<br>
