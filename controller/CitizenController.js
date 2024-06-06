const Citizen = require('../models/citizen')
const FamilyCard = require('../models/familyCard')

const index = (req, res) => {
    const success = req.session.success || '';
    delete req.session.success;

    new Citizen().all((citizens) => {
        res.render('citizen/index', {
            citizens: citizens,
            success: success,
        });
    });
};


const create = (req, res) => {
    new FamilyCard().all((familyCards) => {
        res.render('citizen/create', {
            familyCards: familyCards
        })
    })
}


const store = (req, res) => {
    const citizen = {
        nik: req.body.nik,
        nama: req.body.nama,
        alamat: req.body.alamat,
        tgl_lahir: req.body.tgl_lahir,
        gol_darah: req.body.gol_darah,
        agama: req.body.agama,
        status: req.body.status
    };

    new Citizen().save(citizen, (result) => {
        req.session.success = "Data Berhasil ditambahkan"; // Menggunakan req.session, bukan res.session
        res.redirect('/citizen');
    });
};

const edit = (req, res) => {
    const nik = req.params.nik;
    new Citizen().edit(nik, (err, citizen) => {
        if (err || !citizen) {
            return res.redirect('/citizen');
        }

        new FamilyCard().all((familyCards) => {
            res.render('citizen/edit', {
                citizen: citizen,
                familyCards: familyCards
            });
        });
    });
};

const update = (req, res) => {
    const citizen = {
        nama: req.body.nama,
        alamat: req.body.alamat,
        tgl_lahir: req.body.tgl_lahir,
        gol_darah: req.body.gol_darah,
        agama: req.body.agama,
        status: req.body.status
    }
    new Citizen().update(citizen, (result) => {
        req.session.success = "Data berhasil diubah"
        res.redirect('/citizen')
    })
}
const destroy = (req, res) => {
    const nik = req.params.nik
    new Citizen().delete(nik, (result) => {
        req.session.success = "Data berhasil dihapus"
        res.redirect('/citizen')
    })
}
module.exports = { index, create, store, edit, update, destroy }
