<?php

function generateTicketNumber($departmentId) {
    global $pdo;
    $date = date('Ymd');
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM queue_tickets WHERE DATE(created_at) = CURDATE() AND department_id = ?");
    $stmt->execute([$departmentId]);
    $count = $stmt->fetchColumn();
    $number = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
    return "D{$departmentId}{$date}{$number}";
}

function addToQueue($patientName, $departmentId) {
    global $pdo;
    $ticketNumber = generateTicketNumber($departmentId);
    $stmt = $pdo->prepare("INSERT INTO queue_tickets (ticket_number, department_id, patient_name) VALUES (?, ?, ?)");
    return $stmt->execute([$ticketNumber, $departmentId, $patientName]);
}

function getQueueStatus($departmentId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM queue_tickets WHERE department_id = ? AND DATE(created_at) = CURDATE() ORDER BY created_at ASC");
    $stmt->execute([$departmentId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateTicketStatus($ticketId, $status) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE queue_tickets SET status = ? WHERE id = ?");
    return $stmt->execute([$status, $ticketId]);
}
