<?php
    require_once('../php/redirect.php');
?>

<div class="panel panel-default">
    <div class="panel-body" id="stats">
        <?php create_progress_bars($_GET['question']); ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body" id="infos_messages">
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default messages" id="all_messages">Tout</button>
            <button type="button" class="btn btn-success messages" id="valid_messages">Valide</button>
            <button type="button" class="btn btn-info messages" id="multi_messages">Doublon</button>
            <button type="button" class="btn btn-danger messages" id="wrong_messages">Erroné</button>
            <button type="button" class="btn btn-warning messages" id="late_messages">Hors-délai</button>
        </div>
        <table id="messages_table" data-url="data1.json" data-height="400" data-row-style="rowStyle" class="table-hover">
            <?php create_messages_table($_GET['question']); ?>
        </table>
    </div>
</div>