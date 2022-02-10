<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\Region;
use App\Models\Country;

class RegionController extends ResourceController
{
    private $region;

    public function __construct()
    {
        helper(['form', 'url', 'session']);

        $this->session = \Config\Services::session();
        $this->region = new Region;
    }


    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $regions = $this->region->orderBy('region_id', 'desc')->findAll();
        return view('regions/index', compact('regions'));
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $region = $this->region->find($id);

        if ($region) {
            return view('regions/show', compact('region'));
        }
        else {
            return redirect()->to('/regions');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $country = new \App\Models\Country();
        $data['country'] = $country->orderBy('countries_name', 'ASC')->findAll();

        return view('regions/create', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //$country = new \App\Models\Country();
        //$countries = $country->findAll();
        //$data['country'] = $countryModel->orderBy('country_name', 'ASC')->findAll();
        //$countrydata = $countryModel->where('country_id', $this->request->getVar('country_id'))->findAll();
        
        $inputs = $this->validate([
            'region_name' => 'required',
            'country_id' => 'required',
        ]);

        if (!$inputs) {
            return view('regions/create', [
                'validation' => $this->validator
            ]);
        }

        $this->region->save([
            'region_name' => $this->request->getVar('region_name'),
            'country_id' => $this->request->getVar('country_id'),
        ]);

        session()->setFlashdata('success', 'Success! Region created.');
        return redirect()->to(site_url('/regions'));
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $region = $this->region->find($id);

        if ($region) {
            return view('regions/edit', compact('region'));
        }
        else {
            session()->setFlashdata('failed', 'Alert! No data found.');
            return redirect()->to('/regions');
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $inputs = $this->validate([
            'region_name' => 'required',
            //'country_id' => 'required',
        ]);

        if (!$inputs) {
            return view('regions/create', [
                'validation' => $this->validator
            ]);
        }

        $this->region->save([
            'region_id' => $id,
            'region_name' => $this->request->getVar('region_name'),
            //'country_id' => $this->request->getVar('country_id')
        ]);

        session()->setFlashdata('success', 'Success! Region updated.');
        return redirect()->to(base_url('/regions'));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->region->delete($id);
        session()->setFlashdata('success', 'Success! Region deleted.');
        return redirect()->to(base_url('/regions'));
    }

    // country dropdown
    public function action()
    {
        if ($this->request->getVar('action')) {
            
            $action = $this->request->getVar('action');

            if ($action == 'get_country') {
                $countryModel = new Country();
                $countrydata = $countryModel->where('country_id', $this->request->getVar('country_id'))->findAll();
                echo json_encode($countrydata);
            }
        }
    }
}
