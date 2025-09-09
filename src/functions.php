<?php
// Simple in-memory data and helper functions
function getPets() {
    return [
        ['id' => 1, 'name' => 'French Bulldog', 'available' => true],
        ['id' => 2, 'name' => 'Corgi', 'available' => false],
        ['id' => 3, 'name' => 'Shiba Inu', 'available' => true],
    ];
}

function getTables() {
    return [
        ['id' => 1, 'name' => 'Table 1'],
        ['id' => 2, 'name' => 'Table 2'],
        ['id' => 3, 'name' => 'Table 3'],
    ];
}

function checkPetAvailable(int $petId): bool {
    foreach (getPets() as $pet) {
        if ($pet['id'] === $petId) {
            return $pet['available'];
        }
    }
    return true;
}

function checkTableAvailable(int $tableId, string $dateTime): bool {
    // For demo purposes, table 2 is always booked
    if ($tableId === 2) {
        return false;
    }
    return true;
}

function reserve(array $data): void {
    // In a real app this would insert into database
    $_SESSION['reservation'] = $data;
}

function getMenuItems(): array {
    return [
        ['id' => 1, 'name' => 'Latte', 'price' => 80],
        ['id' => 2, 'name' => 'Cake', 'price' => 120],
        ['id' => 3, 'name' => 'Smoothie', 'price' => 90],
    ];
}
