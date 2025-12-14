# simpel-chatbot-konsulkuliah
Bot Telegram untuk konsultasi mahasiswa dengan fitur kategori pembulian, keuangan, mata kuliah, dan umum

KonsultasiKuliahBot
Chatbot yang mempermudah akses informasi dan pelaporan

KonsulKuliah Bot – Telegram + Dialogflow + PHP Chatbot konsultasi mahasiswa dengan integrasi Telegram, Dialogflow, dan backend PHP XAMPP. User bisa konsultasi masalah pembulian, keuangan, mata kuliah, atau topik umum.

Persiapan Awal Pastikan punya:
✅ XAMPP (Apache + PHP + MySQL) sudah terinstall

✅ Ngrok (untuk public URL)

✅ Akun Google (untuk Dialogflow)

✅ Akun Telegram

Setup Database (5 menit) Buka phpMyAdmin (http://localhost/phpmyadmin)
Create database baru: chatbot_konsultasi

Jalankan SQL ini:

sql CREATE TABLE IF NOT EXISTS chatbot_konsultasi ( id INT AUTO_INCREMENT PRIMARY KEY, chat_id VARCHAR(50), nama VARCHAR(100), nim VARCHAR(20), jurusan VARCHAR(100), kategori VARCHAR(50), detail LONGTEXT, data_json LONGTEXT, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ); 3. Setup Folder & File PHP (5 menit) Buka C:\xampp\htdocs\ → buat folder baru: chatbot-webhook

Di folder chatbot-webhook buat 3 file:

File 1: config.php php

connect_error) { error_log("DB Error: " . $conn->connect_error); } $conn->set_charset("utf8mb4"); ?>
File 2: functions.php php

