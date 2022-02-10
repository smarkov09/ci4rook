<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\Region;
use App\Models\City;

class CityController extends ResourceController
{
    private $city;

    public function __construct()
    {
        helper(['form', 'url', 'session']);

        $this->session = \Config\Services::session();
        $this->city = new City;
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $cities = $this->city->orderBy('city_id', 'desc')->findAll();
        return view('cities/index', compact('cities'));
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $city = $this->city->find($id);

        if ($city) {
            return view('cities/show', compact('city'));
        }
        else {
            return redirect()->to('/cities');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $region = new \App\Models\Region();
        $data['region'] = $region->orderBy('region_name', 'ASC')->findAll();

        return view('cities/create', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $inputs = $this->validate([
            'city_name' => 'required',
            'region_id' => 'required',
        ]);

        if (!$inputs) {
            return view('cities/create', [
                'validation' => $this->validator
            ]);
        }

        $this->city->save([
            'city_name' => $this->request->getVar('city_name'),
            'region_id' => $this->request->getVar('region_id'),
        ]);

        session()->setFlashdata('success', 'Success! city created.');
        return redirect()->to(site_url('/cities'));
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $city = $this->city->find($id);

        if ($city) {
            return view('cities/edit', compact('city'));
        }
        else {
            session()->setFlashdata('failed', 'Alert! No data found.');
            return redirect()->to('/cities');
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
            'city_name' => 'required',
            //'region_id' => 'required',
        ]);

        if (!$inputs) {
            return view('cities/create', [
                'validation' => $this->validator
            ]);
        }

        $this->city->save([
            'city_id' => $id,
            'city_name' => $this->request->getVar('city_name'),
            //'region_id' => $this->request->getVar('region_id')
        ]);

        session()->setFlashdata('success', 'Success! city updated.');
        return redirect()->to(base_url('/cities'));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->city->delete($id);
        session()->setFlashdata('success', 'Success! city deleted.');
        return redirect()->to(base_url('/cities'));
    }
}
