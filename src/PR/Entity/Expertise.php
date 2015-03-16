<?php
namespace PR\Entity;

/**
 * @Entity
 * @Table(name="expertise")
 **/
class Expertise
{
	/**
	 * @id @Column(type="integer")
	 * @GeneratedValue
	 **/
	protected $id;

	/**
	 * @Column(type="string")
	 */
	protected $discipline;

	/**
	 * Get the value of the discipline parameter
	 * @return string
	 */
	public function __toString()
	{
		return $this->getDiscipline();
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
	public function getDiscipline() {
		return $this->discipline;
	}

	/**
	 * @param mixed $discipline
	 *
	 * @return $this
	 */
	public function setDiscipline( $discipline ) {
		$this->discipline = $discipline;
		return $this;
	}
}
