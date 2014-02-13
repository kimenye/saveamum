<?php
/**
 * Return an array containing list of user_donations
 *
 * @return array
 */
function user_donation_find_all()
{
	$db = option('db_conn');
	$sql = <<<SQL
	SELECT * 
	FROM user_donations 
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
 * Return selected row from user_donations table
 *
 * @param int $id 
 * @return array
 */
function user_donations_find($id)
{
	$db = option('db_conn');
	$sql = <<<SQL
	SELECT * 
	FROM user_donations where id=:id
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
 * Insert a new row in user_donation table
 * Return row's id
 *
 * @param array $data 
 * @return int or false
 */
function user_donations_create($type, $ref, $amount, $user_id)
{
	$db = option('db_conn');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
	$sql = <<<SQL
	INSERT INTO `user_donations` (`type`, `ref`, `amount`, `user_id`, `created_at`, `modified_at`) 
	VALUES (:type, :ref, :amount, :user_id, NOW(), NOW())
SQL;
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':type', $type, PDO::PARAM_STR);
	$stmt->bindValue(':ref', $ref, PDO::PARAM_STR);
	$stmt->bindValue(':amount', $amount, PDO::PARAM_STR);
	$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
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
function user_donations_update($user_id, $message)
{
	$db = option('db_conn');
	$sql = <<<SQL
	UPDATE `user_donations`
	SET message = :message, modified_at = NOW()
	WHERE id = :id
SQL;
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
	$stmt->bindValue(':message', $message, PDO::PARAM_STR);
	return $stmt->execute();
}

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