<?php

namespace App\Admin\Controllers;

use App\Models\CewitAlums;
use App\Models\CewitContacts;

use Carbon\Carbon;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

class CewitAlumController extends Controller
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

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {

        return Admin::content(function (Content $content) {

            $content->header('Add a New Alumnus');
            $content->description('');

            $content->body($this->form());
        });
    }

    public function store(Request $request)
    {
        dump($request->all());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(CewitAlums::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(CewitContacts::class, function (Form $form) {


            $form->setAction('/admin/alumni/store');
            $form->tab('Basic Info', function ($form){


                $form->text('first_name', 'First Name');
                $form->text('last_name', 'Last Name');
                $form->text('middle_name', 'Middle Name');
                $form->select('gender', 'Gender')->options(config('contants.options_gender'));
                $form->text('country', 'Country');
                $form->text('state', 'State/Province');
                $form->text('city', 'City');
                $form->text('street', 'Street');

                $form->date('join_date', 'Join Date')
                    ->format('YYYY-MM-DD')
                    ->default(Carbon::now('America/New_York')->toDateString());

                $form->switch('is_active', 'Status')->states([
                    'on' => ['value' => 1, 'text' => 'active', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => 'inactive', 'color' => 'info'],
                ])->default('1');

                $form->hidden('is_affiliate')->value(1);
                $form->hidden('is_test')->value(0);
                $form->date('most_recent_iu_degree_year', 'Most Recent IU Degree Year');


            })->tab('Employer Info', function ($form){

                $form->text('organization_name', 'Employer');
                $form->text('organization_website', 'Employer Website');
                $form->text('organization_abbreviation', 'Employer Abbreviation')->placeholder('if applicable');


            })->tab('Job Info', function ($form){

                $form->text('job_title', 'Job Title');
                $form->select('job_type', 'Job Type')->options(config('contants.options_job_type'));


            });

            //alum info

            //employer info

            //employment info



            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
