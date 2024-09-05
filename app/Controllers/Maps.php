<?php

namespace App\Controllers;

class Maps extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Maps | ADS-B Status Monitoring'
        ];
        return view('maps/index', $data);
    }

    public function ambilData()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'tampildata' => $this->input->select('maps.*, input_data.id as id_input_data, input_data.tanggal, input_data.waktu, input_data.time_update')->join('input_data', 'input_data.sic=maps.sic')->get()->getResultArray()
            ];

            $msg = [
                'data' => view('maps/data', $data),
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }



    public function formTambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('maps/modalTambah')
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function simpanData()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'groundStation' => [
                    'label' => 'Ground Station',
                    'rules' => 'required|is_unique[maps.groundStation]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh ada yang sama, silahkan coba yang lain'
                    ]
                ],
                'sic' => [
                    'label' => 'SIC',
                    'rules' => 'required|is_unique[maps.sic]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh ada yang sama, silahkan coba yang lain'
                    ]
                ],
                'sac' => [
                    'label' => 'SAC',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'latitude' => [
                    'label' => 'Latitude',
                    'rules' => 'required|is_unique[maps.latitude]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh ada yang sama, silahkan coba yang lain'
                    ]
                ],
                'longitude' => [
                    'label' => 'Longitude',
                    'rules' => 'required|is_unique[maps.longitude]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh ada yang sama, silahkan coba yang lain'
                    ]
                ]
            ]);

            if (!$valid) {

                $msg = [
                    'error' => [
                        'groundStation' => $validation->getError('groundStation'),
                        'sic' => $validation->getError('sic'),
                        'sac' => $validation->getError('sac'),
                        'latitude' => $validation->getError('latitude'),
                        'longitude' => $validation->getError('longitude')
                    ]
                ];
            } else {
                // dd($this->request->getVar());
                $simpanData = [
                    'groundStation' => $this->request->getVar('groundStation'),
                    'sic' => $this->request->getVar('sic'),
                    'sac' => $this->request->getVar('sac'),
                    'altitude' => $this->request->getVar('altitude'),
                    'latitude' => $this->request->getVar('latitude'),
                    'longitude' => $this->request->getVar('longitude'),
                    'tanggal' => $this->request->getVar('tanggal'),
                    'waktu' => $this->request->getVar('waktu'),
                    'status' => $this->request->getVar('stts'),
                    'keterangan' => $this->request->getVar('keterangan')
                ];

                $this->input->insert($simpanData);

                $msg = [
                    'sukses' => 'Data berhasil tersimpan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function formEdit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $row = $this->input->select('maps.*, input_data.id as id_input_data, input_data.tanggal, input_data.waktu')->join('input_data', 'input_data.sic=maps.sic')->where(['input_data.id' => $id])->first();

            $data = [
                'id' => $row['id'],
                'id_input_data' => $row['id_input_data'],
                'groundStation' => $row['groundStation'],
                'sic' => $row['sic'],
                'sac' => $row['sac'],
                'altitude' => $row['altitude'],
                'latitude' => $row['latitude'],
                'longitude' => $row['longitude'],
                'tanggal' => $row['tanggal'],
                'waktu' => $row['waktu'],
                'status' => $row['status'],
                'keterangan' => $row['keterangan']
            ];

            $msg = [
                'sukses' => view('maps/modalEdit', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {

            $maps_data = [
                'groundStation' => $this->request->getVar('groundStation'),
                'sic' => $this->request->getVar('sic'),
                'sac' => $this->request->getVar('sac'),
                'altitude' => $this->request->getVar('altitude'),
                'latitude' => $this->request->getVar('latitude'),
                'longitude' => $this->request->getVar('longitude'),
                'status' => $this->request->getVar('stts'),
                'keterangan' => $this->request->getVar('keterangan')
            ];

            $input_data = [
                'sic' => $this->request->getVar('sic'),
                'tanggal' => $this->request->getVar('tanggal'),
                'waktu' => $this->request->getVar('waktu')
            ];

            $id_maps = $this->request->getVar('id');
            $id_input_data = $this->request->getVar('id_input_data');

            $this->input->update($id_maps, $maps_data);
            $this->input_data->update($id_input_data, $input_data);

            $msg = [
                'sukses' => 'Data berhasil diupdate'
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            // $input = new InputModel();

            $this->input->delete($id);

            $msg = [
                'sukses' => "Data berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    public function formTambahBanyak()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('maps/formTambahBanyak')
            ];

            echo json_encode($msg);
        }
    }

    public function simpanDataBanyak()
    {
        if ($this->request->isAJAX()) {
            $groundStation = $this->request->getVar('groundStation');
            $sic = $this->request->getVar('sic');
            $sac = $this->request->getVar('sac');
            $altitude = $this->request->getVar('altitude');
            $latitude = $this->request->getVar('latitude');
            $longitude = $this->request->getVar('longitude');
            $tanggal = $this->request->getVar('tanggal');
            $waktu = $this->request->getVar('waktu');
            $stts = $this->request->getVar('stts');
            $keterangan = $this->request->getVar('keterangan');

            $jmldata = count($groundStation);

            for ($i = 0; $i < $jmldata; $i++) {

                $this->input->insert([
                    'groundStation' => $groundStation[$i],
                    'sic' => $sic[$i],
                    'sac' => $sac[$i],
                    'altitude' => $altitude[$i],
                    'latitude' => $latitude[$i],
                    'longitude' => $longitude[$i],
                    'tanggal' => $tanggal[$i],
                    'waktu' => $waktu[$i],
                    'status' => $stts[$i],
                    'keterangan' => $keterangan[$i]
                ]);
            }

            $msg = [
                'sukses' => "$jmldata data berhasil disimpan"
            ];

            echo json_encode($msg);
        }
    }

    public function hapusBanyak()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $jmldata = count($id);

            for ($i = 0; $i < $jmldata; $i++) {
                $this->input->delete($id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata data berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }
}
