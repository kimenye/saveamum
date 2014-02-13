<?php
/**
 * Return an array containing ist of users
 *
 * @return array
 */
function user_find_all()
{
	$db = option('db_conn');
	$sql = <<<SQL
	SELECT * 
	FROM users 
	ORDER BY modified_at DESC
SQL;
	$result = array();
	$stmt = $db->prepare($sql);
	if ($stmt->execute())
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	return false;
}

/**
 * Return selected row from users table
 *
 * @param int $id 
 * @return array
 */
function user_find($id)
{
	$db = option('db_conn');
	$sql = <<<SQL
	SELECT * 
	FROM users where id=:id
SQL;
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':id', $id, PDO::PARAM_INT);
	if ($stmt->execute() && $row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		return $row;
	}
	return null;
}


/**
 * Insert a new row in users table
 * Return row's id
 *
 * @param array $data 
 * @return int or false
 */
function user_create($data)
{
	$db = option('db_conn');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
	$sql = <<<SQL
	INSERT INTO `users` (`type`, `external_id`, `email`, `created_at`, `modified_at`) 
	VALUES (:type, :external_id, :email, NOW(), NOW())
SQL;
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':type', $data['type'], PDO::PARAM_STR);
	$stmt->bindValue(':external_id', $data['external_id'], PDO::PARAM_STR);
	$stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
	if ($stmt->execute())
	{
		return $db->lastInsertId();
	}
	return false;
	
}

/**
 * Update a row in users table
 *
 * @param int $user_id
 * @param array $data
 * @return true or false
 */
// function user_update($user_id, $data)
// {
// 	$db = option('db_conn');
// 	$sql = <<<SQL
// 	UPDATE `posts`
// 	SET title = :title, body = :body, modified_at = DATETIME('NOW', 'localtime')
// 	WHERE id = :id
// SQL;
// 	$stmt = $db->prepare($sql);
// 	$stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
// 	$stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
// 	$stmt->bindValue(':body', $data['body'], PDO::PARAM_STR);
// 	return $stmt->execute();
// }

/**
 * Delete a row in posts table
 *
 * @param int $user_id
 * @return true or false
 */
// function user_destroy($post_id)
// {
// 	$db = option('db_conn');
// 	$sql = <<<SQL
// 	DELETE FROM `posts` 
// 	WHERE id = :id
// SQL;
// 	$stmt = $db->prepare($sql);
// 	$stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
// 	return $stmt->execute();
// }

?>