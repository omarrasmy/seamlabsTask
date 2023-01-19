<?php

namespace App\Imports\Sheets;

use App\Contracts\SheetErrorRepository;
use App\Models\EducationLevel;
use App\Models\Intervention;
use App\Models\Organization;
use App\Models\Participant;
use App\Models\Program;
use App\Models\Project;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ParticipantSheet implements ToModel, WithStartRow
{

    use Importable;
    use RemembersRowNumber;
    use RemembersChunkOffset;

    private int $currentFile;
    private $currentSheet;
    private SheetErrorRepository $sheetErrorRepository;


    public function __construct()
    {
    }

    public function setFile($file, $sheet)
    {
        $this->currentFile = $file;
        $this->currentSheet = $sheet;
    }

    public function setRepositories(SheetErrorRepository $sheetErrorRepository)
    {
        $this->sheetErrorRepository = $sheetErrorRepository;
    }

    public function model(array $row)
    {
        error_log('start parsing model '.now());
        $rowNumber = $this->getRowNumber();
        $chunk = $this->chunkOffset ?? 'N/A';
        $errors = [];
        error_log('got row number '.now());
        try {
            // organization
            $organization = $this->currentSheet['organization'];

            // program
            $project = $this->currentSheet['project'];

            // education level
            error_log('getting education '.now());
            $education = $row[13] ?? null;
            if ($education) {
                $education = EducationLevel::name($row[13])->get();
                if ($education->count() === 0) {
                    $error = [
                        'sheet_id' => $this->currentSheet['id'],
                        'column_number' => '16|Q',
                        'chunk_offset' => $chunk,
                        'cell_number' => $rowNumber,
                        'message' => 'Education level not exists, please seed data first then load file'
                    ];
                    $errors = array_merge($errors, [$error]);

                } else {
                    $education = $education[0]['id'];
                }
            }
            error_log('got row number '.now());


            if (count($errors) > 0) {
                return $this->sheetErrorRepository->createMany($errors);
            }
            // handling phone
            $phone = $row[8] ? $row[8] : ($row[9] ? $row[9] : 'N/A');

            // handling address
            $address = $row[10] ?? 'N/A';

            // handling gender
            $gender = $row[7] === "أنثى" ? "female" : "male";

            // age handling
            $age = $row[14] ?? -1;

            // handle city
            $city = $row[15] ?? 'N/A';

            $date = Date::excelToDateTimeObject($row[2]);
            error_log('parsed date '.now());
            $participant = [
                'organization' => $organization,
                'name' => $row[6],
                'gender' => $gender,
                'age' => $age,
                'project' => $project,
                'country' => $row[3],
                'city' => $city,
                'education' => $education,
                'national_id' => $row[12],
                'phone' => $phone,
                'nationality' => $row[11],
                'passport_number' => $row[0],
                'training_center' => $row[4],
                'training_name' => $row[5],
                'training_date' => $date
            ];
            error_log('ready to save participant '.now());
            return new Participant($participant); // cannot use repository here
        } catch (\Throwable|\Exception $e) {
            // save error
            $error = [
                'sheet_id' => $this->currentSheet['id'],
                'column_number' => 'N/A',
                'chunk_offset' => $chunk,
                'cell_number' => $rowNumber,
                'message' => $e->getMessage()
            ];
            return $this->sheetErrorRepository->create($error);
        }
    }


//    public function mapping(): array
//    {
//        return [
//            'participant_code' => 'A2', // 0
//            'age_type' => 'B2', // 1
//            'training_date' => 'C2', // 2
//            'country' => 'D2', // 3
//            'sector' => 'E2', //4
//            'trainer' => 'F2', // 5
//            'participant_name' => 'G2', // 6
//            'participant_gender' => 'H2', // 7
//            'phone_number' => 'I2', // 8
//            'mobile_number' => 'J2', // 9
//            'address' => 'K2',// 10
//            'nationality' => 'L2', // 11
//            'national_id' => 'M2', // 12
//            'education' => 'Q2', // 13
//            'age' => 'R2', // 14
//            'city' => 'S2' // 15
//        ];
//    }


    public function startRow(): int
    {
        return 2;
    }

}


