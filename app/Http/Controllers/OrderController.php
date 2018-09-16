<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class OrderController extends Controller
{
    /**
     * Calculate Taco Tuesday's line time
     *
     * @param array $customers  Array of customers in line with serve times ordered via index
     * @param int   $registers  Number of cash registers
     *
     * @example $lineTime = $this->lineTime($customers, $registers);
     *
     * @return int || null      Time required to take order
     */
    public function lineTime($customers= [], $registers = null)
    {
        if (!is_array($customers) || empty($customers) || !is_int($registers)) {
            return null;
        }

        // Processs the line times
        if ($registers == 1) {
            // Single Register line time
            $lineTime = array_sum($customers) / $registers;
        } else {
            // Multiple Registers
            // Create the registers
            $registersTimes = [];
            for ($x = 1; $x <= $registers; $x++) {
                $registersTimes[] = 0;
            }

            $currentRegister = 0;

            // Assign lines to registers
            foreach ($customers as $index => $time) {

                // switch back the registers
                if ($currentRegister == ($registers)) {
                    $currentRegister = 0;
                }

                // load the register with current time
                // check for current registers time and if then continue to add to the next
                // register until the time has added up to what you are adding the next register
                if ($registersTimes[$currentRegister] == 0) {
                    $registersTimes[$currentRegister] =  $registersTimes[$currentRegister] + $time;
                } elseif($currentRegister == ($registers - 1)) {
                    $registersTimes[$currentRegister - 1] =  $registersTimes[$currentRegister - 1] + $time;
                } elseif($registersTimes[$currentRegister] >= $registersTimes[$currentRegister + 1]){
                    $registersTimes[$currentRegister + 1] =  $registersTimes[$currentRegister + 1] + $time;
                } elseif($registersTimes[$currentRegister] < $registersTimes[$currentRegister + 1]){
                    $registersTimes[$currentRegister] =  $registersTimes[$currentRegister] + $time;
                } elseif($currentRegister == ($registers - 1)) {
                    $currentRegister = 0;
                    $registersTimes[$currentRegister] =  $registersTimes[$currentRegister] + $time;
                } else {
                    $currentRegister = $currentRegister + 1;
                    $registersTimes[$currentRegister] =  $registersTimes[$currentRegister] + $time;
                }
            }

            // Compare register times -- return largest line time
            $lineTime = max($registersTimes);
        }

        return $lineTime;
    }

    /**
     * Retreive the line times for taco time
     *
     * @param \Illuminate\Http\Request  $request    The request
     * @param array                     $customers  The customer times in array, first come first serve
     * @param integer                   $registers  The registers open
     *
     * @return \Illuminate\Http\Response
     */
    public function getlineTimes(Request $request)
    {
        $rules = [
            'registers' => 'required|integer',
            'customers' => 'required|array|min:0',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'code'      => 422,
                'message'   => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $lineTime = $this->lineTime($request->customers, $request->registers);

        return response()->json([
            'code'      => 200,
            'message'   => 'success',
            'linetime'  => $lineTime
        ], Response::HTTP_OK);
    }
}
