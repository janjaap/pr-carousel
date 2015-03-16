<?php
namespace PR\Entity;

/**
 * @Entity
 * @Table(name="developer")
 **/
class Developer
{
	/**
	 * @id @Column(type="integer")
	 * @GeneratedValue
	 **/
	protected $id;

	/**
	 * @Column(type="string")
	 */
	protected $name;

	/**
	 * @Column(type="string")
	 */
	protected $handle;

	/**
	 * @ManyToOne(targetEntity="Level")
	 * @JoinColumn(name="levelId", referencedColumnName="id")
	 **/
	protected $level;

	/**
	 * @ManyToMany(targetEntity="Expertise")
	 * @JoinTable(name="developer_expertise",
	 *      joinColumns={@JoinColumn(name="developerId", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="expertiseId", referencedColumnName="id")}
	 *      )
	 **/
	protected $expertise;

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 *
	 * @return $this
	 */
	public function setName( $name ) {
		$this->name = $name;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getHandle() {
		return $this->handle;
	}

	/**
	 * @param mixed $handle
	 *
	 * @return $this
	 */
	public function setHandle( $handle ) {
		$this->handle = $handle;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLevel() {
		return $this->level;
	}

	/**
	 * @param mixed $level
	 *
	 * @return $this
	 */
	public function setLevel( $level ) {
		$this->level = $level;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getExpertise()
	{
		return $this->expertise;
	}

	/**
	 * @param mixed $expertise
	 *
	 * @return $this
	 */
	public function setExpertise( $expertise )
	{
		$this->expertise = $expertise;
		return $this;
	}
}
