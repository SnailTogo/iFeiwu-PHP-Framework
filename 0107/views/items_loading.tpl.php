<?php foreach ($this->items as $item):?>
<li><a href="javascript:;" data-id="<?php echo $item['id'];?>"><img src="<?php echo $item['image_path'];?>/<?php echo $item['image'];?>" alt="<?php echo $item['title'];?>"></a></li>
<?php endforeach;?>