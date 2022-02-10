<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\CountryModel;
use App\Models\StateModel;
use App\Models\CityModel;

class DynamicDependent extends BaseController
{
    public function index()
    {
        $countryModel = new CountryModel();
        $data['country'] = $countryModel->orderBy('country_name', 'ASC')->findAll();

        return view('dynamic-dependent', $data);
    }

    public function action()
    {
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');
            
            if ($action == 'get_state') {
                $stateModel = new StateModel();
                $statedata = $stateModel->where('country_id', $this->request->getVar('country_id'))->findAll();
                echo json_encode($statedata);
            }

            if ($action == 'get_city') {
                $cityModel = new CityModel();
                $citydata = $cityModel->where('state_id', $this->request->getVar('state_id'))->findAll();
                echo json_encode($citydata);
            }
        }
    }
}
