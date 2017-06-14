<div class="multiblock" data-role="block-container" data-container="<?=$this->getID()?>">
    <?=$innerHtml?>
    <div data-role="addblock-button" class="row form-group">
        <div class="col-xs-1"></div>
        <div class="col-xs-11">
            <a href="#" data-role="button" class="btn btn-success" data-block="<?=$this->getID()?>" data-entity="<?=$this->getName()?>"><?=$this->_button?></a>
        </div>
    </div>
</div>