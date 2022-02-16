<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\Hotel;

class HotelController extends ResourceController
{
    private $hotel;

    public function __construct()
    {
        helper(['form', 'url', 'session']);

        $this->session = \Config\Services::session();
        $this->hotel = new Hotel;
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $hotels = $this->hotel->orderBy('id', 'desc')->findAll();
        return view('hotels/index', compact('hotels'));
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $hotel = $this->hotel->find($id);

        if ($hotel) {
            return view('hotels/show', compact('hotel'));
        }
        else {
            return redirect()->to('/hotels');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('hotels/create');
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $inputs = $this->validate([
            'name' => 'required',
        ]);

        if (!$inputs) {
            return view('hotels/create', [
                'validation' => $this->validator
            ]);
        }

        $this->hotel->save([
            'name' => $this->request->getVar('name')
        ]);

        session()->setFlashdata('success', 'Success! Hotel created.');
        return redirect()->to(site_url('/hotels'));
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $hotel = $this->hotel->find($id);

        if ($hotel) {
            return view('hotels/edit', compact('hotel'));
        }
        else {
            session()->setFlashdata('failed', 'Alert! No data found.');
            return redirect()->to('/hotels');
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
            'name' => 'required'
        ]);

        if (!$inputs) {
            return view('hotels/create', [
                'validation' => $this->validator
            ]);
        }

        $this->hotel->save([
            'id' => $id,
            'name' => $this->request->getVar('name')
        ]);

        session()->setFlashdata('success', 'Success! Hotel updated.');
        return redirect()->to(base_url('/hotels'));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->hotel->delete($id);
        session()->setFlashdata('success', 'Success! Hotel deleted.');
        return redirect()->to(base_url('/hotels'));
    }
}
