<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\Country;

class CountryController extends ResourceController
{
    private $country;

    public function __construct()
    {
        helper(['form', 'url', 'session']);

        $this->session = \Config\Services::session();
        $this->country = new Country;
    }


    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $countries = $this->country->orderBy('countries_id', 'desc')->findAll();
        return view('countries/index', compact('countries'));
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $country = $this->country->find($id);

        if ($country) {
            return view('countries/show', compact('country'));
        }
        else {
            return redirect()->to('/countries');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('countries/create');
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $inputs = $this->validate([
            'countries_name' => 'required'
        ]);

        if (!$inputs) {
            return view('countries/create', [
                'validation' => $this->validator
            ]);
        }

        $this->country->save([
            'countries_name' => $this->request->getVar('countries_name')
        ]);

        session()->setFlashdata('success', 'Success! Country created.');
        return redirect()->to(site_url('/countries'));
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $country = $this->country->find($id);

        if ($country) {
            return view('countries/edit', compact('country'));
        }
        else {
            session()->setFlashdata('failed', 'Alert! No country found.');
            return redirect()->to('/countries');
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
            'countries_name' => 'required'
        ]);

        if (!$inputs) {
            return view('countries/create', [
                'validation' => $this->validator
            ]);
        }

        $this->country->save([
            'countries_id' => $id,
            'countries_name' => $this->request->getVar('countries_name')
        ]);

        session()->setFlashdata('success', 'Success! Country updated.');
        return redirect()->to(base_url('/countries'));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->country->delete($id);
        session()->setFlashdata('success', 'Success! Country deleted.');
        return redirect()->to(base_url('/countries'));
    }
}
