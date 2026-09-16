<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TaskCatalog;

class TaskCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogs = TaskCatalog::orderBy('category')->orderBy('sequence')->paginate(20);
        return view('catalogs.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not used, modal inside index
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sequence' => 'nullable|integer|min:1',
            'code' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category' => 'required|in:mechanical,electrical,general',
        ]);

        TaskCatalog::create($validated);

        return redirect()->route('catalogs.index')->with('success', 'تم إضافة المهمة القياسية للكتالوج بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskCatalog $catalog)
    {
        $catalog->delete();
        return redirect()->route('catalogs.index')->with('success', 'تم حذف المهمة من الكتالوج بنجاح.');
    }

    public function downloadTemplate()
    {
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=task_catalogs_template.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = array('sequence', 'code', 'description', 'category');

        $callback = function() use($columns) {
            $file = fopen('php://output', 'w');
            
            // Add BOM to fix UTF-8 in Excel
            fputs($file, $bom =(chr(0xEF) . chr(0xBB) . chr(0xBF)));
            
            fputcsv($file, $columns);
            
            // Example row
            fputcsv($file, ['1', 'M-001', 'فحص سير المحرك', 'mechanical']);
            fputcsv($file, ['2', 'E-001', 'قياس شدة التيار', 'electrical']);
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048'
        ]);

        $file = $request->file('csv_file');
        
        $handle = fopen($file->path(), 'r');
        
        // Handle BOM (Byte Order Mark) for UTF-8
        $bom = fread($handle, 3);
        if ($bom != b"\xEF\xBB\xBF") {
            rewind($handle);
        }

        // Read and skip the header row
        $header = fgetcsv($handle); 

        $importedCount = 0;

        while (($row = fgetcsv($handle)) !== false) {
            // Check if row has data
            if (empty(array_filter($row))) {
                continue;
            }

            // Map data based on expected columns (sequence, code, description, category)
            $sequence = isset($row[0]) && is_numeric(trim($row[0])) ? trim($row[0]) : null;
            $code = isset($row[1]) ? trim($row[1]) : null;
            $description = isset($row[2]) ? trim($row[2]) : null;
            
            // Default category to mechanical if invalid or empty
            $categoryRaw = isset($row[3]) ? strtolower(trim($row[3])) : 'mechanical';
            $validCategories = ['mechanical', 'electrical', 'general'];
            $category = in_array($categoryRaw, $validCategories) ? $categoryRaw : 'mechanical';

            // Only insert if description exists
            if (!empty($description)) {
                TaskCatalog::create([
                    'sequence' => $sequence,
                    'code' => $code,
                    'description' => $description,
                    'category' => $category,
                ]);
                $importedCount++;
            }
        }

        fclose($handle);

        return redirect()->route('catalogs.index')->with('success', "تم استيراد $importedCount مهمة بنجاح!");
    }
}
