<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartOneTaskOneRequest;
use App\Http\Requests\EducationLevelUpdateRequest;
use App\Http\Requests\PartOneTaskThreeRequest;
use App\Http\Requests\PartOneTaskTwoRequest;

class TaskController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @OA\Get(
     *      path="/api/tasks",
     *      operationId="tasks",
     *      tags={"tasks"},
     *      summary="get the count of 2 numbers",
     *      description="Returns EducationLevels data",
     *      @OA\Parameter(
     *         name="start_number",
     *         in="query",
     *         description="start",
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="end_number",
     *         in="query",
     *         description="end",
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/PartOne"),
     *     ),
     *      @OA\Response(
     *          response=422,
     *          description="validation Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */


    public function getCountOfTwoNumber(PartOneTaskOneRequest $request)
    {
        $validate = $request->validated();
        $count = $this->getCount($validate['start_number'], $validate['end_number']);
        return ['count' => $count];
    }

    private function getCount($start_number, $number_end)
    {
        $count = 0;
        while ($start_number <= $number_end) {
            //find if there is any 5 in numbers
            $x = explode('5', (string)$start_number, 2);
            if (count($x) != 1) {
                //skip all 50 , 150 , 250 and so on
                //if it's 50 or 150 will skip 10 or 100 or 1000 depend on number
                //else as 15 or 115 just skip 1
                $start_number = $x[1] != "" ? (int)($x[0] . (string)pow(10, strlen($x[1])) * 6)
                    : $start_number + 1;
                if($start_number > $number_end)
                    break;
            }
            $count = $count + 1;
            $start_number = (int)$start_number + 1;
        }
        return $count;
    }

    /**
     * @OA\Get(
     *      path="/api/tasks/alphabetics",
     *      operationId="tasks alphabetics",
     *      tags={"tasks"},
     *      summary="get the count of alphabetics",
     *      description="Returns data",
     *      @OA\Parameter(
     *         name="input_string",
     *         in="query",
     *         description="alpha",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/PartTwo"),
     *     ),
     *      @OA\Response(
     *          response=422,
     *          description="validation Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */


    public function getCountOfalphabetics(PartOneTaskTwoRequest $request)
    {
        $validate = $request->validated();
        $total = $this->alphabetics(strtoupper($validate['input_string']));
        return ['total' => $total];
    }

    private function alphabetics($alphabetics)
    {
        $map = ['A' => 1, 'B' => 2, 'C' => 3, 'D' => 4, 'E' => 5, 'F' => 6, 'G' => 7, 'H' => 8, 'I' => 9, 'J' => 10, 'K' => 11, 'L' => 12, 'M' => 13, 'N' => 14,
            'O' => 15, 'P' => 16, 'Q' => 17, 'R' => 18, 'S' => 19, 'T' => 20, 'U' => 21, 'V' => 22, 'W' => 23, 'X' => 24, 'Y' => 25, 'Z' => 26];
        $separted = str_split($alphabetics);
        $base = 1;
        $total = 0;
        foreach ($separted as $letter) {
            $total = $total + ($map[$letter] * pow(26, count($separted) - $base));
            ++$base;
        }
        return $total;
    }

    /**
     * @OA\Post(
     *      path="/api/tasks",
     *      operationId="tasks Part Three",
     *      tags={"tasks"},
     *      summary="get the count of 2 numbers",
     *      description="Returns EducationLevels data",
     *
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *              ref="#/components/schemas/PartOneTaskThree"
     *                 ),
     *    ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/PartThree"),
     *     ),
     *      @OA\Response(
     *          response=422,
     *          description="validation Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function getLetastSteps(PartOneTaskThreeRequest $request)
    {
        $validate = $request->validated();
        $arr_steps = $this->getAllFactors($validate['numbers']);
        return ['steps' => $arr_steps];
    }

    private function getAllFactors($arr_number)
    {
        $arr_steps = array_fill(0,count($arr_number),0);
        for($i=0;$i<count($arr_number);$i++){
            $greater_number = $arr_number[$i];
            $temp_arr=[];
            for($n=1;$n<=$greater_number;$n++){
                //out of the loop condition we get all steps for the number we are trying to get it to zero
                if($greater_number == 1){
                    $arr_steps[$i] =$arr_steps[$i]+ 1;
                    break;
                }
                $div=$greater_number/$n;
                // only one step without any factor No Factors Found
                //prime Number
                if($div == 1){
                    $greater_number=$greater_number - 1;
                    $arr_steps[$i] = $arr_steps[$i] + 1;
                    $temp_arr=[];
                    $n=0;
                }
                //the number is small and number power 2 = the greater number
                else if(is_int($div) && $div*$div==$greater_number){
                    $greater_number=$div;
                    $arr_steps[$i]=$arr_steps[$i] + 1 ;
                    $temp_arr=[];
                    $n=1;
                }
                //we have 2 new factors until w found that no more factor for greater number
                else if($greater_number != $div && is_int($div)){
                    if(in_array($div,$temp_arr)){
                        $greater_number=$temp_arr[1];
                        $arr_steps[$i]=$arr_steps[$i] + 1;
                        $n=1;
                        $temp_arr=[];
                        continue;
                    }
                    $temp_arr=[];
                    array_push($temp_arr,$n);
                    array_push($temp_arr,$div);
                }
            }
        }
        return $arr_steps;
    }
}
