<?php
namespace App\Http\Functions;

use App\Models\CustomField;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Schema;

class CheckField
{
    public static function check_fields($req, $name)
    {
        $columns['fields'] = Schema::getColumnListing($name);
        $f = rtrim($req['fields'], ',');

        $field = explode(',', $req['fields']);

        $temp = [];
        $message = '';
        foreach ($field as $key => $value) {
            if (!in_array($value, $temp)) {
                $temp[] = $value;
                $check_array = in_array($value, $columns['fields']);
                if (!$check_array) {
                    $message .= ''.$value.' can not be found,';
                } else {
                    $message = '';
                }
            }
            if ($message != '') {
                $message2 = $message;
            }
        }
        if (isset($message2)) {
            return $message2;
        }
    }

    public static function check_order($req, $name)
    {
        $columns['fields'] = Schema::getColumnListing($name);
        $order_by = explode(',', $req['order_by']);
        $message = '';
        $temp = [];
        foreach ($order_by as $key => $value) {
            $c = explode(':', $value);
            $by = $c[0];
            $order = $c[1];

            if (!in_array($by, $temp)) {
                $temp[] = $by;
                $check_array = in_array($by, $columns['fields']);
                if (!$check_array) {
                    $message .= 'Order by column ' . $by . ' can not be found.';
                } else {
                    $message = '';
                }
            }
            if ($message != '') {
                $message2 = $message;
            }

        }
        if (isset($message2)) {
            return $message2;
        }
    }

    public static function CheckSearch($req, $name)
    {
        $columns['fields'] = Schema::getColumnListing($name);
        $search = explode(',', $req['search']);
        $message = '';
        foreach ($search as $value) {
            if (strpos($value, '<=>') !== false) {
                $key_search = explode('<=>', $value);
                $check_array = in_array($key_search[0], $columns['fields']);
                if (!$check_array) {
                    $message .= 'Search ' . $key_search[0] . ' can not be found.';
                } else {
                    $message = '';
                }
                if ($message != '') {
                    $message2 = $message;
                }
            } else if (strpos($value, '<like>') !== false) {
                $key_search = explode('<like>', $value);

                $check_array = in_array($key_search[0], $columns['fields']);

                if (!$check_array) {
                    $message .= 'Search  ' . $key_search[0] . ' can not be found.';
                } else {
                    $message = '';
                }
                if ($message != '') {
                    $message2 = $message;
                }
            } else if (strpos($value, '<>') !== false) {
                $key_search = explode('<>', $value);
                $check_array = in_array($key_search[0], $columns['fields']);
                if (!$check_array) {
                    $message .= 'Search  ' . $key_search[0] . ' can not be found.';
                } else {
                    $message = '';
                }
                if ($message != '') {
                    $message2 = $message;
                }
            }
        }
        if (isset($message2)) {
            return $message2;
        } else {
            $key_search[1] = '%' . $key_search[1] . '%';
        }
    }

    public static function CheckSearchOr($req, $name)
    {
        $columns['fields'] = Schema::getColumnListing($name);
        $search = explode(',', $req['search_or']);
        $message = '';
        foreach ($search as $value) {
            if (strpos($value, '<=>') !== false) {
                $key_search = explode('<=>', $value);
                $check_array = in_array($key_search[0], $columns['fields']);
                if (!$check_array) {
                    $message .= 'Search_or  ' . $key_search[0] . ' can not be found.';
                } else {
                    $message = '';
                }
                if ($message != '') {
                    $message2 = $message;
                }
            } else if (strpos($value, '<like>') !== false) {
                $key_search = explode('<like>', $value);
                $check_array = in_array($key_search[0], $columns['fields']);
                if (!$check_array) {
                    $message .= 'Search_or ' . $key_search[0] . ' can not be found.';
                } else {
                    $message = '';
                }
                if ($message != '') {
                    $message2 = $message;
                }
            } else if (strpos($value, '<>') !== false) {
                $key_search = explode('<>', $value);
                $check_array = in_array($key_search[0], $columns['fields']);
                if (!$check_array) {
                    $message .= 'Search_or ' . $key_search[0] . ' can not be found.';
                } else {
                    $message = '';
                }
                if ($message != '') {
                    $message2 = $message;
                }
            }
        }
        if (isset($message2)) {
            return $message2;
        } else {
            $key_search[1] = '%' . $key_search[1] . '%';
        }
    }

