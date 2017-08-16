<?php

namespace App\Admin\Controllers;


use App\Models\CewitContacts;
use Carbon\Carbon;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

class CewitAffiliateController extends Controller
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

            $content->header('CEWiT Affiliates Index');
            $content->description('');

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

            $content->header('Update Affiliate Information');
            $content->description('');

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

            $content->header('New Affiliate');
            $content->description('');

            $content->body($this->form());
        });
    }


    public function store(Request $request)
    {
        $contact = CewitContacts::create($request->all());
        dump($contact);
//        dump($request->all());
        exit();
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $user = Admin::user();
        return Admin::grid(CewitContacts::class, function (Grid $grid) use ($user){

            $grid->model()
                ->where('deleted_at', null)
                ->where('is_active', 1)
                ->where('is_affiliate', 1);

            $grid->id('ID')->sortable();
            $grid->first_name('First Name')->sortable();
            $grid->last_name('Last Name')->sortable();
            $grid->gender('Gender')->sortable();
            $grid->iuid('IUID')->sortable();
            $grid->email('Email');
            $grid->join_date('Join Date')->sortable();
            // don't use sortable() on virtual attributes
            $grid->affiliate_type('Affiliate Type');

            if(!$user->isRole('cewit_admin') && !$user->isRole('affiliate_admin'))
            {
                $grid->disableCreation();
                $grid->disableActions();
                $grid->disableRowSelector();
            }

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

            $form->select('affiliate_type', 'Affiliate Type')->options(config('contants.options_affiliate_type'));

            $form->hidden('is_affiliate')->value(1);
            $form->hidden('is_test')->value(0);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
