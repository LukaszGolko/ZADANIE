<?php

// Please add your logic here

echo "<h1 class='starting-title'>Nice to see you! &#128075;</h1>";

// Pobierz zawartość pliku JSON
$json_data = file_get_contents('./dataset/users.json');

// Przetwórz dane JSON na tablicę PHP
$data = json_decode($json_data, true);

// Sprawdź czy dane zostały poprawnie zdekodowane
if ($data !== null) {
    // Wyświetl dane jako tabelkę
    echo '<table>';
    echo '<tr><th>Name</th><th>Username</th><th>Email</th><th>Address</th><th>Phone</th><th>Company</th><th></th></tr>';
	   foreach ($data as $key => $item) {
        echo '<tr>';
        echo '<td>' . $item['name'] . '</td>';
        echo '<td>' . $item['username'] . '</td>';
		echo '<td><a href="mailto:' . $item['email'] . '">' . $item['email'] . '</a></td>';
		echo '<td>' . $item['address']['street'] . ', ' . $item['address']['zipcode'] . ', ' . $item['address']['city'] . '</td>';
		echo '<td>' . $item['phone'] . '</td>';
		echo '<td>' . $item['company']['name'] . '</td>';
		echo '<td><a href="?delete=' . $key . '">REMOVE</a></td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    // Błąd dekodowania JSON
    echo "Błąd dekodowania JSON.";
}
// Usuwanie rekordu
if (isset($_GET['delete'])) {
    $deleteKey = $_GET['delete'];

    if (array_key_exists($deleteKey, $data)) {
        // Usuń rekord o podanym kluczu
        unset($data[$deleteKey]);

        // Zapisz zmienioną tablicę danych do pliku JSON
        file_put_contents('./dataset/users.json', json_encode($data));

        // Odśwież stronę
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>