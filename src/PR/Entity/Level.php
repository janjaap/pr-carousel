<?php
namespace PR\Entity;

/**
 * @Entity
 * @Table(name="level")
 **/
class Level
{
	/**
	 * @id @Column(type="integer")
	 * @GeneratedValue
	 **/
	protected $id;

	/**
	 * @Column(type="string")
	 */
	protected $indication;

	/**
	 * Get the value of the $this->indication parameter
	 * @return string
     */
	public function __toString()
	{
		return $this->getIndication();
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getIndication() {
		return $this->indication;
	}

	/**
	 * @param mixed $indication
	 *
	 * @return $this
	 */
	public function setIndication( $indication ) {
		$this->indication = $indication;
		return $this;
	}
}
