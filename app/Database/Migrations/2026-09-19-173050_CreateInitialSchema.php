<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInitialSchema extends Migration
{
    public function up()
    {
        // 1. Table: `jadwal_sholat`
        $this->forge->addField(['id'         => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],             'tanggal'    => ['type' => 'DATE', 'null' => false],             'hijriyah'   => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],             'subuh'      => ['type' => 'TIME', 'null' => true],             'imsak'      => ['type' => 'TIME', 'null' => true],             'syuruq'     => ['type' => 'TIME', 'null' => true],             'dhuha'      => ['type' => 'TIME', 'null' => true],             'dzuhur'     => ['type' => 'TIME', 'null' => true],             'ashar'      => ['type' => 'TIME', 'null' => true],             'maghrib'    => ['type' => 'TIME', 'null' => true],             'isya'       => ['type' => 'TIME', 'null' => true],             'source'     => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'local'],             'created_at' => ['type' => 'TIMESTAMP', 'null' => true],]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('tanggal', 'uq_tanggal');
        $this->forge->createTable('jadwal_sholat', true);

        $this->db->query('ALTER TABLE `jadwal_sholat` MODIFY `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');

        // 2. Table: `media_slider`
        $this->forge->addField([
            'id'       => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'filename' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'title'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'type'     => ['type' => 'ENUM', 'constraint' => ['image', 'video'], 'default' => 'image'],
            'caption'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'ordering' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'duration' => ['type' => 'INT', 'constraint' => 11, 'default' => 6000],
            'enabled'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('media_slider', true);

        // 3. Table: `pengaturan`
        $this->forge->addField(['id'         => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],             'keyname'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],             'value'      => ['type' => 'TEXT', 'null' => true],             'updated_at' => ['type' => 'TIMESTAMP', 'null' => true],]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('keyname');
        $this->forge->createTable('pengaturan', true);

        $this->db->query('ALTER TABLE `pengaturan` MODIFY `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');

        // 4. Table: `pengumuman`
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'judul'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'isi'        => ['type' => 'TEXT', 'null' => true],
            'kategori'   => ['type' => 'ENUM', 'constraint' => ['keuangan_jumat', 'imam_khatib', 'umum'], 'default' => 'umum'],
            'mulai'      => ['type' => 'DATETIME', 'null' => true],
            'sampai'     => ['type' => 'DATETIME', 'null' => true],
            'durasi'     => ['type' => 'INT', 'constraint' => 11, 'default' => 8000],
            'enabled'    => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pengumuman', true);

        $this->db->query('ALTER TABLE `pengumuman` MODIFY `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP');
    }

    public function down()
    {
        $this->forge->dropTable('pengumuman', true);
        $this->forge->dropTable('pengaturan', true);
        $this->forge->dropTable('media_slider', true);
        $this->forge->dropTable('jadwal_sholat', true);
    }
}
