<input type="hidden" name="<?=$this->getName()?>" id="<?=$this->getID()?>_notchecked" value="0"/>
<input type="checkbox" <?=$this->options?> name="<?=$this->getName()?>" id="<?=$this->getID()?>" value="1" <?php if ($this->checked()) echo ' checked="checked"';?>>
<label class="control-label" for="<?=$this->getID()?>"><?=$this->text?></label>
