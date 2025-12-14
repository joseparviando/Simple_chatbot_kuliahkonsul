<?php
/**
 * HELPER FUNCTIONS V2 - ADVANCED
 */

// ============================================
// RESPONSE TEMPLATES
// ============================================

$responses = [
    'welcome' => "👋 *SELAMAT DATANG* di Chatbot Konsultasi Mahasiswa!\n\n"
        . "Saya siap membantu dengan:\n"
        . "🚨 Pembulian\n"
        . "💰 Masalah Keuangan\n"
        . "📚 Feedback Mata Kuliah\n"
        . "💬 Topik Umum Lainnya\n\n"
        . "Mari mulai dengan nama Anda: *Untuk melanjutkan ketik Ok* ",

    'ask_nama' => "Silakan ketik nama Anda:\n(Contoh: Budi Santoso)",

    'error_nama' => "❌ Nama tidak valid.\n\nSilakan ketik nama dengan benar (min 3 karakter):\nContoh: Budi Santoso",

    'confirm_nama' => "✅ Nama Anda: *{nama}*\n\nSekarang pilih jurusan Anda:",

    'ask_jurusan' => "Pilih jurusan:\n"
        . "1️⃣ Sistem Informasi\n"
        . "2️⃣ Teknik Sipil\n"
        . "3️⃣ Business Management\n"
        . "4️⃣ F&B Retail Management\n\n"
        . "Atau ketik nama jurusan Anda:",

    'error_jurusan' => "❌ Jurusan tidak valid.\n\nPilih dari opsi atau ketik langsung.",

    'confirm_jurusan' => "✅ Jurusan: *{jurusan}*\n\nSekarang ketik NIM Anda (10 digit):\nContoh: 2310102026",

    'error_nim' => "❌ NIM tidak valid.\n\nHarus 10 digit angka!\nContoh: 2310102026",

    'confirm_nim' => "✅ Data Anda sudah tercatat:\n"
        . "👤 *{nama}*\n"
        . "📚 *{jurusan}*\n"
        . "🆔 *{nim}*\n\n"
        . "Sekarang pilih kategori konsultasi: untuk memilih kategori ketik Kategori",

    'kategori_menu' => "Pilih kategori:\n\n"
        . "1️⃣ 🚨 *PEMBULIAN*\n"
        . "2️⃣ 💰 *KEUANGAN*\n"
        . "3️⃣ 📚 *MATA KULIAH*\n"
        . "4️⃣ 💬 *UMUM*\n\n"
        . "Ketik angka atau nama kategori:",

    'error_kategori' => "❌ Kategori tidak valid.\n\nPilih 1️⃣ 2️⃣ 3️⃣ atau 4️⃣",

    // PEMBULIAN
    'pembulian_start' => "🚨 *KATEGORI: PEMBULIAN*\n\n"
        . "Saya siap membantu mengatasi pembulian.\n\n"
        . "Ceritakan:\n"
        . "- Apa yang terjadi?\n"
        . "- Kapan kejadiannya?\n"
        . "- Siapa yang melakukan?",

    'pembulian_detail' => "✅ Cerita Anda dicatat.\n\n"
        . "Sekarang bisa kasih bukti? (screenshot, foto, dll)\n"
        . "Atau ketik 'skip' jika tidak ada bukti.",

    'pembulian_bukti_received' => "✅ Bukti diterima!\n\n"
        . "Sekarang siapa nama pembuli?",

    'pembulian_nama_pembuli' => "✅ Nama pembuli dicatat: *{nama_pembuli}*\n\n"
        . "Jurusan mereka apa?",

    'pembulian_confirm' => "✅ *Laporan Pembulian Tersimpan*\n\n"
        . "📋 ID: {id}\n"
        . "👤 Anda: {nama} ({nim})\n"
        . "🚨 Pembuli: {nama_pembuli} ({jurusan_pembuli})\n"
        . "✏️ Detail: {detail}\n\n"
        . "Laporan Anda sudah diteruskan ke staff. Kami akan follow up! 🙏",

    // KEUANGAN
    'keuangan_start' => "💰 *KATEGORI: KEUANGAN*\n\n"
        . "Saya siap membantu dengan masalah keuangan.\n\n"
        . "Ceritakan masalah Anda:\n"
        . "- Kesulitan membayar apa?\n"
        . "- Butuh bantuan apa?",

    'keuangan_confirm' => "✅ *Laporan Keuangan Tersimpan*\n\n"
        . "📋 ID: {id}\n"
        . "👤 {nama} ({nim})\n"
        . "💰 Detail: {detail}\n\n"
        . "Tim akan menghubungi Anda segera! 🤝",

    // MATA KULIAH
    'matkul_start' => "📚 *KATEGORI: MATA KULIAH*\n\n"
        . "Saya siap membantu dengan mata kuliah!\n\n"
        . "Mata kuliah apa yang ingin diberi feedback?",

    'matkul_list' => "Pilih mata kuliah:\n\n"
        . "1️⃣ Basis Data\n"
        . "2️⃣ Pemrograman Web\n"
        . "3️⃣ Sistem Operasi\n"
        . "4️⃣ Jaringan Komputer\n"
        . "5️⃣ Machine Learning\n"
        . "6️⃣ Lainnya (ketik nama)",

    'matkul_feedback' => "Ceritakan feedback Anda untuk *{mata_kuliah}*:\n"
        . "- Apa yang bagus?\n"
        . "- Apa yang perlu diperbaiki?\n"
        . "- Saran Anda?",

    'matkul_confirm' => "✅ *Feedback Mata Kuliah Tersimpan*\n\n"
        . "📋 ID: {id}\n"
        . "👤 {nama} ({nim})\n"
        . "📚 Mata Kuliah: {mata_kuliah}\n"
        . "💬 Feedback: {feedback}\n\n"
        . "Terima kasih atas feedback Anda! 🙏",

    // UMUM
    'umum_start' => "💬 *KATEGORI: UMUM*\n\n"
        . "Topik apa yang ingin dibicarakan?",

    'umum_detail' => "Ceritakan detail topik Anda:\n"
        . "(Topik, pertanyaan, saran, dll)",

    'umum_confirm' => "✅ *Konsultasi Umum Tersimpan*\n\n"
        . "📋 ID: {id}\n"
        . "👤 {nama} ({nim})\n"
        . "📌 Topik: {topik}\n"
        . "💬 Detail: {detail}\n\n"
        . "Tim akan review dan follow up! 🙏",

    'end_session' => "👋 *Terima kasih telah menggunakan Chatbot Konsultasi!*\n\n"
        . "Jika ada yang lain, ketik 'Halo' untuk mulai baru.",
];

