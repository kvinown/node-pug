const express = require('express')

const router = express.Router()

const familyCardController = require('../controller/FamilyCardController')

router.use(express.static('public'))

// Family Card
router.get('/fam-card/delete/:id', familyCardController.destroy);
router.post('/fam-card/update', familyCardController.update);
router.get('/fam-card/edit/:id', familyCardController.edit);
router.post('/fam-card/store', familyCardController.store)
router.get('/fam-card/create', familyCardController.create)
router.get('/fam-card', familyCardController.index)

router.post('/citizen', (req, res) => {

})


router.get('/home', (req, res) => {
  res.render('dashboard')
})

router.get('/', (req, res) => {
  res.render('dashboard')
})

module.exports = router
