jqgrid
======

* Base on JqGrid, easy Yii JqGrid extension

### [Setup]:
*  This extension have to be installed into:
*  Yii-Application/proected/extensions/jqgrid
  
### [Usage]:
```php
     <?php 
      $this->widget('ext.jqgrid.JqGrid', array(
       'id'=>'demo',
       'language'=>'cn',
       'options'=>array(
           'treeGrid'=>'true',
           'treeGridModel'=>'adjacency',
           'ExpandColumn'=>'name',
           'rowNum'=>'-1',
           'url'=>'/path/to/grid.json',
           'datatype'=>'json',
           'treedatatype'=>'json',
           'treeIcons'=>array(
               'plus'=>'icon-plus',
               'minus'=>'icon-minus',
               'leaf'=>'icon-cancel',               
           ),
           'mtype'=>'POST',
           'ExpandColClick'=>'true',
           'colNames'=>array('id', 'name'),
           'colModel'=>array(
               array(
                   'name'=>'id',
                   'index'=>'id',
                   'width'=>'100',
                   'hidden'=>false,
                   'key'=>true,
                   ),
               array(
                   'name'=>'name',
                   'index'=>'name',
                   'width'=>'300',
                   'sortable'=>false,
               ),
               ),
           'height'=>'auto',
           'caption'=>'View Groups',
       )
   ))

   ?>
```
====  
### [See also]:
*  <http://trirand.com/blog/jqgrid/jqgrid.html>
*  <https://github.com/tonytomov/jqGrid>