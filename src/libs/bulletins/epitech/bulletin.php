<?php

function bulletin_add($period_id) {
    global $pdo;

    $req = 'SELECT * '
            . 'FROM marks '
            . 'LEFT JOIN participations ON mark_participation = part_id '
            . 'WHERE part_status = \'ACCEPTED\' '
            . 'AND mark_period = ?';

    $sql = $pdo->prepare($req);
    $sql->bindValue(1, $period_id);
    $sql->execute();

    $users = array();

    while ($mark = $sql->fetch()) {
        var_dump($mark);
        isset($users[$mark['mark_user']]) || $users[$mark['mark_user']] = array();
        $users[$mark['mark_user']][] = array(
            "label" => $mark['part_title'],
            "duration" => $mark['part_duration'] * $mark['mark_mark'] / 20,
        );
    }

    $ins = $pdo->prepare('INSERT INTO bulletin_user '
            . '(bu_period, bu_user, bu_data) '
            . 'VALUES (?, ?, ?)');
    $ins->bindValue(1, $period_id);

    foreach ($users as $userid => $details) {
        $ins->bindValue(2, $userid);
        $ins->bindValue(3, serialize($details));
        $ins->execute();
    }
}

function bulletin_view($period_id) {
    global $tpl, $root;

    $mdl = new Modele('bulletin_user');
    $mdl->find(array('bu_period' => $period_id));

    $colums = array();

    while ($mdl->next()) {
        $marks = unserialize($mdl->bu_data);
        $line = array(
            'user' => $mdl->bu_user,
        );

        foreach ($marks as $mark) {
            if (!in_array($mark['label'], $colums)) {
                $colums[] = $mark['label'];
            }
            $line[$mark['label']] = $mark['duration'];
        }

        $tpl->append('marks', $line);
    }

    $tpl->assign('colums', $colums);
    $tpl->display($root . 'libs/bulletins/epitech/view.tpl');
}

function bulletin_edit($period_id) {
    global $tpl, $root;

    $mdl = new Modele('bulletin_user');
    $mdl->find(array('bu_period' => $period_id));

    $colums = array();

    while ($mdl->next()) {
        $marks = unserialize($mdl->bu_data);
        $line = array(
            'user' => $mdl->bu_user,
        );

        foreach ($marks as $mark) {
            if (!in_array($mark['label'], $colums)) {
                $colums[] = $mark['label'];
            }
            $line[$mark['label']] = $mark['duration'];
        }

        $tpl->append('marks', $line);
    }

    $tpl->assign('colums', $colums);
    $tpl->display($root . 'libs/bulletins/epitech/edit.tpl');
}
