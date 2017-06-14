<div data-role="block-container-entity">
    <div class="row form-group">
        <div class="col-xs-1 rtext-right"><?=$this->_name+1?></div>
        <?=$this->name->input('col-xs-11', 'Наименование')?>
    </div>
    <div class="row form-group">
        <div class="col-xs-1 rtext-right"></div>
        <div class="col-xs-11">
            <?=$this->multiinner->render()?>
        </div>
    </div>
</div>