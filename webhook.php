<?php
/**
 * WEBHOOK CHATBOT V2 - ADVANCED
 */

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/webhook_error.log');

$start_time = microtime(true);
error_log("=== WEBHOOK START ===");

try {
    require_once __DIR__ . '/config.php';
    require_once __DIR__ . '/functions.php';
} catch (Exception $e) {
    http_response_code(500);
    error_log("❌ FATAL: " . $e->getMessage());
    die(json_encode(['error' => $e->getMessage()]));
}

$response_text = "Maaf, ada error. Silakan coba lagi.";

// ============================================
// READ INPUT
// ============================================

$rawInput = file_get_contents('php://input');

if (strlen($rawInput) < 10) {
    http_response_code(400);
    die(json_encode(['error' => 'Input too short']));
}

$input = json_decode($rawInput, true);

if (!$input) {
    http_response_code(400);
    die(json_encode(['error' => 'Invalid JSON']));
}

// ============================================
// EXTRACT DATA
// ============================================

$queryResult = $input['queryResult'] ?? [];
$intent = $queryResult['intent']['displayName'] ?? 'UNKNOWN';
$userQuery = $queryResult['queryText'] ?? '';
$parameters = $queryResult['parameters'] ?? [];

$payload = $input['originalDetectIntentRequest']['payload'] ?? [];
$message = $payload['data']['message'] ?? [];
$from = $message['from'] ?? [];

$chatId = (string)($message['chat']['id'] ?? $from['id'] ?? 'unknown');
$firstName = $from['first_name'] ?? 'User';
$userName = trim($firstName . ($from['last_name'] ?? ''));

error_log("Intent: {$intent} | User: {$userName} | Query: {$userQuery}");

// ============================================
// GET SESSION
// ============================================

try {
    $session = get_or_create_session($chatId);
    if (!$session) throw new Exception("Session failed");
} catch (Exception $e) {
    http_response_code(500);
    error_log("❌ Session error: " . $e->getMessage());
    die(json_encode(['error' => 'Session error']));
}

// ============================================
// PROCESS FLOW
// ============================================

