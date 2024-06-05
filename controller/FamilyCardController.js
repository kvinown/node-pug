const FamilyCard = require('../models/familyCard')

const index = (req, res) => {
    const success = req.session.success || '';
    delete req.session.success; // Hapus data sesi setelah digunakan
    new FamilyCard().all((familyCards) => {
        res.render('family_card/index', {
            familyCards: familyCards,
            success: success
        })
    })
}

const create = (req, res) => {
    res.render('family_card/create')
}

const store = (req, res) => {
    const familyCard = {
        id: req.body.id,
        kepala_keluarga: req.body.kepala_keluarga
    }


    new FamilyCard().save(familyCard, (result) => {
        req.session.success = "Data berhasil ditambah"
        res.redirect('/fam-card')
    })
}
const edit = (req, res) => {
    const id = req.params.id
    new FamilyCard().edit(id, (familyCard) => {
        res.render('family_card/edit', { familyCard: familyCard })
    })
}

const update = (req, res) => {
    const familyCard = {
        id: req.body.id,
        kepala_keluarga: req.body.kepala_keluarga
    }
    new FamilyCard().update(familyCard, (result) => {
        req.session.success = "Data berhasil diubah"
        res.redirect('/fam-card')
    })
}
const destroy = (req, res) => {
    const id = req.params.id
    new FamilyCard().delete(id, (familyCard) => {
        req.session.success = "Data berhasil dihapus"
        res.redirect('/fam-card')
    })
}


module.exports = { index, create, store, edit, update, destroy }
