<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\CustomCsvExporter;
use App\Admin\Extensions\StudentCsvExporter;
use App\Models\CewitContacts;
use App\Models\CewitEmails;
use App\Models\CewitEnrollments;
use App\Models\CewitStudents;

use Carbon\Carbon;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;


class CewitStudentController extends Controller
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

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }


    /**
     * Store interface
     * @param Request $request
     */
    public function store(Request $request)
    {
        $contact = CewitContacts::create($request->all());
        $student = CewitStudents::create([
            'contact_id' => $contact->id,
            'current_year_of_school' => $request->current_year_of_school,
        ]);

        dump($contact);
        dump($student);

    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(CewitStudents::class, function (Grid $grid) {


            $grid->id('ID')->sortable();
            $grid->column('first name')->display(function(){
                return CewitContacts::find($this->contact_id)->first_name;
            });

            $grid->column('last name')->display(function(){
                return CewitContacts::find($this->contact_id)->last_name;
            });


            $grid->column('Study')->display(function(){
                $enrollment = CewitEnrollments::where('student_id',$this->id)
                    ->first();
                if($enrollment)
                {
                    return $enrollment->academicProgram()
                        ->name;
                }
                else
                {
                    return 'Unknown';
                }

            });

            $grid->column('Stem major?')->display(function(){
                $enrollment = CewitEnrollments::where('student_id',$this->id)
                    ->first();

                if($enrollment)
                {
                    return $enrollment->academicProgram()
                        ->is_stem == 1 ? 'Yes' : 'No';
                }
                else
                {
                    return 'Unknown';
                }

            });

            $grid->column('email')->display(function(){
                return CewitEmails::where('contact_id', $this->contact_id)
                    ->where('is_primary', 1)
                    ->first()
                    ->email;
            });


            $grid->created_at();
            $grid->updated_at();

            $grid->exporter(new StudentCsvExporter());
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

            $form->display('id', 'ID');


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

            $form->select('is_active', 'Status')->options([
                1 => 'active',
                0 => 'inactive',
            ])->default(1);

            $form->hidden('is_affiliate')->value(1);
            $form->hidden('is_test')->value(0);

            $form->select('current_year_of_school', 'Current Year Of School')
                ->options(config('contants.options_year_of_school'));

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
