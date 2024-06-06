const FamilyCard = require('../models/familyCard');

const index = (req, res) => {
    new FamilyCard().all((err, familyCards) => {
        if (err) {
            return res.status(500).json({ success: false, message: 'Internal Server Error' });
        }
        res.status(200).json({ success: true, data: familyCards });
    });
};

const create = (req, res) => {
    res.status(200).json({ success: true, message: 'Create page' });
};

const store = (req, res) => {
    const familyCard = {
        id: req.body.id,
        kepala_keluarga: req.body.kepala_keluarga
    };

    new FamilyCard().save(familyCard, (err, result) => {
        if (err) {
            return res.status(500).json({ success: false, message: 'Internal Server Error' });
        }
        res.status(201).json({ success: true, message: 'Data berhasil ditambah' });
    });
};

const edit = (req, res) => {
    const id = req.params.id;
    new FamilyCard().edit(id, (err, familyCard) => {
        if (err) {
            return res.status(500).json({ success: false, message: 'Internal Server Error' });
        }
        res.status(200).json({ success: true, data: familyCard });
    });
};

const update = (req, res) => {
    const familyCard = {
        id: req.body.id,
        kepala_keluarga: req.body.kepala_keluarga
    };

    new FamilyCard().update(familyCard, (err, result) => {
        if (err) {
            return res.status(500).json({ success: false, message: 'Internal Server Error' });
        }
        res.status(200).json({ success: true, message: 'Data berhasil diubah' });
    });
};

const destroy = (req, res) => {
    const id = req.params.id;
    new FamilyCard().delete(id, (err, result) => {
        if (err) {
            return res.status(500).json({ success: false, message: 'Internal Server Error' });
        }
        res.status(200).json({ success: true, message: 'Data berhasil dihapus' });
    });
};

module.exports = { index, create, store, edit, update, destroy };
