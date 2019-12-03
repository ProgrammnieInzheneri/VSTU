<?php
require_once 'bootstrap.php';

if (isAdmin())
{
    $param['title']='Создать проект';

    $FormTitle = 'Добавить проект';
    $Action = 'add_project.php';
    $Method = 'POST';
    $SubmitTitle = 'Создать';
    $formFields = '
        <div class="row form-group">
            <div class="col-sm-8">
                <input type="text"
                    name="name"
                    class="form-control btn-block"
                    placeholder="Название"
                    value=""/>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-8">
                <textarea type="text"
                    name="description"
                    class="form-control btn-block"
                    placeholder="Описание"
                    value=""></textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-8">
                <input type="text"
                    name="requestedFunds"
                    class="form-control btn-block"
                    placeholder="Требуется средств"
                    value=""/>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-8">
                <input type="text"
                    name="period"
                    class="form-control btn-block"
                    placeholder="Период кампании"
                    value=""/>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <input  class="btn btn-primary mb-2" type="submit" value="'.$SubmitTitle.'"/>
            </div>
        </div>';

    $param['content'] =
        '<h3><center>'.$FormTitle.'</center></h3>
        <div class="row">
            <form action="'.$Action.'" method="'.$Method.'" class=" col-sm-offset-3 col-sm-6">'
                .$formFields.
            '</form>
        </div>';

    template($param);
}
else
{
    header('location:'.$config['site_url']);
}
