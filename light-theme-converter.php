<?php
$files = array_merge(
    glob('resources/views/companies/*.blade.php'),
    glob('resources/views/employees/*.blade.php'),
    glob('resources/views/dashboard.blade.php')
);

$replacements = [
    'text-slate-100' => 'text-slate-900',
    'text-slate-200' => 'text-slate-800',
    'text-slate-300' => 'text-slate-700',
    'text-slate-400' => 'text-slate-600',
    'bg-slate-900/60' => 'bg-white',
    'bg-slate-900' => 'bg-white',
    'bg-slate-800/80' => 'bg-slate-50',
    'bg-slate-800/50' => 'bg-slate-50',
    'bg-slate-800' => 'bg-slate-50',
    'bg-slate-700' => 'bg-slate-200',
    'border-slate-700/50' => 'border-slate-200',
    'border-slate-700' => 'border-slate-200',
    'border-slate-600' => 'border-slate-300',
    'border-slate-500' => 'border-slate-400',
    'text-white' => 'text-black',
    'bg-indigo-600' => 'bg-black',
    'hover:bg-indigo-700' => 'hover:bg-slate-800',
    'hover:text-slate-200' => 'hover:text-slate-900',
    'text-indigo-400' => 'text-indigo-600',
    'hover:text-indigo-300' => 'hover:text-indigo-700',
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    foreach ($replacements as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    file_put_contents($file, $content);
}
echo "Converted " . count($files) . " files.\n";
