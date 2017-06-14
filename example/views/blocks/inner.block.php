<div data-role="block-container-entity">
    <div class="row form-group">
        <div class="col-xs-1"><?=($this->_name + 1)?>.</div>
        <?=$this->name->label('col-xs-2', 'Наименование')?>
        <?=$this->name->input('col-xs-9')?>
    </div>
</div>