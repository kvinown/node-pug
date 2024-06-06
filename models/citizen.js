const mysql = require('mysql');
const config = require('../config/db_config');
const FamilyCard = require('./familyCard');

class Citizen {
    constructor() {
        this.db = mysql.createConnection(config.db);
        this.db.connect(err => {
            if (err) throw err;
            console.log("MySQL Connected to Citizen");
        });
    }

    all(callback) {
        const query = `
            SELECT penduduk.nik, penduduk.nama, penduduk.alamat, penduduk.tgl_lahir, 
                   penduduk.gol_darah, penduduk.agama, penduduk.status, 
                   penduduk.kartu_keluarga_id, kartu_keluarga.kepala_keluarga
            FROM penduduk
            LEFT JOIN kartu_keluarga ON penduduk.kartu_keluarga_id = kartu_keluarga.id
        `;
        this.db.query(query, (err, result) => {
            if (err) {
                return callback(err);
            }
            const citizens = result.map(row => ({
                nik: row.nik,
                nama: row.nama,
                alamat: row.alamat,
                tgl_lahir: row.tgl_lahir,
                gol_darah: row.gol_darah,
                agama: row.agama,
                status: row.status,
                kartu_keluarga_id: row.kartu_keluarga_id,
                kepala_keluarga: row.kepala_keluarga
            }));
            callback(citizens);
        });
    }

    save(citizenData, callback) {
        const query = "INSERT INTO penduduk (nik, nama, alamat, tgl_lahir, gol_darah, agama, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
        this.db.query(query, [
            citizenData.nik,
            citizenData.nama,
            citizenData.alamat,
            citizenData.tgl_lahir,
            citizenData.gol_darah,
            citizenData.agama,
            citizenData.status
        ], (err, result) => {
            if (err) {
                return callback(err);
            }
            callback(null, result);
        });
    }

    edit(nik, callback) {
        const query = "SELECT nik, nama, alamat, tgl_lahir, gol_darah, agama, status, kartu_keluarga_id FROM penduduk WHERE nik = ?";
        this.db.query(query, [nik], (err, result) => {
            if (err) {
                return callback(err);
            }
            if (result.length) {
                const citizen = {
                    nik: result[0].nik,
                    nama: result[0].nama,
                    alamat: result[0].alamat,
                    tgl_lahir: result[0].tgl_lahir,
                    gol_darah: result[0].gol_darah,
                    agama: result[0].agama,
                    status: result[0].status,
                    kartu_keluarga_id: result[0].kartu_keluarga_id
                };
                callback(null, citizen);
            } else {
                callback(new Error("Citizen not found"));
            }
        });
    }

    update(citizenData, callback) {
        const query = "UPDATE penduduk SET nama = ?, alamat = ?, tgl_lahir = ?, gol_darah = ?, agama = ?, status = ?, kartu_keluarga_id = ? WHERE nik = ?";
        this.db.query(query, [
            citizenData.nama,
            citizenData.alamat,
            citizenData.tgl_lahir,
            citizenData.gol_darah,
            citizenData.agama,
            citizenData.status,
            citizenData.kartu_keluarga_id,
            citizenData.nik
        ], (err, result) => {
            if (err) {
                return callback(err);
            }
            callback(null, result);
        });
    }

    delete(id, callback) {
        const query = "DELETE FROM penduduk WHERE nik = ?";
        this.db.query(query, [id], (err, result) => {
            if (err) {
                return callback(err);
            }
            callback(null, result);
        });
    }

    getFamilyCard(kartu_keluarga_id, callback) {
        const familyCard = new FamilyCard();
        familyCard.edit(kartu_keluarga_id, (err, result) => {
            if (err) {
                return callback(err);
            }
            return callback(null, result);
        });
    }
}

module.exports = Citizen;
