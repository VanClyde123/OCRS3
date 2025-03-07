<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use App\Models\User;
use App\Models\Subject;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SummaryReportExport implements FromArray, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    protected $results;
    protected $filters;

    public function __construct($results, $filters)
    {
        $this->results = $results;
        $this->filters = $filters;
            
              //////fetch name 
                 if (!empty($this->filters['instructor'])) {
                    $instructor = User::find($this->filters['instructor']);
                    if ($instructor) {
                        
                        $middleInitial = $instructor->middle_name ? strtoupper(substr($instructor->middle_name, 0, 1)) . '.' : '';
                        $this->filters['instructor'] = "{$instructor->name} {$middleInitial} {$instructor->last_name}";
                    } else {
                        $this->filters['instructor'] = 'Unknown Instructor';
                    }
                }

                  //////fetch subject code - desc
                    if (!empty($this->filters['subject'])) {
                        $subject = Subject::find($this->filters['subject']);
                        if ($subject) {
                            $this->filters['subject'] = "{$subject->subject_code} - {$subject->description}";
                        } else {
                            $this->filters['subject'] = 'Unknown Subject';
                        }
                    }
    }

   
    public function headings(): array
    {
        $headers = [];
        
        ///////main header - selected filter
        $filterHeaders = [];
        if ($this->filters['schoolYear']) $filterHeaders[] = ['School Year: ' . $this->filters['schoolYear']];
        if ($this->filters['term']) $filterHeaders[] = ['Term: ' . $this->filters['term']];
        if ($this->filters['instructor']) $filterHeaders[] = ['Instructor: ' . $this->filters['instructor']];
        if ($this->filters['subject']) $filterHeaders[] = ['Subject: ' . $this->filters['subject']];
        if ($this->filters['section']) $filterHeaders[] = ['Section: ' . $this->filters['section']];
        if ($this->filters['program']) $filterHeaders[] = ['Program: ' . $this->filters['program']];
        
        $headers = array_merge($headers, $filterHeaders);
        $headers[] = ['']; 

       
        $columnHeaders = [];
        if (!$this->filters['term']) $columnHeaders[] = 'Term';
        if (!$this->filters['instructor']) $columnHeaders[] = 'Instructor';
        $columnHeaders[] = 'Subject';
        if ($this->filters['section']) $columnHeaders[] = 'Section';
        if ($this->filters['program']) $columnHeaders[] = 'Program';
        $columnHeaders = array_merge($columnHeaders, [
            'Total Enrolled',
            'Passed %',
            'Failed %',
            'Dropped %',
            'INC + NFE %',
            'Other %'
        ]);
        
        $headers[] = $columnHeaders;
        return $headers;
    }

   
    public function array(): array
    {
        $data = [];

        if ($this->filters['program']) {
            foreach ($this->results['programTotals'] as $totals) {
                $row = [];
                if (!$this->filters['term']) $row[] = '';
                if (!$this->filters['instructor']) $row[] = '';
                $row[] = $totals['subject']; 
                $row[] = $totals['section']; 
                $row[] = $this->filters['program']; 
                $row[] = $totals['total_students'];
                $row[] = $totals['passed_percentage'] . '%';
                $row[] = $totals['failed_percentage'] . '%';
                $row[] = $totals['dropped_percentage'] . '%';
                $row[] = $totals['inc_nfe_percentage'] . '%';
                $row[] = $totals['others_percentage'] . '%';
                $data[] = $row;
            }
        } else {
            if ($this->filters['section']) {
                foreach ($this->results['results'] as $record) {
                    $row = [];
                    if (!$this->filters['term']) $row[] = $record->subject->term;
                    if (!$this->filters['instructor']) $row[] = $record->instructor->name;
                    $row[] = $record->subject->subject_code;
                    $row[] = $record->subject->section;
                    $row[] = $record->enrolled_students_count;
                    $row[] = $record->passed_percentage . '%';
                    $row[] = $record->failed_percentage . '%';
                    $row[] = $record->dropped_percentage . '%';
                    $row[] = $record->inc_nfe_percentage . '%';
                    $row[] = $record->others_percentage . '%';
                    $data[] = $row;
                }
            } else {
                    foreach ($this->results['groupedResults'] as $group) {
                        $row = [];
                        if (!$this->filters['term']) $row[] = $group['term'];
                        if (!$this->filters['instructor']) $row[] = $group['instructor'];
                        $row[] = $group['subject'];
                        $row[] = $group['total_students'];
                        $row[] = $group['passed_percentage'] . '%';
                        $row[] = $group['failed_percentage'] . '%';
                        $row[] = $group['dropped_percentage'] . '%';
                        $row[] = $group['inc_nfe_percentage'] . '%';
                        $row[] = $group['others_percentage'] . '%';
                        $data[] = $row;
                    }



                }



        }

        return $data;
    }

   
    public function title(): string
    {
        return 'Summary Report';
    }

   
    public function styles(Worksheet $sheet)
    {
         ///////check for selected school year, no slected, no styling applied
            if (!isset($this->filters['schoolYear']) || empty($this->filters['schoolYear'])) {
                return; 
            }

                $rowIndex = 1; 


                $filterRowCount = count($this->headings()) - 2; 

   
            for ($i = 1; $i <= $filterRowCount; $i++) {
                $sheet->mergeCells("A{$i}:J{$i}"); // Adjust range based on columns in your report
                     $sheet->getStyle("A{$i}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            }

   
    $sheet->getStyle("A1:A{$filterRowCount}")->getFont()->setBold(true);

    //////space betwwen main header and colum nheader
    $headerRow = $filterRowCount + 2;

    //////styles for column header and results data
    $sheet->getStyle("A{$headerRow}:J{$headerRow}")->applyFromArray([
        'font' => ['bold' => true],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_LEFT,
            'vertical' => Alignment::VERTICAL_CENTER
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
        ],
        'borders' => [
            'bottom' => ['borderStyle' => Border::BORDER_THIN],
            'top' => ['borderStyle' => Border::BORDER_THIN],
        ]
    ]);

   
    $sheet->getColumnDimension('A')->setWidth(25); 
    }
}
