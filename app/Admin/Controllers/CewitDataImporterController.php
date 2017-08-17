<?php

namespace App\Admin\Controllers;

use App\Models\CewitContacts;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form as FrontEndForm;
use Illuminate\Http\Request;

class CewitDataImporterController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Data Importers');
            $content->description('Use Only CSV files');

            $content->row(function ($row) {
                $row->column(4, new Box('Import Contacts', $this->importForm('import/contacts')));
                $row->column(4, new Box('Import Activities', $this->importForm('import/activities')));
                $row->column(4, new Box('Import Academic Programs', $this->importForm('import/academic_programs')));
            });


        });
    }

    private function importForm($action)
    {
        $form = new FrontEndForm();
        $form->action($action);

        $form->file('csv', 'CSV file');

        return $form->render();

    }

    public function handleImport(Request $request)
    {
        //TODO
        dd($request->path());
        $file = $request->file('csv');
        $csvData = file_get_contents($file);
//        dd($csvData);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
//        dd($rows);
        $header = array_shift($rows);


        foreach ($rows as $row)
        {
            $row = array_combine($header, $row);

            //here we should figure a generic way to deal with
            // possible date format error.

            CewitContacts::updateOrCreate($row);
        }
    }


}
