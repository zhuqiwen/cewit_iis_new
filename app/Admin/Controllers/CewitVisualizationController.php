<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Chart\Bar;
use Encore\Admin\Widgets\Chart\Doughnut;
use Encore\Admin\Widgets\Chart\Line;
use Encore\Admin\Widgets\Chart\Pie;
use Encore\Admin\Widgets\Chart\PolarArea;
use Encore\Admin\Widgets\Chart\Radar;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;

class CewitVisualizationController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Data Visualizations');
            $content->description('Description...');

//            $content->row(function ($row) {
//                $row->column(3, new InfoBox('New Users', 'users', 'aqua', '/admin/users', '1024'));
//                $row->column(3, new InfoBox('New Orders', 'shopping-cart', 'green', '/admin/orders', '150%'));
//                $row->column(3, new InfoBox('Articles', 'book', 'yellow', '/admin/articles', '2786'));
//                $row->column(3, new InfoBox('Documents', 'file', 'red', '/admin/files', '698726'));
//            });

            $content->row(function (Row $row) {

                $row->column(6, function (Column $column) {

//                    $tab = new Tab();

                    $pie = new Pie([
                        ['Freshman', 450], ['Sophomore', 650],
                        ['Junior', 250], ['Senior', 300],
                        ['Master', 400], ['Ph.D.', 200],
                        ['Faculty', 100], ['Staff', 100],
                        ['Alumni', 500]
                    ]);

                    $column->append(new Box('Distribution by Affiliate Types', $pie));

                    $collapse = new Collapse();

                    $bar = new Bar(
                        ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                        [
                            ['Students', [70,10,8,15,10,3,2]],
                            ['Faculty & Staff', [6,55,10,67,8,2,9]],
                            ['Alumni', [34,25,67,12,48,91,16]],
                        ]
                    );
                    $collapse->add('New Registration Per Month', $bar);
                    $column->append($collapse);

                    $doughnut = new Doughnut([
                        ['Chrome', 700],
                        ['IE', 500],
                        ['FireFox', 400],
                        ['Safari', 600],
                        ['Opera', 300],
                        ['Navigator', 100],
                    ]);
//                    $column->append((new Box('Doughnut', $doughnut))->removable()->collapsable()->style('info'));
                });

                $row->column(6, function (Column $column) {

//                    $column->append(new Box('Radar', new Radar()));
                    $column->append((new Box('Preference of Event Topics by Student Types', new Radar()))->collapsable());

                    $polarArea = new PolarArea([
                        ['Red', 300],
                        ['Blue', 450],
                        ['Green', 700],
                        ['Yellow', 280],
                        ['Black', 425],
                        ['Gray', 1000],
                    ]);
//                    $column->append((new Box('Polar Area', $polarArea))->removable()->collapsable());

//                    $column->append((new Box('New Registrations', new Line()))->removable()->collapsable()->style('danger'));
                    $column->append((new Box('New Registrations', new Line()))->collapsable()->style('danger'));
                });

            });

            $headers = ['Id', 'Email', 'Name', 'Company', 'Last Login', 'Status'];
            $rows = [
                [1, 'labore21@yahoo.com', 'Ms. Clotilde Gibson', 'Goodwin-Watsica', '1997-08-13 13:59:21', 'open'],
                [2, 'omnis.in@hotmail.com', 'Allie Kuhic', 'Murphy, Koepp and Morar', '1988-07-19 03:19:08', 'blocked'],
                [3, 'quia65@hotmail.com', 'Prof. Drew Heller', 'Kihn LLC', '1978-06-19 11:12:57', 'blocked'],
                [4, 'xet@yahoo.com', 'William Koss', 'Becker-Raynor', '1988-09-07 23:57:45', 'open'],
                [5, 'ipsa.aut@gmail.com', 'Ms. Antonietta Kozey Jr.', 'Braun Ltd', '2013-10-16 10:00:01', 'open'],
            ];

//            $content->row((new Box('Table', new Table($headers, $rows)))->style('info')->solid());
        });
    }

}
