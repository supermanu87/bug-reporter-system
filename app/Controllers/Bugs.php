<?php

namespace App\Controllers;

use \CodeIgniter\API\ResponseTrait;
use \OAuth2\Storage\Pdo;
use \CodeIgniter\Controller;
use \CodeIgniter\RESTful\ResourceController;
use App\Models\BugsModel;


// This is the controller class in order to manage HTTP/HTTPS requests
class Bugs extends ResourceController
{
    
    // This is the default index page
    public function index(){

        $bugs_model = new BugsModel();
        $all_bugs = $bugs_model->list();
        
        // Defining frontend page title based on environment
        $title = (ENVIRONMENT === 'development') ? SITE_TITLE . " - " . ENVIRONMENT . " | API VERSION: " . API_VERSION : SITE_TITLE;
        $data = array();
        $data["title"] = $title;
        $data["bugs"] = $all_bugs["bugs"];
        $data["api_version"] = (ENVIRONMENT === 'development') ? "API VERSION: " . API_VERSION : "";
        
        //Load view
        return view('welcome', $data);  
    }
    
    /* API that returns all registered bugs 
       Optional input parameter: 'query'
       'query' parameter is used to do fulltext queries 
    */
    public function list(){

        $bugs_model = new BugsModel();

        $query = $this->request->getVar('query') ? $this->request->getVar('query') : null;

        $result = $bugs_model->list($query);
        return $this->respond($result);   
    }


    // Register a new bug
    public function add(){
        
        
        /* Set a validation control in order to fetch all the mandatory fields
        reporter_first_name
        reporter_last_name
        bug_description 
        */
        $validation =  \Config\Services::validation();
        $validation->setRules([
                'reporter_first_name' => 'required',
                'reporter_last_name' => 'required',
                'bug_description' => 'required'
                    
        ]);

        // If all fields are fullfilled the bug can be stored
        if($validation->withRequest($this->request)->run()){

            $bugs_model = new BugsModel();
            $data = array();

            $data['reporter_first_name'] = $this->request->getVar('reporter_first_name');
            $data['reporter_last_name'] = $this->request->getVar('reporter_last_name');
            $data['bug_description'] = $this->request->getVar('bug_description');

            $response = $bugs_model->add($data);
            
            if($response){
                    return $this->respond($response);   
            }else{
                    return $this->respond(["status" => false]);
            }
        
            return $this->respond(["status" => false, "message" => $validation->getErrors()], 400);
        }else{
            return $this->respond(["status" => false, "message" => $validation->getErrors()], 400);
        }

    }

}