    public static function CheckDate($req, $name)
    {
        if (strpos($req['date'], '-') !== false) {
            $message = '';
            $columns['fields'] = ['day', 'month', 'week'];
            $date = explode('-', $req['date']);
            $check_array = in_array($date[1], $columns['fields']);
            $startDate = time();
            $endDate = strtotime(date('d-m-y H:i.s', strtotime('- ' . $date[0] . ' ' . $date[1] . '')));
            $tmp_end = strtotime(date('Y-m-d', strtotime("-3 month")) . " 00:00:00");
            if (!$check_array) {
                $message .= 'Invalid ' . $date[1] . ' can only use day,week,month,year.';
            }
            if (strtotime('- ' . $date[0] . ' ' . $date[1] . '') < $tmp_end) {
                $message .= 'the day start should not bigger than 3 month.';
            }
        } elseif (strpos($req['date'], '<=>') !== false) {
            $message = '';
            $date = explode('<=>', $req['date']);
            $dateStart = strtotime(Carbon::createFromFormat('d/m/Y', $date[0])->format('d-m-Y'));
            $dateEnd = strtotime(Carbon::createFromFormat('d/m/Y', $date[1])->format('d-m-Y'));
            $message = '';
            $tmp_end = strtotime(date('Y-m-d', strtotime("-3 month")) . " 00:00:00");
            if ($dateStart > $dateEnd) {
                $message .= 'the day start should not bigger than day end.';
            }
            if ($dateStart < $tmp_end) {
                $message .= 'the day start should not bigger than 3 month.';
            }
            if ($dateStart < 0) {
                $message .= 'the day start is invalid.';
            }
            if ($dateEnd < 0) {
                $message .= 'the day end is invalid.';
            }
        } elseif (strpos($req['date'], ':') !== false) {
            $message = '';
            $date = explode(':', $req['date']);
            $columns['type'] = ['this', 'last'];
            $columns['date'] = ['day', 'month'];
            if (!in_array($date[0], $columns['type'])) {
                $message = 'undefine type,type availible ' . implode(',', $columns['type']) . '';
            } elseif (!in_array($date[1], $columns['date'])) {
                $message = 'undefine date,date availible ' . implode(',', $columns['date']) . '';
            }
        }

        if ($message != '') {
            $message2 = $message;
        }

        if (isset($message2)) {
            return $message2;
        }
    }

    public static function CheckUpdateDate($req, $name)
    {
        $date = explode('<:>', $req['dateupdate']);

        if (strpos($date[1], '-') !== false) {
            $message = '';
            $columns['fields'] = ['day', 'month', 'week'];
            $date = explode('-', $date[1]);
            $check_array = in_array($date[1], $columns['fields']);
            $startDate = time();
            $endDate = strtotime(date('d-m-y H:i.s', strtotime('- ' . $date[0] . ' ' . $date[1] . '')));
            $timeTmp2 = strtotime("-3 month");
            $tmp_start = strtotime('- ' . $date[0] . ' ' . $date[1] . '');
            $tmp_end = strtotime(date('Y-m-d', $timeTmp2) . " 00:00:00");
            if (!$check_array) {
                $message .= 'Invalid ' . $date[1] . ' can only use day,week,month,year.';
            }
            if ($tmp_start < $tmp_end) {
                $message .= 'the day start should not bigger than 3 month.';
            }
        } elseif (strpos($date[1], '<=>') !== false) {
            $message = '';
            $date = explode('<=>', $date[1]);
            $dateStart = strtotime(Carbon::createFromFormat('d/m/Y', $date[0])->format('d-m-Y'));
            $dateEnd = strtotime(Carbon::createFromFormat('d/m/Y', $date[1])->format('d-m-Y'));
            $timeTmp2 = strtotime("-3 month");
            $tmp_end = strtotime(date('Y-m-d', $timeTmp2) . " 00:00:00");
            if ($dateStart < $tmp_end) {
                $message .= 'the day start should not bigger than 3 month.';
            }
            if ($dateStart < 0) {
                $message .= 'the day start is invalid.';
            }
            if ($dateEnd < 0) {
                $message .= 'the day end is invalid.';
            }
        } elseif (strpos($date[1], ':') !== false) {
            $message = '';
            $date = explode(':', $date[1]);
            $columns['type'] = ['this', 'last'];
            $columns['date'] = ['day', 'month'];
            if (!in_array($date[0], $columns['type'])) {
                $message = 'undefine type,type availible ' . implode(',', $columns['type']) . '';
            } elseif (!in_array($date[1], $columns['date'])) {
                $message = 'undefine date,date availible ' . implode(',', $columns['date']) . '';
            }
        }

        if ($message != '') {
            $message2 = $message;
        }

        if (isset($message2)) {
            return $message2;
        }
    }

