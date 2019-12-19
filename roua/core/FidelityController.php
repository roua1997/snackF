<?PHP

class FidelityController
{

	function addFidelity(Fidelity $fidelity)
	{
		try {
			$sql = "insert into fidelity (id,name,code,value) values (
				null, 
				'" . $fidelity->getName() . "',
				'" . $fidelity->getCode() . "',
				'" . $fidelity->getValue() . "'
				)";
			$this->executeSql($sql);
			return true;
		} catch (Exception $e) {
			//			return null;
			return $e->getMessage() . ' ' . $sql;
		}
	}

	function deleteFidelity($id)
	{
		$sql = "delete from fidelity where id=" . $id;
		$this->executeSql($sql);
		return $sql;
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

	function getFidelities()
	{
		$sql = "SElECT * From fidelity";
		$db  = Config::getConnection();
		try {
			$list = $db->query($sql);
			return $list;
		} catch (Exception $e) {
			die('Error: ' . $e->getMessage());
		}
	}

	function updateFidelity(Fidelity $fidelity)
	{
		$sql = "UPDATE fidelity SET name=:name, code=:code,value=:value where id= :id ";
		$db  = Config::getConnection();
		$req = $db->prepare($sql);
		try {
			$req->bindValue(':id', $fidelity->getId());
			$req->bindValue(':name', $fidelity->getName());
			$req->bindValue(':code', $fidelity->getCode());
			$req->bindValue(':value', $fidelity->getValue());
			$req->execute();
			return true;
		} catch (Exception $e) {
			$result = $req->queryString;
			$result = str_replace(":id", $fidelity->getId(), $result);
			$result = str_replace(':name', $fidelity->getName(), $result);
			$result = str_replace(':code', $fidelity->getCode(), $result);
			$result = str_replace(':value', $fidelity->getValue(), $result);
			return $e->getMessage() . ' ' . $result;
		}
	}

	function findFidelityById($id)
	{
		$sql = "SELECT * from fidelity where id=" . $id . " LIMIT 1";
		$db  = Config::getConnection();
		try {
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$row = $stmt->fetch();
			if (empty($row["id"])) {
				return null;
			} else {
				$fidelity = new Fidelity();
				$fidelity->setId($row["id"]);
				$fidelity->setName($row["name"]);
				$fidelity->setCode($row["code"]);
				$fidelity->setValue($row["value"]);
				return $fidelity;
			}
		} catch (Exception $e) {
			return $e->getMessage() . ' ' . $sql;
		}
	}
}
