<div class="navbar">
	<div class="navbar-inner">
	<a class="brand" href="./">MyContacts</a>
		<ul class="nav">
		<?php foreach($pages as $file => $text): ?>
			<?php if(is_array($text)): // If this is a dropdown ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $file?></a>
				<ul class="dropdown-menu">
				<?php foreach ($text as $page => $name):?>
					<li><a href="./?p=<?php echo $page?>"><?php echo $name?></a></li>
				<?php endforeach?>
				</ul>
				<form method="get" class="form-inline pull-right">
					<input type="hidden" name="p" value="list_contacts" />
					<div class="input-append">
						<input class="span2" type="text" name="q" placeholder="search"/>
						<button type="submit" class="add-on btn"><i class="icon-search"></i></button> 
					</div>
				</form>
			</li>
			<?php else: ?>
			<li><a href="./?p=<?php echo $file ?>"><?php echo $text ?></a></li>
			<?php endif ?>
		<?php endforeach ?>
		</ul>
	</div>
</div>