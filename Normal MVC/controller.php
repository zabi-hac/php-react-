<?php
require '../model/db.php';
require '../lib/main.php';
$db = new Db();

// get methods 
if ($_GET) {
    if ($_GET['for'] == 'view') {
        $to_view = $db->get('full', 'hospitals');
        foreach ($to_view as $k => $v) {
            $sel_zone =  $db->get('one', 'zones', $v['zone_id']);
            $to_view[$k]['z_ward'] = $sel_zone['ward_no'];
            $to_view[$k]['z_panchayat'] = $sel_zone['panchayat'];
            $to_view[$k]['z_village'] = $sel_zone['village'];
            $to_view[$k]['z_district'] = $sel_zone['district'];
        }
        echo json_encode($to_view);
    } elseif ($_GET['for'] == 'delete') {   // delete

        if ($db->delete('hospitals', $_GET['id'])) {
            $res['stat'] = true;
        } else {
            $res['stat'] = false;
            $res['err'] = $db->con->error;
        }
        echo json_encode($res);
    }
}


// post methods
if ($_POST) {
    if ($_POST['for'] === 'add') { // add 
        unset($_POST['for']);
        if ($db->insert('hospitals', $_POST)) {
            $res['stat'] = true;
        } else {
            $res['stat'] = false;
            $res['err'] = $db->con->error;
        }
        echo json_encode($res);
    }
    if (isset($_POST['for'])) {
        if ($_POST['for'] === 'edit') {  // edit
            $id = $_POST['edit_id'];
            unset($_POST['for'], $_POST['edit_id']);
            if ($db->update('hospitals', $_POST, $id)) {
                $res['stat'] = true;
            } else {
                $res['stat'] = false;
                $res['err'] = $db->con->error;
            }
            echo json_encode($res);
        }
    }
}
