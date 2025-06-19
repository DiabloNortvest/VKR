<pre><?php
// Настройки подключения к базе данных
$host = 'localhost';     // Хост
$dbname = 'advokatskaya';        // Имя базы данных
$username = 'root';      // Имя пользователя
$password = '';          // Пароль

$exceptions=array('birthday'); // исключения

// Подключение к базе данных MySQL с использованием PDO
try {
	$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	// Устанавливаем режим ошибок
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Ошибка подключения: " . $e->getMessage();
	exit;
}

// Диапазон дат для случайных значений
$dt1 = '2025-05-01';
$dt2 = '2025-06-05';

// Запрос для получения всех столбцов с типами DATE, DATETIME и TIMESTAMP
$query = "
	SELECT TABLE_NAME, COLUMN_NAME
	FROM information_schema.COLUMNS
	WHERE TABLE_SCHEMA = :dbname
	AND DATA_TYPE IN ('date', 'datetime', 'timestamp')
";

// Подготовка запроса
$stmt = $pdo->prepare($query);
$stmt->bindParam(':dbname', $dbname, PDO::PARAM_STR);
$stmt->execute();

// Получаем все результаты
$columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Генерация случайной даты в заданном диапазоне
function generateRandomDate($startDate, $endDate) {
	$startTimestamp = strtotime($startDate);
	$endTimestamp = strtotime($endDate);
	$randomTimestamp = mt_rand($startTimestamp, $endTimestamp);
	return date('Y-m-d H:i:s', $randomTimestamp);  // Формат даты и времени YYYY-MM-DD HH:MM:SS
}

	// Обновляем каждый столбец с типом DATE, DATETIME или TIMESTAMP для каждой строки
	foreach ($columns as $column) {
		$tableName = $column['TABLE_NAME'];
		$columnName = $column['COLUMN_NAME'];

		if (!in_array($columnName, $exceptions)) { // если нет в исключениях, меняем!
			// Получаем все строки из текущей таблицы для обновления
			$selectQuery = "SELECT id FROM `$tableName` WHERE `$columnName` IS NOT NULL";
			$selectStmt = $pdo->prepare($selectQuery);
			$selectStmt->execute();
			$rows = $selectStmt->fetchAll(PDO::FETCH_ASSOC);

			// Для каждой строки генерируем случайную дату и обновляем
			foreach ($rows as $row) {
				$randomDate = generateRandomDate($dt1, $dt2);

				// Формируем SQL-запрос для обновления
				$updateQuery = "
					UPDATE `$tableName`
					SET `$columnName` = :randomDate
					WHERE id = :id
				";

				// Подготовка и выполнение обновления
				$updateStmt = $pdo->prepare($updateQuery);
				$updateStmt->bindParam(':randomDate', $randomDate, PDO::PARAM_STR);
				$updateStmt->bindParam(':id', $row['id'], PDO::PARAM_INT);
				$updateStmt->execute();

				echo "Обновлена строка id {$row['id']} в таблице `$tableName`, столбец `$columnName` на дату $randomDate\n";
			};
		};
	};
	echo "Все строки в столбцах с типом DATE, DATETIME и TIMESTAMP (кроме исключений!) были обновлены.\n";
?>
