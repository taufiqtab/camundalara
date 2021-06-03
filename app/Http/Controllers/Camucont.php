<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Camucont extends Controller
{
    var $base_url = "http://localhost:8080/engine-rest/";
    public function index(){
        echo "Camunda Controller";
        // $this->getAllProcess();
        //$this->getTaskBy("","");
        // $this->startProcessByKey("penyuratan");
    }

    public function getAllProcess(){
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->get(
            "{$this->base_url}process-definition"
        );

        return json_decode($response->body());
    }

    public function getHistory(){
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->get(
            "{$this->base_url}history/process-instance/"
        );
        return json_decode($response->body());
    }

    public function getTaskBy($type, $val){
        if($type == "key"){
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->get(
                "{$this->base_url}task?processDefinitionKey=$val"
            );
            return json_decode($response->body());
        }else if($type == "instance"){
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->get(
                "{$this->base_url}task/?processInstanceId=$val"
            );
            return json_decode($response->body());
        }else{
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->get(
                "{$this->base_url}task"
            );
            return json_decode($response->body());
        }
    }

    public function startProcessByKey($val){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', "{$this->base_url}process-definition/key/$val/start", [
            'headers' => ['Content-Type' => 'application/json'],
        ]);
        
        $responseJson = $res->getBody()->getContents();
        $responseData = json_decode($responseJson, true);

        return $responseData;
    }

    public function completeTask($taskId, $variables){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', "{$this->base_url}task/$taskId/complete", [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => $variables
        ]);
        
        $responseJson = $res->getBody()->getContents();
        $responseData = json_decode($responseJson, true);

        return $responseData;
    }
}