File 3: webhook.php ⚠️ [COPY DARI FILE webhook-STABLE-FINAL.php yang sudah disiapkan sebelumnya. Pastekan seluruh kode di sana.

Expose XAMPP dengan Ngrok (2 menit) Download & jalankan Ngrok di terminal/CMD:
bash ngrok http 80 Copy dan paste Catat URL yang muncul, contoh: https://abc123.ngrok-free.app

Webhook URL PHP kamu buat di htdocs: https://abc123.ngrok-free.app/chatbot-webhook/webhook.php

Buat Bot Telegram (3 menit) Buka Telegram → cari @BotFather
Kirim: /newbot

Isi nama bot: KonsulKuliahBot (atau nama apapun)

Isi username: konsulkuliah_bot (harus unik, akhir dengan _bot)

COPY & SIMPAN Bot Token yang diberikan, contoh: 123456789:ABCDEFGhijklmnop

Setup Dialogflow (7 menit) 6.1 Create Agent Buka https://dialogflow.cloud.google.com
Klik Create Agent

Isi:

Name: chatbot-kuliah

Language: Indonesian

Time Zone: Asia/Jakarta (atau timezone kamu)

Default GCP Project: biarkan auto

Klik Create

6.2 Setup Fulfillment (Webhook) Di menu kiri, klik Fulfillment

Aktifkan Webhook (toggle ON)

Di URL field, masukkan: https://abc123.ngrok-free.app/chatbot-webhook/webhook.php (ganti abc123.ngrok-free.app dengan URL Ngrok kamu)

Klik Save

Buat Intent di Dialogflow (10 menit) Intent 1: Default Welcome Intent Di menu kiri, klik Intents → Default Welcome Intent
Training Phrases tambah:

/start

start

mulai

Scroll ke bawah, di Fulfillment, centang: ✓ Enable webhook call for this intent

Klik Save

Intent 2: Default Fallback Intent Di Intents → Default Fallback Intent

Jangan ubah Training Phrases (biarkan default)

Di Fulfillment, centang: ✓ Enable webhook call for this intent

Klik Save

Selesai! Semua logika flow (nama → jurusan → NIM → kategori → detail) di-handle oleh webhook PHP berbasis status.

Integrasikan Telegram ke Dialogflow (5 menit) Di menu kiri Integrations
Pilih Telegram

Klik toggle Enable

Di field Telegram Bot Token, masukkan token dari BotFather (langkah 5)

Pilih Default environment

Klik Save

Selesai! Dialogflow akan mendaftarkan webhook ke Telegram secara otomatis.

Test Bot (5 menit) Pastikan:
Apache & MySQL XAMPP ON

Ngrok running (jangan ditutup)

webhook.php & functions.php sudah di-folder C:\xampp\htdocs\chatbot-webhook\

Dialogflow Fulfillment URL sudah benar

Buka Telegram → cari & buka bot kamu (cari username dari BotFather)

Kirim: /start

Bot seharusnya merespon:

text 👋 SELAMAT DATANG di Chatbot Konsultasi Mahasiswa!

Saya siap membantu Anda dengan: 🚨 Pembulian/Bullying 💰 Masalah Keuangan 📚 Feedback Mata Kuliah 💬 Topik Umum Lainnya

Mari mulai! 👇 [🚀 Mulai Konsultasi] Klik tombol atau ketik apapun, ikuti flow.

Flow Alur Bot text User: /start ↓ Bot: Selamat datang + tombol "Mulai Konsultasi" ↓ User: Klik tombol / ketik ↓ Bot: Siapa nama Anda? ↓ User: "Supriyanto" (atau nama apapun, minimal 3 huruf) ↓ Bot: Pilih jurusan [SI] [TS] [BM] [FB] ↓ User: Klik SI (atau ketik "SI") ↓ Bot: Berapa NIM? (10 digit) ↓ User: "2310102000" ↓ Bot: Data tersimpan, pilih kategori: [🚨 Pembulian] [💰 Keuangan] [📚 Matkul] [💬 Umum] ↓ User: Klik kategori (contoh: Umum) ↓ Bot: Apa topik yang ingin Anda diskusikan? ↓ User: "Stress karena tugas" ↓ Bot: Silakan cerita detail. Anda bisa kirim multiple pesan. ↓ User: "Punya 5 assignment minggu ini" Bot: Pesan tercatat, lanjutkan atau ketik 'selesai' ↓ User: "Deadline semua minggu depan" (kirim lagi) Bot: Pesan tercatat... ↓ User: "selesai" / klik tombol [✅ Selesai Cerita] ↓ Bot: KONSULTASI UMUM TERSIMPAN ID: #3 Tim akan memberikan feedback. 🙏

[🔄 Konsultasi Baru] [❌ Selesai] ↓ Data tersimpan di database chatbot_db, tabel konsultasi

Kategori Alur Detail Pembulian Bot tanya: Detail pembulian → Nama pelaku → Jurusan pelaku

Simpan ke DB kategori "pembulian"

Keuangan Bot tanya: Detail masalah keuangan

Simpan ke DB kategori "keuangan"

Mata Kuliah Bot tanya: Nama matkul → Feedback untuk matkul

Simpan ke DB kategori "mata_kuliah"

Umum ⭐ (Fitur Multiple Message) Bot tanya: Topik umum

User bisa kirim multiple pesan (append otomatis)

Ketik "selesai" atau klik tombol untuk simpan

Simpan ke DB kategori "umum"

Cek Data di Database Buka phpMyAdmin (http://localhost/phpmyadmin)
Pilih database chatbot_db → tabel konsultasi

Lihat semua konsultasi yang tersimpan (nama, NIM, kategori, detail, timestamp)

Troubleshoot Bot tidak merespon / Error 500 Buka: C:\xampp\htdocs\chatbot-webhook\webhook_error.log
Cek error message

Pastikan:

✅ Apache & MySQL ON

✅ Ngrok masih jalan (URL tidak expired)

✅ Dialogflow Fulfillment URL sudah update ke URL Ngrok terbaru

✅ config.php punya DB credentials yang benar

✅ Tabel konsultasi sudah dibuat
