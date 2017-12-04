<?= \kato\DropZone::widget([
    'options' => [
        'maxFilesize' => '2',
        'url' => 'index.php?=branches/upload'
    ],
    'clientEvents' => [
        'complete' => "function(file){console.log(file)}",
        'removedfile' => "function(file){alert(file.name + ' is removed')}"
    ],
]);
?>