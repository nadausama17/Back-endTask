<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProblemSolvingController extends Controller
{
    public function getNumsCount($startNum, $endNum){
        $count = 0;

        for($i = $startNum; $i <= $endNum; $i++){
            $stringNum = strval($i);

            if(!str_contains($stringNum,'5'))
                $count++;
        }

        $response = [
            'result' => $count,
        ];

        return response($response);
    }

    public function getStringIndex($input_string){
        define('ALPHABET_COUNT', 26);
        define('ASCII_CODE_START', 65);
        $alphabet = [];

        //generate the alphabet from their ascii code from A to Z
        for($i = 0; $i < ALPHABET_COUNT; $i++){
            $alphabet[chr($i+ASCII_CODE_START)] = $i+1;
        }
        
        $result = 0;
        $inputSize =  strlen($input_string);
        for($i = 0; $i < $inputSize; $i++){
            if(isset($alphabet[$input_string[$i]])){
                $result += ($alphabet[$input_string[$i]] * pow(ALPHABET_COUNT,$inputSize-$i-1));
            }else{
                $response = ['message' => 'please enter only capital English letters'];
                return response($response,422);
            }
        }

        $response = [
            'OUTPUT' => $result,
        ];

        return response($response);
    }

    public function getReducedNumSteps(Request $request){
        $inputs = $request->validate([
            'N' => 'required|numeric|min:1',
            'Q' => 'required',
        ]);

        if($inputs['N'] > count($inputs['Q']))
            return response(['message' => 'the size entered is bigger than arr length'],422); 

        $result = [];

        for($i = 0; $i < $inputs['N']; $i++){
            $num = $inputs['Q'][$i];
            $temp = $num - 1;
            $steps = 0;

            while($temp > 1){
                if($num % $temp == 0){
                    $num = $temp;
                    $steps++;
                }
                $temp--;
            }

            $steps+= $num;
            $result[] = $steps;
        }
        
        return response($result);
    }
}