// ============================================
// FORMAT RESPONSE
// ============================================

function format_response($type, $data = []) {
    global $responses;
    
    if (!isset($responses[$type])) {
        return "Maaf, terjadi kesalahan. Silakan coba lagi.";
    }
    
    $response = $responses[$type];
    
    foreach ($data as $key => $value) {
        $response = str_replace('{' . $key . '}', $value, $response);
    }
    
    return $response;
}

// ============================================
// VALIDATE NAMA
// ============================================

function validate_nama($nama) {
    $nama = trim($nama);
    if (strlen($nama) < 3) {
        return ['valid' => false];
    }
    return ['valid' => true, 'nama' => format_nama($nama)];
}

function format_nama($nama) {
    return ucwords(strtolower(trim($nama)));
}

// ============================================
// VALIDATE NIM
// ============================================

function validate_nim($nim) {
    $nim = preg_replace('/\D/', '', $nim);
    
    if (strlen($nim) !== 10 || !is_numeric($nim)) {
        return ['valid' => false];
    }
    
    return ['valid' => true, 'nim' => $nim];
}

// ============================================
// NORMALIZE JURUSAN
// ============================================

function normalize_jurusan($input) {
    $input = strtolower(trim($input));
    
    $mapping = [
        'sistem informasi' => 'Sistem Informasi',
        'si' => 'Sistem Informasi',
        'bis' => 'Sistem Informasi',
        'bisnis informasi sistem' => 'Sistem Informasi',
        'business information system' => 'Sistem Informasi',
        
        'teknik sipil' => 'Teknik Sipil',
        'ts' => 'Teknik Sipil',
        'ce' => 'Teknik Sipil',
        'sipil' => 'Teknik Sipil',
        'civil engineering' => 'Teknik Sipil',
        'teksip' => 'Teknik Sipil',
        'teksipil' => 'Teknik Sipil',

        'business management' => 'Business Management',
        'manajemen bisnis' => 'Business Management',
        'bm' => 'Business Management',
        'mb' => 'Business Management',
        'bisnis manajemen' => 'Business Management',

        'f&b retail management' => 'F&B Retail Management',
        'f&b' => 'F&B Retail Management',
        'fb' => 'F&B Retail Management',

        'architecture' => 'Architecture',
        'arsitektur' => 'Architecture',
        'arch' => 'Architecture',
        'ar' => 'Architecture',

        'interior design' => 'Interior Design',
        'desain interior' => 'Interior Design',
        'interior' => 'Interior Design',
        'di' => 'Interior Design',

        'urban planning' => 'Urban Planning',
        'perencanaan wilayah kota' => 'Urban Planning',
        'pwk' => 'Urban Planning',
        'planologi' => 'Urban Planning',
        'up' => 'Urban Planning',

        'visual communication design' => 'Visual Communication Design',
        'desain komunikasi visual' => 'Visual Communication Design',
        'dkv' => 'Visual Communication Design',
        'visual design' => 'Visual Communication Design',
        'vcd' => 'Visual Communication Design',

        'informatics' => 'Informatics',
        'teknik informatika' => 'Informatics',
        'informatika' => 'Informatics',
        'ti' => 'Informatics',
        'if' => 'Informatics',
        'it' => 'Informatics',

        'hospitality and tourism' => 'Hospitality and Tourism',
        'hospitality' => 'Hospitality and Tourism',
        'pariwisata' => 'Hospitality and Tourism',
        'hospart' => 'Hospitality and Tourism',
        'ht' => 'Hospitality and Tourism',

        'retail management' => 'Retail Management',
        'manajemen ritel' => 'Retail Management',
        'retail' => 'Retail Management',
        'ritel' => 'Retail Management',
        'rm' => 'Retail Management',

        'accounting' => 'Accounting',
        'akuntansi' => 'Accounting',
        'acc' => 'Accounting',
        'akun' => 'Accounting',

        'culinary arts' => 'Culinary Arts',
        'kuliner' => 'Culinary Arts',
        'culinary' => 'Culinary Arts',
        'ca' => 'Culinary Arts',
    ];
    
    if (isset($mapping[$input])) {
        return $mapping[$input];
    }
    
    // If not in mapping, accept it anyway
    return ucwords($input);
}

