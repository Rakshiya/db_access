<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TablesController extends Controller
{
    /**
     * Display all tables from database.
     */
    public function showTables(Request $request)
    {
        $tables = DB::select('SHOW TABLES');
        $tablesObj = array();
        foreach($tables as $table)
        {
            array_push($tablesObj, $table->Tables_in_mfsn_reporting);
        }
        return view('tables.showTables', [
            'tableList' => $tablesObj,
        ]);
    }
    /**
     * Display single tables for query operation
     */
    public function view(Request $request,$tableName)
    {
        $table=base64_decode($tableName);
        
        $coulumns = DB::select("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table'");
        $columnArr = array();
        foreach($coulumns as $val){
            if(!in_array($val->COLUMN_NAME, $columnArr))
                array_push($columnArr, $val->COLUMN_NAME);
        }
        return view('tables.viewTable',[
            'tableName' => $tableName,
            'columnArray' => $columnArr
        ]);
    }


    public function getRecords(Request $request)
    {
        $query = $request->input('query');
        try {
            $records = DB::select($query);
            return response()->json(['records' => $records]);
        } catch (\Exception $e) {
            // Handle any exceptions, and return an error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
