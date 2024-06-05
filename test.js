const FamilyCard = require('./models/familyCard')

const index = (req, res) => {
    new FamilyCard().all((familyCards) => {
        res.render('family_card/index', {
            familyCards: familyCards
        })
    })
}

const create = (req, res) => {
    res.render('family_card/create')
}

const store = (req, res) => {
    const newFamilyCard = {
        id: req.body.id,
        kepala_keluarga: req.body.kepala_keluarga
    }
    new FamilyCard().save(newFamilyCard, (err, result) => {
        if (err) {
            return res.status(500).send(err)
        }
        res.redirect('/fam-card')
    })
}

module.exports = { index, create, store }
