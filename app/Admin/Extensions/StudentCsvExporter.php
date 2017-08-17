<?php
/**
 * Created by PhpStorm.
 * User: zqw
 * Date: 8/16/17
 * Time: 10:58 PM
 */

namespace App\Admin\Extensions;

use App\Models\CewitContacts;
use App\Models\CewitEmails;
use App\Models\CewitStudents;
use Encore\Admin\Grid\Exporters\AbstractExporter;
use function MongoDB\BSON\toJSON;

class StudentCsvExporter extends AbstractExporter
{
    /**
     * {@inheritdoc}
     */
    public function export()
    {
        $titles = [];
        $filename = $this->getTable() . '.csv';


        // make data,
        $data_array = [];
        $data = CewitStudents::all();

        foreach ($data as $item)
        {

            $item['contact_first_name'] = $item->contact()->first()->first_name;
            $programs = $item->academicPrograms()->get();
            if($programs->isNotEmpty())
            {
                $academic_program = $programs->where('is_stem', 1);


                if($academic_program->isNotEmpty())
                {
                    $item['is_stem'] = 'Yes';
                    $item['program'] = $academic_program->name;
                }
                else
                {
                    $item['is_stem'] = 'No';
                    $item['program'] = $programs->where('is_stem', 0)->name;
                }

            }
            else
            {
                $item['is_stem'] = 'None';
                $item['program'] = 'None';
            }

            $contact_id = $item->contact()->first()->id;
            $email = CewitEmails::where('contact_id', $contact_id)
                ->where('is_primary', 1)
                ->first();
            if($email)
            {
                $item['email'] = $email->email;
            }
            else
            {
                $item['email'] = 'No primary email';
            }

            $data_array[] = $item->toArray();


        }








        if (!empty($data_array)) {
            $columns = array_dot($this->sanitize($data_array[0]));
            $titles = array_keys($columns);
        }
        $output = self::putcsv($titles);
        foreach ($data_array as $row) {
            $row = array_only($row, $titles);

            $output .= self::putcsv(array_dot($row));
        }
        $headers = [
            'Content-Encoding' => 'UTF-8',
            'Content-Type' => 'text/csv;charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
        response(rtrim($output, "\n"), 200, $headers)->send();
        exit;
    }
    /**
     * Remove indexed array.
     *
     * @param array $row
     *
     * @return array
     */
    protected function sanitize(array $row)
    {
        return collect($row)->reject(function ($val) {
            return is_array($val) && !Arr::isAssoc($val);
        })->toArray();
    }
    /**
     * @param $row
     * @param string $fd
     * @param string $quot
     * @return string
     */
    protected static function putcsv($row, $fd = ',', $quot = '"')
    {
        $str = '';
        foreach ($row as $cell) {
            $cell = str_replace([$quot, "\n"], [$quot . $quot, ''], $cell);
            if (strchr($cell, $fd) !== FALSE || strchr($cell, $quot) !== FALSE) {
                $str .= $quot . $cell . $quot . $fd;
            } else {
                $str .= $cell . $fd;
            }
        }
        return substr($str, 0, -1) . "\n";
    }

}