<?php

namespace App\Imports;

use App\Contracts\SheetErrorRepository;
use App\Imports\Sheets\ParticipantSheet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ParticipantsImport implements WithMultipleSheets, ShouldQueue, WithBatchInserts, WithChunkReading {

    use Queueable;

    private int $currentFile;
    private $currentSheet;
    private SheetErrorRepository $sheetErrorRepository;

    public function setFile($file, $sheet)
    {
        $this->currentFile = $file;
        $this->currentSheet = $sheet;
    }

    public function setRepositories(SheetErrorRepository $sheetErrorRepository)
    {
        $this->sheetErrorRepository = $sheetErrorRepository;
    }


    public function sheets(): array
    {
        $sheet = new ParticipantSheet();
        $sheet->setRepositories($this->sheetErrorRepository);
        $sheet->setFile($this->currentFile, $this->currentSheet);
        return [
            0 => $sheet
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }


    public function batchSize(): int
    {
        return 10;
    }
}

