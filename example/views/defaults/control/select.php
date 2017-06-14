<select <?=$this->options?> id="<?=$this->getID()?>" name="<?=$this->getName()?>" class="form-control">
<?php foreach($this->_variants as $k=>$v): ?>
   <option value="<?=$k?>" <?php if($k===$this->_value)echo' selected="selected"'?>><?=$v?></option>
<?php endforeach; ?>
</select>
