<?php
// ไฟล์นี้จำลองการเชื่อมต่อฐานข้อมูลด้วยอาเรย์

function getAvailableAnimals(): array {
    // ในระบบจริงควรดึงจากฐานข้อมูล
    return [
        ['id' => 1, 'name' => 'โอโม่', 'status' => 'ready'],
        ['id' => 2, 'name' => 'ชิบุย่า', 'status' => 'ready'],
        ['id' => 3, 'name' => 'มอคค่า', 'status' => 'not_ready'],
    ];
}

function getTables(): array {
    return [
        ['id' => 1, 'name' => 'โต๊ะ 1'],
        ['id' => 2, 'name' => 'โต๊ะ 2'],
        ['id' => 3, 'name' => 'โต๊ะ 3'],
    ];
}

function isAnimalAvailable(int $animalId): bool {
    foreach (getAvailableAnimals() as $animal) {
        if ($animal['id'] === $animalId) {
            return $animal['status'] === 'ready';
        }
    }
    return false;
}

function isTableAvailable(int $tableId, string $datetime): bool {
    // ตัวอย่างเช็คแบบง่าย: ตรวจสอบไฟล์จองที่เก็บไว้
    $file = __DIR__ . '/bookings.json';
    if (!file_exists($file)) {
        return true;
    }
    $bookings = json_decode(file_get_contents($file), true);
    foreach ($bookings as $booking) {
        if ($booking['table_id'] == $tableId && $booking['datetime'] == $datetime) {
            return false; // มีคนจองแล้ว
        }
    }
    return true;
}

function saveBooking(array $data): void {
    $file = __DIR__ . '/bookings.json';
    $bookings = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $bookings[] = $data;
    file_put_contents($file, json_encode($bookings, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
}
?>
