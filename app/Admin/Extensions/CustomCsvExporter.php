<?php
/**
 * Created by PhpStorm.
 * User: zqw
 * Date: 8/16/17
 * Time: 10:58 PM
 */

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\AbstractExporter;

class CustomCsvExporter extends AbstractExporter
{
    /**
     * {@inheritdoc}
     */
    public function export()
    {
        $titles = [];
        $filename = $this->getTable() . '.csv';

        $data = $this->getData();
        if (!empty($data)) {
            $columns = array_dot($this->sanitize($data[0]));
            $titles = array_keys($columns);
        }
        $output = self::putcsv($titles);
        foreach ($data as $row) {
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