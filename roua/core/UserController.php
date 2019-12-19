<?PHP


include('phpMailer/PHPMailer.php');

class UserController
{

	function addUser(User $user)
	{
		try {
			$sql = "insert into user (id,username,name,surname,email,password,role,number) values (
				null, 
				'" . $user->getUsername() . "',
				'" . $user->getName() . "',
				'" . $user->getSurname() . "',
				'" . $user->getEmail() . "',
				'" . $user->getPassword() . "',
				'" . $user->getRole() . "',
				" . $user->getNumber() . "
				)";
			$this->executeSql($sql);
			return true;
		} catch (Exception $e) {
			return $e->getMessage() . ' ' . $sql;
		}
	}

	function deleteUser($id)
	{
		$sql = "delete from user where id=" . $id;
		$this->executeSql($sql);
		return $sql;
	}

	function findUser($email, $password)
	{
		$sql = "SELECT * from user where email='" . $email . "' and password='" . $password . "' LIMIT 1";
		$db  = Config::getConnection();
		try {
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$row = $stmt->fetch();
			if (empty($row["id"])) {
				return null;
			} else {
				$user = new User();
				$user->setName($row["name"]);
				$user->setSurname($row["surname"]);
				$user->setFidelity(0);
				$user->setUsername($row["username"]);
				$user->setId($row["id"]);
				$user->setEmail($row["email"]);
				$user->setRole($row["role"]);
				$user->setNumber($row["number"]);
				return $user;
			}
		} catch (Exception $e) {
			return $e->getMessage() . ' ' . $sql;
		}
	}


	function getUsersByRoles($role)
	{
		$sql = "SElECT * From user where role = '" . $role . "'";
		$db  = Config::getConnection();
		try {
			$list = $db->query($sql);
			return $list;
		} catch (Exception $e) {
			die('Error: ' . $e->getMessage());
		}
	}

	function searchUsersByName($name)
	{
		$sql = "SElECT * From USER WHERE (name LIKE '%" . $name . "%') OR (surname LIKE '%" . $name . "%')";
		$db  = Config::getConnection();
		try {
			$list = $db->query($sql);
			return $list;
		} catch (Exception $e) {
			die('Error: ' . $e->getMessage());
		}
	}


	function getUsers()
	{
		$sql = "SElECT * From user";
		$db  = Config::getConnection();
		try {
			$list = $db->query($sql);
			return $list;
		} catch (Exception $e) {
			die('Error: ' . $e->getMessage());
		}
	}


	function updateUser(User $user)
	{
		$sql = "UPDATE user SET name=:name, surname=:surname,username=:username,
		email=:email,number=:number, role=:role where id= :id ";
		$db  = Config::getConnection();
		$req = $db->prepare($sql);
		try {
			$req->bindValue(':id', $user->getId());
			$req->bindValue(':name', $user->getName());
			$req->bindValue(':surname', $user->getSurname());
			$req->bindValue(':username', $user->getUsername());
			$req->bindValue(':email', $user->getEmail());
			$req->bindValue(':role', $user->getRole());
			$req->bindValue(':number', $user->getNumber());
			$req->execute();
			return true;
		} catch (Exception $e) {

			return null;
		}
	}



	function findUserById($id)
	{
		$sql = "SELECT * from user where id=" . $id . " LIMIT 1";
		$db  = Config::getConnection();
		try {
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$row = $stmt->fetch();
			if (empty($row["id"])) {
				return null;
			} else {
				$user = new User();
				$user->setName($row["name"]);
				$user->setSurname($row["surname"]);
				$user->setRole($row["role"]);
				$user->setUsername($row["username"]);
				$user->setId($row["id"]);
				$user->setEmail($row["email"]);
				$user->setNumber($row["number"]);
				$user->setFidelity($row["fidelity"]);
				return $user;
			}
		} catch (Exception $e) {
			return $e->getMessage() . ' ' . $sql;
		}
	}

	function executeSql($sql)
	{
		$db  = Config::getConnection();
		$req = null;
		try {
			$req = $db->prepare($sql);
			$s   = $req->execute();
		} catch (Exception $e) {
			var_dump(" Error Connection ! " . $e->getMessage());
		}
	}

	public static function sendEmail($subject, $message, $email)
	{
		$password = "roua1997";
		$gmail    = "roua.maknin@esprit.tn";
		$mail     = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug  = 1; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth   = true; // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
		$mail->Host       = "smtp.gmail.com";
		$mail->Port       = 465; // or 587
		$mail->IsHTML(true);
		$mail->Username = $gmail;
		$mail->Password = $password;
		try {
			$mail->SetFrom($gmail);
			$mail->Subject = $subject;
			$mail->Body    = $message;
			$mail->AddAddress($email);
			if (!$mail->Send()) {
				return "Mailer Error: " . $mail->ErrorInfo;
			} else {
				return "Message has been sent";
			}
		} catch (\phpMailer\Exception $e) {
			return $e->getMessage();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
