const Citizen = require('../models/citizen');

const index = (req, res) => {
    new Citizen().all((err, citizens) => {
        if (err) {
            console.log(err)
            return res.status(500).json({
                success: false,
                message: 'Internal Server Error'
            });
        }
        res.status(200).json({
            success: true,
            data: citizens
        });
    });
};

const create = (req, res) => {
    res.status(200).json({ success: true, message: 'Create page' });
};

const store = (req, res) => {
    console.log(req.body);
    const citizen = {
        nik: req.body.nik,
        nama: req.body.nama,
        alamat: req.body.alamat,
        tgl_lahir: req.body.tgl_lahir,
        gol_darah: req.body.gol_darah,
        agama: req.body.agama,
        status: req.body.status,
        kartu_keluarga_id: req.body.kartu_keluarga_id
    };

    new Citizen().save(citizen, (err, result) => {
        if (err) {
            return res.status(500).json({ success: false, message: 'Internal Server Error' });
        }
        res.status(201).json({ success: true, message: 'Data berhasil ditambah' });
    });
};

const edit = (req, res) => {
    const nik = req.params.nik;
    new Citizen().edit(nik, (err, citizen) => {
        if (err) {
            return res.status(500).json({ success: false, message: 'Internal Server Error' });
        }
        res.status(200).json({ success: true, data: citizen });
    });
};

const update = (req, res) => {
    const citizen = {
        nik: req.params.nik,
        nama: req.body.nama,
        alamat: req.body.alamat,
        tgl_lahir: req.body.tgl_lahir,
        gol_darah: req.body.gol_darah,
        agama: req.body.agama,
        status: req.body.status,
        kartu_keluarga_id: req.body.kartu_keluarga_id
    };

    new Citizen().update(citizen, (err, result) => {
        if (err) {
            return res.status(500).json({ success: false, message: 'Internal Server Error' });
        }
        res.status(200).json({ success: true, message: 'Data berhasil diubah' });
    });
};

const destroy = (req, res) => {
    const nik = req.params.nik;
    new Citizen().delete(nik, (err, result) => {
        if (err) {
            return res.status(500).json({ success: false, message: 'Internal Server Error' });
        }
        res.status(200).json({ success: true, message: 'Data berhasil dihapus' });
    });
};

module.exports = { index, create, store, edit, update, destroy };
