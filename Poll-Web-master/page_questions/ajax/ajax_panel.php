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
        <ul class="nav nav-tabs">
            <li role="presentation" class="messages" id="all_messages"><a href="#">Tout</a></li>
            <li role="presentation" class="messages" id="valid_messages"><a href="#">Valide</a></li>
            <li role="presentation" class="messages" id="multi_messages"><a href="#">Doublon</a></li>
            <li role="presentation" class="messages" id="wrong_messages"><a href="#">Erroné</a></li>
            <li role="presentation" class="messages" id="late_messages"><a href="#">Hors-délai</a></li>
        </ul>
        <table id="messages_table" data-url="data1.json" data-height="400" data-row-style="rowStyle" class="table-hover">
            <?php create_messages_table($_GET['question']); ?>
        </table>
    </div>
</div>