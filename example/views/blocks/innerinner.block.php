<div data-role="block-container-entity">
    <div class="row form-group">
        <div class="col-xs-1 text-right"><?=$this->_name+1?></div>
        <?=$this->name->input('col-xs-11', 'Вариант подзаголовка')?>
    </div>
    <div class="row form-group">
        <div class="col-xs-1 text-right"></div>
        <?=$this->subname->input('col-xs-11', 'Набор других даннын')?>
    </div>
</div>