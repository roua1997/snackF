<?PHP
class RequestFidelity
{
	protected $id;
	protected $idFidelity;
	protected $fidelityName;
	protected $idUser;
	protected $userName;
	protected $status;

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getIdFidelity() {
		return $this->idFidelity;
	}

	/**
	 * @param mixed $idFidelity
	 */
	public function setIdFidelity( $idFidelity ) {
		$this->idFidelity = $idFidelity;
	}

	/**
	 * @return mixed
	 */
	public function getIdUser() {
		return $this->idUser;
	}

	/**
	 * @param mixed $idUser
	 */
	public function setIdUser( $idUser ) {
		$this->idUser = $idUser;
	}

	/**
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param mixed $status
	 */
	public function setStatus( $status ) {
		$this->status = $status;
	}

	/**
	 * @return mixed
	 */
	public function getFidelityName() {
		return $this->fidelityName;
	}

	/**
	 * @param mixed $fidelityName
	 */
	public function setFidelityName( $fidelityName ) {
		$this->fidelityName = $fidelityName;
	}

	/**
	 * @return mixed
	 */
	public function getUserName() {
		return $this->userName;
	}

	/**
	 * @param mixed $userName
	 */
	public function setUserName( $userName ) {
		$this->userName = $userName;
	}

}
