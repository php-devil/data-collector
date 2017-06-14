<div class="row form-group">
    <?=$this->flag->label('col-xs-5', $this->flagLabel)?>
    <?=$this->flag->select('col-xs-7', ['data-role'=>'toggle-comment', 'data-toggle'=> $this->getID() . '_comment_block'])?>
</div>
<div class="row form-group <?php if(!$this->flag->checked())echo'hidden';?>" data-role="toggleable" data-block="<?=$this->getID() . '_comment_block'?>">
    <div class="col-xs-5"></div>
    <?=$this->comment->text('col-xs-7', $this->textComment)?>
</div>