try {
    $currentStatus = $session['status'];
    
    // WELCOME
    if ($intent === 'Default Welcome Intent') {
        $response_text = format_response('welcome');
        update_session($chatId, 'waiting_nama', ['nama' => null, 'jurusan' => null, 'nim' => null]);
    }
    
    // STEP 1: INPUT NAMA
    elseif ($currentStatus === 'waiting_nama') {
        $nama = $userQuery;
        $validated = validate_nama($nama);
        
        if ($validated['valid']) {
            $response_text = format_response('confirm_nama', ['nama' => $validated['nama']]);
            update_session($chatId, 'waiting_jurusan', [
                'nama' => $validated['nama'],
                'jurusan' => null,
                'nim' => null
            ]);
        } else {
            $response_text = format_response('error_nama');
        }
    }
    
    // STEP 2: INPUT JURUSAN
    elseif ($currentStatus === 'waiting_jurusan') {
        $jurusan = normalize_jurusan($userQuery);
        
        if (!empty($jurusan)) {
            $response_text = format_response('confirm_jurusan', ['jurusan' => $jurusan]);
            update_session($chatId, 'waiting_nim', [
                'nama' => $session['nama'],
                'jurusan' => $jurusan,
                'nim' => null
            ]);
        } else {
            $response_text = format_response('ask_jurusan');
        }
    }
    
    // STEP 3: INPUT NIM
    elseif ($currentStatus === 'waiting_nim') {
        $validated = validate_nim($userQuery);
        
        if ($validated['valid']) {
            $response_text = format_response('confirm_nim', [
                'nama' => $session['nama'],
                'jurusan' => $session['jurusan'],
                'nim' => $validated['nim']
            ]);
            update_session($chatId, 'waiting_kategori', [
                'nama' => $session['nama'],
                'jurusan' => $session['jurusan'],
                'nim' => $validated['nim']
            ]);
        } else {
            $response_text = format_response('error_nim');
        }
    }
    
    // STEP 4: CHOOSE KATEGORI
    elseif ($currentStatus === 'waiting_kategori') {
        $kategori = normalize_kategori($userQuery);
        
        if ($kategori) {
            if ($kategori === 'pembulian') {
                $response_text = format_response('pembulian_start');
            } elseif ($kategori === 'keuangan') {
                $response_text = format_response('keuangan_start');
            } elseif ($kategori === 'mata_kuliah') {
                $response_text = format_response('matkul_start');
            } elseif ($kategori === 'umum') {
                $response_text = format_response('umum_start');
            }
            
            update_session($chatId, "waiting_{$kategori}_detail", [
                'nama' => $session['nama'],
                'jurusan' => $session['jurusan'],
                'nim' => $session['nim'],
                'kategori' => $kategori
            ]);
        } else {
            $response_text = format_response('error_kategori');
        }
    }
    
    // ============================================
    // PEMBULIAN FLOW
    // ============================================
    
    elseif ($currentStatus === 'waiting_pembulian_detail') {
        // First ask for detail
        $response_text = format_response('pembulian_detail');
        $data_temp = $session['data_temp'] ?? [];
        $data_temp['detail'] = substr($userQuery, 0, 2000);
        update_session($chatId, 'waiting_pembulian_bukti', array_merge([
            'nama' => $session['nama'],
            'jurusan' => $session['jurusan'],
            'nim' => $session['nim'],
            'kategori' => 'pembulian'
        ], ['data_temp' => $data_temp]));
    }
    
    elseif ($currentStatus === 'waiting_pembulian_bukti') {
        $data_temp = $session['data_temp'] ?? [];
        
        if (strtolower($userQuery) === 'skip') {
            $data_temp['bukti'] = 'tidak ada';
        } else {
            $data_temp['bukti'] = substr($userQuery, 0, 500);
        }
        
        $response_text = format_response('pembulian_bukti_received');
        update_session($chatId, 'waiting_pembulian_nama_pembuli', array_merge([
            'nama' => $session['nama'],
            'jurusan' => $session['jurusan'],
            'nim' => $session['nim'],
            'kategori' => 'pembulian'
        ], ['data_temp' => $data_temp]));
    }
    
    elseif ($currentStatus === 'waiting_pembulian_nama_pembuli') {
        $data_temp = $session['data_temp'] ?? [];
        $data_temp['nama_pembuli'] = substr(format_nama($userQuery), 0, 100);
        
        $response_text = format_response('pembulian_nama_pembuli', [
            'nama_pembuli' => $data_temp['nama_pembuli']
        ]);
        update_session($chatId, 'waiting_pembulian_jurusan_pembuli', array_merge([
            'nama' => $session['nama'],
            'jurusan' => $session['jurusan'],
            'nim' => $session['nim'],
            'kategori' => 'pembulian'
        ], ['data_temp' => $data_temp]));
    }
    
    elseif ($currentStatus === 'waiting_pembulian_jurusan_pembuli') {
        $data_temp = $session['data_temp'] ?? [];
        $data_temp['jurusan_pembuli'] = normalize_jurusan($userQuery);
        
        // Save to database
        $konsultasi_id = save_konsultasi($chatId, array_merge($session, ['data_temp' => $data_temp]), 'pembulian', $data_temp['detail'] ?? '');
        
        if ($konsultasi_id) {
            $response_text = format_response('pembulian_confirm', [
                'id' => $konsultasi_id,
                'nama' => $session['nama'],
                'nim' => $session['nim'],
                'nama_pembuli' => $data_temp['nama_pembuli'],
                'jurusan_pembuli' => $data_temp['jurusan_pembuli'],
                'detail' => substr($data_temp['detail'] ?? '', 0, 50)
            ]);
            update_session($chatId, 'selesai', ['nama' => $session['nama'], 'jurusan' => $session['jurusan'], 'nim' => $session['nim']]);
        } else {
            $response_text = "⚠️ Error menyimpan data.";
        }
    }
    
    // ============================================
    // KEUANGAN FLOW (SIMPLE)
    // ============================================
    
    elseif ($currentStatus === 'waiting_keuangan_detail') {
        $konsultasi_id = save_konsultasi($chatId, $session, 'keuangan', $userQuery);
        
        if ($konsultasi_id) {
            $response_text = format_response('keuangan_confirm', [
                'id' => $konsultasi_id,
                'nama' => $session['nama'],
                'nim' => $session['nim'],
                'detail' => substr($userQuery, 0, 50)
            ]);
            update_session($chatId, 'selesai', ['nama' => $session['nama'], 'jurusan' => $session['jurusan'], 'nim' => $session['nim']]);
        } else {
            $response_text = "⚠️ Error menyimpan data.";
        }
    }
    
    // ============================================
    // MATA KULIAH FLOW
    // ============================================
    
    elseif ($currentStatus === 'waiting_mata_kuliah_detail') {
        // Ask for mata kuliah selection
        $response_text = format_response('matkul_list');
        update_session($chatId, 'waiting_matkul_choice', [
            'nama' => $session['nama'],
            'jurusan' => $session['jurusan'],
            'nim' => $session['nim'],
            'kategori' => 'mata_kuliah'
        ]);
    }
    
    elseif ($currentStatus === 'waiting_matkul_choice') {
        $matkul_list = get_mata_kuliah_list();
        $mata_kuliah = null;
        
        // Try to match input with list
        $input_lower = strtolower(trim($userQuery));
        foreach ($matkul_list as $mk) {
            if (strtolower($mk['nama']) === $input_lower || $input_lower === $mk['id']) {
                $mata_kuliah = $mk['nama'];
                break;
            }
        }
        
        // If not found, accept custom input
        if (!$mata_kuliah) {
            $mata_kuliah = substr($userQuery, 0, 100);
        }
        
        $data_temp = $session['data_temp'] ?? [];
        $data_temp['mata_kuliah'] = $mata_kuliah;
        
        $response_text = format_response('matkul_feedback', ['mata_kuliah' => $mata_kuliah]);
        update_session($chatId, 'waiting_matkul_feedback', array_merge([
            'nama' => $session['nama'],
            'jurusan' => $session['jurusan'],
            'nim' => $session['nim'],
            'kategori' => 'mata_kuliah'
        ], ['data_temp' => $data_temp]));
    }
    
    elseif ($currentStatus === 'waiting_matkul_feedback') {
        $data_temp = $session['data_temp'] ?? [];
        
        $konsultasi_id = save_konsultasi($chatId, array_merge($session, ['data_temp' => $data_temp]), 'mata_kuliah', $userQuery);
        
        if ($konsultasi_id) {
            $response_text = format_response('matkul_confirm', [
                'id' => $konsultasi_id,
                'nama' => $session['nama'],
                'nim' => $session['nim'],
                'mata_kuliah' => $data_temp['mata_kuliah'],
                'feedback' => substr($userQuery, 0, 50)
            ]);
            update_session($chatId, 'selesai', ['nama' => $session['nama'], 'jurusan' => $session['jurusan'], 'nim' => $session['nim']]);
        } else {
            $response_text = "⚠️ Error menyimpan data.";
        }
    }
    
    // ============================================
    // UMUM FLOW
    // ============================================
    
    elseif ($currentStatus === 'waiting_umum_detail') {
        // Ask for topic
        $response_text = format_response('umum_detail');
        $data_temp = $session['data_temp'] ?? [];
        $data_temp['topik'] = substr($userQuery, 0, 100);
        update_session($chatId, 'waiting_umum_detail_full', array_merge([
            'nama' => $session['nama'],
            'jurusan' => $session['jurusan'],
            'nim' => $session['nim'],
            'kategori' => 'umum'
        ], ['data_temp' => $data_temp]));
    }
    
    elseif ($currentStatus === 'waiting_umum_detail_full') {
        $data_temp = $session['data_temp'] ?? [];
        
        $konsultasi_id = save_konsultasi($chatId, array_merge($session, ['data_temp' => $data_temp]), 'umum', $userQuery);
        
        if ($konsultasi_id) {
            $response_text = format_response('umum_confirm', [
                'id' => $konsultasi_id,
                'nama' => $session['nama'],
                'nim' => $session['nim'],
                'topik' => $data_temp['topik'],
                'detail' => substr($userQuery, 0, 50)
            ]);
            update_session($chatId, 'selesai', ['nama' => $session['nama'], 'jurusan' => $session['jurusan'], 'nim' => $session['nim']]);
        } else {
            $response_text = "⚠️ Error menyimpan data.";
        }
    }
    
    // END
    elseif ($intent === 'Akhiri.Konsultasi' || $currentStatus === 'selesai') {
        $response_text = format_response('end_session');
        update_session($chatId, 'waiting_nama', ['nama' => null, 'jurusan' => null, 'nim' => null]);
    }
    
    // DEFAULT
    else {
        $response_text = "Maaf, silakan ulangi atau ketik 'Halo' untuk mulai.";
    }
    
} catch (Exception $e) {
    error_log("❌ Exception: " . $e->getMessage());
    $response_text = "Maaf, ada error. Silakan coba lagi.";
}

// ============================================
// SAFETY CHECK & SEND RESPONSE
// ============================================

if (empty($response_text) || !is_string($response_text)) {
    $response_text = "Maaf, ada error. Silakan coba lagi.";
}

error_log("Response: " . substr($response_text, 0, 80));
$elapsed = microtime(true) - $start_time;
error_log("=== WEBHOOK END ({$elapsed}ms) ===\n");

$response = [
    'fulfillmentText' => $response_text,
    'fulfillmentMessages' => [[
        'text' => ['text' => [$response_text]]
    ]]
];

header('Content-Type: application/json');
echo json_encode($response);
exit;
?>