    public static function CheckDateNumber($req)
    {

        if (strpos($req['datetime'], '-') !== false) {
            $message = '';
            $columns['fields'] = ['day', 'month', 'week', 'year'];
            $date = explode('-', $req['datetime']);
            $check_array = in_array($date[1], $columns['fields']);
            $startDate = time();
            $endDate = strtotime(date('d-m-y H:i.s', strtotime('- ' . $date[0] . ' ' . $date[1] . '')));
            if (!$check_array) {
                $message .= 'Invalid ' . $date[1] . ' can only use day,week,month,year.';
            }
        } elseif (strpos($req['datetime'], '<=>') !== false) {
            $message = '';
            $date = explode('<=>', $req['datetime']);
            $dateStart = strtotime(Carbon::createFromFormat('d/m/Y', $date[0])->format('d-m-Y'));
            $dateEnd = strtotime(Carbon::createFromFormat('d/m/Y', $date[1])->format('d-m-Y'));
            $message = '';
            if ($dateStart > $dateEnd) {
                $message .= 'the day start should not bigger than day end.';
            }
            if ($dateStart < 0) {
                $message .= 'the day start is invalid.';
            }
            if ($dateEnd < 0) {
                $message .= 'the day end is invalid.';
            }
        }

        if ($message != '') {
            $message2 = $message;
        }

        if (isset($message2)) {
            return $message2;
        }
    }

    public static function check_chat_field($req)
    {
        //check column exits
        if (array_key_exists('fields', $req) && rtrim($req['fields']) != '') {
            $columns['table'] = ['social_message', 'table_users'];
            $columns['fields'] = array_merge(Schema::getColumnListing('social_message'), Schema::getColumnListing('table_users'));
            $order_by = explode(',', $req['fields']);
            $message = '';
            $temp = [];
            foreach ($order_by as $key => $value) {
                $c = explode('.', $value);
                $by = $c[0];
                $order = $c[1];

                if (!in_array($by, $temp)) {
                    $temp[] = $by;
                    $check_array2 = in_array($by, $columns['table']);
                    if (!$check_array2) {
                        $message .= 'Order by table ' . $by . ' can not be found.';
                    }
                    if (!in_array($order, $columns['fields'])) {
                        $message .= 'Order by columms ' . $order . ' can not be found.';
                    }
                }
                if ($message != '') {
                    $message2 = $message;
                }
            }
            foreach ($order_by as $key => $value) {
                $c = explode('.', $value);
                $by = $c[0];
                $order = $c[1];
                if (!in_array($order, $columns['fields'])) {

                    $message .= 'Order by columms ' . $order . ' can not be found.';
                }
                if ($message != '') {
                    $message2 = $message;
                }
            }
            if (isset($message2)) {
                return $message2;
            }

        }
    }
    public static function check_exist_of_value($req, $name)
    {
        $message = '';
        $search = explode(',', $req['search']);
        foreach ($search as $value) {
            if (strpos($value, '<=>') !== false) {
                $key_search = explode('<=>', $value);
                $check_exits = DB::table($name)->where($key_search[0], '=', $key_search[1])->first();
                if (!isset($check_exits)) {
                    $message .= $key_search[1] . ' not found.';
                } else {
                    $message = '';
                }

            } else if (strpos($value, '<like>') !== false) {
                $key_search = explode('<like>', $value);
                $check_exits = DB::table($name)->where($key_search[0], 'like', '%' . $key_search[1] . '%')->first();
                if ($check_exits == null) {
                    $message .= $key_search[1] . ' not found.';
                } else {
                    $message = '';
                }
            } else if (strpos($value, '<>') !== false) {
                $key_search = explode('<like>', $value);
                $check_exits = DB::table($name)->where($key_search[0], 'like', '%' . $key_search[1] . '%')->first();
                if ($check_exits == null) {
                    $message .= $key_search[1] . ' not found.';
                } else {
                    $message = '';
                }

            }
        }
        if (isset($message)) {
            return $message;
        }
    }
    public static function check_subfields($req, $fields)
    {
        $message = '';
        $fieldValue = explode(',', $req['sub_field']);
        foreach ($fieldValue as $value) {
            $field = explode(':', $value);
            $check_array = in_array($field[1], $fields);
            if (!$check_array) {
                $message = 'Undefine ' . $field[1] . ' sub field there are only availible ' . implode(',', $fields);
            }
        }
        if (isset($message)) {
            return $message;
        }
    }
    public static function check_contact_custom_fields($req)
    {
        $message = '';
        $search = explode(',', $req['custom_fields_search']);
        foreach ($search as $value) {
            if (strpos($value, ':') !== false) {
                $key_search = explode(':', $value);
                $custom_field = CustomField::where('id', $key_search[0])->first();
                if (!$custom_field) {
                    $message .= 'Undefined custom_field with id ' . $key_search[0] . ' ';
                } else {
                    if ($custom_field->field_type == 'select') {
                        if (!in_array($key_search[1], json_decode($custom_field->value))) {
                            $message .= 'Unknow value ' . $key_search[1] . ' in select custom Field with id ' . $key_search[0] . ' There only ' . implode(',', json_decode($custom_field->value)) . '';
                        }
                    }
                }

            } else {
                $message .= 'the between paramenters must be : ';
            }
        }
        if (isset($message)) {
            return $message;
        }
    }
}