<div class="row form-group">
<?=$this->flag1->label('col-xs-2', 'Первый флаг как определен')?>
<?=$this->flag1->select('col-xs-10')?>
</div>
<div class="row form-group">
<?=$this->flag2->label('col-xs-2', 'Второй флаг c дефолтом none')?>
<?=$this->flag2->select('col-xs-10', [], 'none')?>
</div>
<div class="row form-group">
<?=$this->flag3->label('col-xs-2', 'Третий флаг c дефолтом all')?>
<?=$this->flag3->select('col-xs-10', [], 'all')?>
</div>
