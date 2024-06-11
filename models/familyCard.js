const mysql = require('mysql');
const config = require('../config/db_config');

class FamilyCard {
    constructor() {
        this.db = mysql.createConnection(config.db);
        this.db.connect(err => {
            if (err) throw err;
            console.log('MySQL Connected to Family Card');
        });
    }

    all(callback) {
        const query = "SELECT id, kepala_keluarga FROM kartu_keluarga";
        this.db.query(query, (err, result) => {
            if (err) {
                return callback(err);
            }
            const familyCards = result.map(row => ({
                id: row.id,
                kepala_keluarga: row.kepala_keluarga
            }));
            callback(null, familyCards);
        });
    }
    all2 = () => {
        const query = "SELECT id, kepala_keluarga FROM kartu_keluarga";
        return new Promise((resolve, reject) => {
            this.db.query(query, (err, result) => {
                if (err) reject(err)
                const familyCards = result.map(row => ({
                    id: row.id,
                    kepala_keluarga: row.kepala_keluarga
                }));
                resolve(familyCards)
            })
        })
    }
    save(familyCardData, callback) {
        const query = "INSERT INTO kartu_keluarga (id, kepala_keluarga) VALUES (?, ?)";
        this.db.query(query, [familyCardData.id, familyCardData.kepala_keluarga], (err, result) => {
            if (err) {
                return callback(err);
            }
            callback(null, result);
        });
    }

    edit(id, callback) {
        const query = "SELECT id, kepala_keluarga FROM kartu_keluarga WHERE id = ?";
        this.db.query(query, [id], (err, result) => {
            if (err) {
                return callback(err);
            }
            if (result.length === 0) {
                return callback(new Error("Family card not found"));
            }
            const familyCard = {
                id: result[0].id,
                kepala_keluarga: result[0].kepala_keluarga
            };
            callback(null, familyCard);
        });
    }

    update(familyCardData, callback) {
        const query = "UPDATE kartu_keluarga SET kepala_keluarga = ? WHERE id = ?";
        this.db.query(query, [familyCardData.kepala_keluarga, familyCardData.id], (err, result) => {
            if (err) {
                return callback(err);
            }
            callback(null, result);
        });
    }

    delete(id, callback) {
        const query = "DELETE FROM kartu_keluarga WHERE id = ?";
        this.db.query(query, [id], (err, result) => {
            if (err) {
                return callback(err);
            }
            callback(null, result);
        });
    }
}

module.exports = FamilyCard;
