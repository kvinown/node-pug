const express = require('express')

const router = express.Router()

const familyCardController = require('../controller/FamilyCardController')
const citizenController = require('../controller/CitizenController')

router.use(express.static('public'))

// Family Card
router.get('/api/fam-card/delete/:id', familyCardController.destroy);
router.post('/api/fam-card/update', familyCardController.update);
router.get('/api/fam-card/edit/:id', familyCardController.edit);
router.post('/api/fam-card/store', familyCardController.store)
router.get('/api/fam-card/create', familyCardController.create)
router.get('/api/fam-card', familyCardController.index)

// Citizen
router.get('/api/citizen/delete/:nik', citizenController.destroy);
router.post('/api/citizen/update', citizenController.update);
router.get('/api/citizen/edit/:nik', citizenController.edit);
router.post('/api/citizen/store', citizenController.store);
router.get('/api/citizen/create', citizenController.create);
router.get('/api/citizen', citizenController.index);


router.get('/home', (req, res) => {
  res.render('dashboard')
})

router.get('/', (req, res) => {
  res.render('dashboard')
})

module.exports = router
