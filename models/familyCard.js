const mysql = require('mysql')
const config = require('../config/db_config')

class FamilyCard {
    constructor() {
        this.db = mysql.createConnection(config.db)
        this.db.connect(err => {
            if (err) throw err
            console.log('MySQL Connection is Running')
        })
    }

    all(callback) {
        const query = "SELECT id, kepala_keluarga FROM kartu_keluarga"
        this.db.query(query, (err, result, field) => {
            if (err) {
                return callback(err)
            }
            const familyCards = result.map(result => ({
                id: result.id,
                kepala_keluarga: result.kepala_keluarga
            }))
            this.db.end()
            callback(familyCards)
        })
    }

    save(familyCardData, callback) {
        const query = "INSERT INTO kartu_keluarga (id, kepala_keluarga) VALUES (?, ?)"
        this.db.query(query, [familyCardData.id, familyCardData.kepala_keluarga], (err, result, field) => {
            if (err) {
                return callback(err)
            }
            callback(result)
        })
    }

    edit(id, callback) {
        const query = "SELECT id, kepala_keluarga FROM kartu_keluarga WHERE id = ?"
        this.db.query(query,id, (err, result, field) => {
            if (err) {
                return callback(err)
            }
            if (result.length){
                const familyCard = {
                    id: result[0].id,
                    kepala_keluarga: result[0].kepala_keluarga
                }
                callback(familyCard)
            } else {
                callback(new Error("Family card not found"))
            }
        })
    }

    update(familyCard, callback) {
        const query = "UPDATE kartu_keluarga SET kepala_keluarga = ? WHERE id = ?"
        this.db.query(query, [familyCard.kepala_keluarga, familyCard.id], (err, result) => {
            if (err) {
                return callback(err)
            }
            callback(result)
        })
    }

    delete(id, callback) {
        const query = "DELETE FROM kartu_keluarga WHERE id = ?"
        this.db.query(query, id, (err, result) => {
            if (err) {
                return callback(err)
            }
            callback(result)
        })
    }
}

module.exports = FamilyCard
