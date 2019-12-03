<?php

require_once 'bootstrap.php';

$param['title']=$config['site_title'];
$Query=
    'SELECT
        projects.id,
        projects.name AS "Название",
        CONCAT(SUBSTR(projects.description, 1, 500), "...") AS "Описание",
        CONCAT(projects.currentFunds, \' из \', projects.requestedFunds) AS "Собрано денег, руб.",
        TIMESTAMPDIFF(
            DAY, CURRENT_TIMESTAMP, DATE_ADD(projects.tStamp,
            INTERVAL projects.period DAY))
            AS "Дней до закрытия"
    FROM projects
    WHERE NOT TIMESTAMPDIFF(
            DAY, CURRENT_TIMESTAMP, DATE_ADD(projects.tStamp,
            INTERVAL projects.period DAY)) < 0';

$Query=getModificatedForSearchingQuery($Query);
Pagination($Query,$Navigation,10);
$p['title']='Проекты';
//$p['buttons'] = array(
//    array('Редактировать', 'btn btn-success', 'edit_project.php?id='),
//    array('Удалить', 'btn btn-danger', 'delete_project.php?id=')
//);
$p['Navigation']=$Navigation;
$p['searchForm']=getSearchForm(array('projects_name','projects_description'), array(), 2);
$param['content']=getDBTableAsHTML($Query,$p);

if (isAdmin())
{
    // $formParams['Action']='add_project.php';
    // $formParams['SubmitTitle']='Добавить';
    // $fieldParams = array(
    //     "name" => array(
    //         "Название" => null
    //     ),
    //     "description" => array(
    //         "Описание" => null
    //     ),
    //     "requestedFunds" => array(
    //         "Требуется средств" => null
    //     ),
    //     "period" => array(
    //         "Период кампании" => null
    //     )
    // );
    // $param['content'].=getForm($formParams, $fieldParams);
}

template($param);