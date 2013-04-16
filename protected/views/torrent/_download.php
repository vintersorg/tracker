<?php echo CHtml::link($model->torrent_file, $model->torrent);echo "<hr>"; ?>
<?php foreach($model->children as $key => $children): ?>
	<?php echo CHtml::link($children->torrent_file, $children->torrent);echo "<hr>"; ?>
<?php endforeach; ?>