// ============================================
// NORMALIZE KATEGORI
// ============================================

function normalize_kategori($input) {
    $input = strtolower(trim($input));
    
    $mapping = [
        'pembulian' => 'pembulian',
        'bullying' => 'pembulian',
        'keuangan' => 'keuangan',
        'uang' => 'keuangan',
        'mata kuliah' => 'mata_kuliah',
        'matkul' => 'mata_kuliah',
        'umum' => 'umum',
        'lain' => 'umum',
        'general' => 'umum',
        '1' => 'pembulian',
        '2' => 'keuangan',
        '3' => 'mata_kuliah',
        '4' => 'umum',
    ];
    
    return isset($mapping[$input]) ? $mapping[$input] : null;
}

// ============================================
// GET OR CREATE SESSION (UPDATED)
// ============================================

function get_or_create_session($chatId) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("
            SELECT * FROM session_konsultasi 
            WHERE chat_id = ?
        ");
        $stmt->execute([$chatId]);
        $session = $stmt->fetch();
        
        if ($session) {
            $session['data_temp'] = json_decode($session['data_temp'], true) ?? [];
            return $session;
        }
        
        // Create new session
        $stmt = $pdo->prepare("
            INSERT INTO session_konsultasi 
            (chat_id, status, data_temp, created_at, updated_at)
            VALUES (?, ?, ?, NOW(), NOW())
        ");
        $stmt->execute([
            $chatId,
            'waiting_nama',
            json_encode([])
        ]);
        
        return get_or_create_session($chatId);
        
    } catch (Exception $e) {
        error_log("❌ Session error: " . $e->getMessage());
        return null;
    }
}

