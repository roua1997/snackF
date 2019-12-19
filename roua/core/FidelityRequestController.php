<?PHP

class FidelityRequestController
{

	function addRequestFidelity(RequestFidelity $fidelityRequest)
	{
		try {
			$sql = "insert into fidelityrequest (id,user_name,id_user,fidelity_name,id_fidelity,status) values (
				null, 
				'" . $fidelityRequest->getUserName() . "',
				'" . $fidelityRequest->getIdUser() . "',
				'" . $fidelityRequest->getFidelityName() . "',
				'" . $fidelityRequest->getIdFidelity() . "',
				" . $fidelityRequest->getStatus() . "
				)";
			$this->executeSql($sql);
			var_dump($sql);
			return true;
		} catch (Exception $e) {
			//			return null;
			return $e->getMessage() . ' ' . $sql;
		}
	}

	function deleteRequestFidelity($id)
	{
		$sql = "delete from fidelityrequest where id=" . $id;
		$this->executeSql($sql);

		return $sql;
	}

	function getRequestByIdFidelity($id)
	{
		$sql = "SElECT * From fidelityrequest where id_fidelity=$id";
		$db  = Config::getConnection();
		try {
			$list = $db->query($sql);
			return $list;
		} catch (Exception $e) {
			die('Error: ' . $e->getMessage());
		}
	}

	function acceptRequestFidelity($id, $idu, $idf)
	{
		$sql     = "UPDATE fidelityrequest SET status=1 where id= :id ";
		$update  = 'update user u set u.fidelity = :value where u.id = :idu';
		$db      = Config::getConnection();
		$req     = $db->prepare($sql);
		$reqUser = $db->prepare($update);
		try {
			$req->bindValue(':id', $id);
			$req->execute();
			$reqUser->bindValue(':idu', $idu);
			$reqUser->bindValue(':value', $idf);
			$reqUser->execute();
			return true;
		} catch (Exception $e) {
			die('Error: ' . $e->getMessage());
		}
	}

	function refuseRequestFidelity($id)
	{
		$sql = "UPDATE fidelityrequest SET status=-1 where id= :id ";
		$db  = Config::getConnection();
		$req = $db->prepare($sql);
		try {
			$req->bindValue(':id', $id);
			$req->execute();
			var_dump($sql);

			return true;
		} catch (Exception $e) {
			die('Error: ' . $e->getMessage());
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

	function getRequests()
	{
		$sql = "SElECT * From fidelityrequest";
		$db  = Config::getConnection();
		try {
			$list = $db->query($sql);

			return $list;
		} catch (Exception $e) {
			die('Error: ' . $e->getMessage());
		}
	}

	function getMyRequests($id)
	{
		$sql = "SElECT * From fidelityrequest where id_user=$id";
		$db  = Config::getConnection();
		try {
			$list = $db->query($sql);

			return $list;
		} catch (Exception $e) {
			die('Error: ' . $e->getMessage());
		}
	}

	function updateRequestFidelity(RequestFidelity $fidelityRequest)
	{
		$sql = "UPDATE fidelityrequest SET name=:name, code=:code,value=:value where id= :id ";
		$db  = Config::getConnection();
		$req = $db->prepare($sql);
		try {
			$req->bindValue(':id', $fidelityRequest->getId());
			$req->bindValue(':name', $fidelityRequest->getName());
			$req->bindValue(':code', $fidelityRequest->getCode());
			$req->bindValue(':value', $fidelityRequest->getValue());
			$req->execute();

			return true;
		} catch (Exception $e) {
			$result = $req->queryString;
			$result = str_replace(":id", $fidelityRequest->getId(), $result);
			$result = str_replace(':name', $fidelityRequest->getName(), $result);
			$result = str_replace(':code', $fidelityRequest->getCode(), $result);
			$result = str_replace(':value', $fidelityRequest->getValue(), $result);

			return $e->getMessage() . ' ' . $result;
		}
	}

	function findRequestFidelityById($id)
	{
		$sql = "SELECT * from fidelityrequest where id=" . $id . " LIMIT 1";
		$db  = Config::getConnection();
		try {
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$row = $stmt->fetch();
			if (empty($row["id"])) {
				return null;
			} else {
				$fidelityRequest = new RequestFidelity();
				$fidelityRequest->setId($row["id"]);
				$fidelityRequest->setName($row["name"]);
				$fidelityRequest->setCode($row["code"]);
				$fidelityRequest->setValue($row["value"]);

				return $fidelityRequest;
			}
		} catch (Exception $e) {
			return $e->getMessage() . ' ' . $sql;
		}
	}
}
