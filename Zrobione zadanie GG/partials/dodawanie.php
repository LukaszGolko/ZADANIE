<?php
echo '
<form method="POST" action="">
    <input type="text" name="name" id="name" autocomplete="name" placeholder="Name" required>

    <input type="text" name="username" id="username" autocomplete="username" placeholder="Username" required>

    <input type="email" name="email" id="email" autocomplete="email" placeholder="Email" required>

    <input type="text" name="street" id="street" placeholder="Street" required>

    <input type="text" name="zipcode" id="zipcode" placeholder="Zip code" required>

    <input type="text" name="city" id="city" placeholder="City" required>

    <input type="text" name="phone" id="phone" autocomplete="tel" placeholder="Phone number" required>

    <input type="text" name="company" id="company" autocomplete="company" placeholder="Company name" required>

    <input type="submit" value="SUBMIT">
</form>
';
// Dodania nowego użytkownika
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobierz dane przesłane z formularza
    $newUser = [
        'name' => $_POST['name'],
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'address' => [
            'street' => $_POST['street'],
            'zipcode' => $_POST['zipcode'],
            'city' => $_POST['city']
        ],
        'phone' => $_POST['phone'],
        'company' => [
            'name' => $_POST['company']
        ]
    ];

    // Dodaj nowego użytkownika do tablicy danych
    $data[] = $newUser;

    // Zapisz zmienioną tablicę danych do pliku JSON
    file_put_contents('./dataset/users.json', json_encode($data));

    // Odśwież stronę
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>