// ============================================
// UPDATE SESSION (UPDATED)
// ============================================

function update_session($chatId, $status, $data = []) {
    global $pdo;
    
    try {
        // Extract user data if provided
        $nama = $data['nama'] ?? null;
        $jurusan = $data['jurusan'] ?? null;
        $nim = $data['nim'] ?? null;
        $kategori = $data['kategori'] ?? null;
        
        // Keep only temp data
        $data_temp = $data['data_temp'] ?? [];
        
        $stmt = $pdo->prepare("
            UPDATE session_konsultasi 
            SET status = ?, 
                nama = ?, 
                jurusan = ?, 
                nim = ?, 
                kategori = ?, 
                data_temp = ?, 
                updated_at = NOW()
            WHERE chat_id = ?
        ");
        
        $stmt->execute([
            $status,
            $nama,
            $jurusan,
            $nim,
            $kategori,
            json_encode($data_temp),
            $chatId
        ]);
        
        return true;
    } catch (Exception $e) {
        error_log("❌ Update session error: " . $e->getMessage());
        return false;
    }
}

// ============================================
// SAVE KONSULTASI (UPDATED - ADVANCED)
// ============================================

function save_konsultasi($chatId, $session, $kategori, $userQuery) {
    global $pdo;
    
    try {
        $nama = $session['nama'];
        $nim = $session['nim'];
        $jurusan = $session['jurusan'];
        $data_temp = $session['data_temp'] ?? [];
        
        // Base fields
        $fields = [
            'chat_id' => $chatId,
            'nama' => $nama,
            'nim' => $nim,
            'jurusan' => $jurusan,
            'kategori' => $kategori,
            'detail' => substr($userQuery, 0, 2000),
        ];
        
        // Add category-specific fields
        if ($kategori === 'pembulian') {
            $fields['bukti_pembulian'] = $data_temp['bukti'] ?? null;
            $fields['nama_pembuli'] = $data_temp['nama_pembuli'] ?? null;
            $fields['jurusan_pembuli'] = $data_temp['jurusan_pembuli'] ?? null;
        } elseif ($kategori === 'keuangan') {
            $fields['keuangan_detail'] = substr($userQuery, 0, 2000);
        } elseif ($kategori === 'mata_kuliah') {
            $fields['mata_kuliah_name'] = $data_temp['mata_kuliah'] ?? null;
            $fields['feedback_dosen'] = substr($userQuery, 0, 2000);
        } elseif ($kategori === 'umum') {
            $fields['umum_topik'] = $data_temp['topik'] ?? null;
            $fields['umum_detail'] = substr($userQuery, 0, 2000);
        }
        
        // Build INSERT query
        $columns = implode(', ', array_keys($fields));
        $placeholders = implode(', ', array_fill(0, count($fields), '?'));
        $values = array_values($fields);
        
        $stmt = $pdo->prepare("
            INSERT INTO konsultasi ($columns)
            VALUES ($placeholders)
        ");
        $stmt->execute($values);
        
        return $pdo->lastInsertId();
        
    } catch (Exception $e) {
        error_log("❌ Save konsultasi error: " . $e->getMessage());
        return null;
    }
}

// ============================================
// GET MATA KULIAH
// ============================================

function get_mata_kuliah_list() {
    global $pdo;
    
    try {
        $stmt = $pdo->query("SELECT * FROM mata_kuliah ORDER BY nama ASC");
        return $stmt->fetchAll();
    } catch (Exception $e) {
        error_log("❌ Get mata kuliah error: " . $e->getMessage());
        return [];
    }
}

?>
