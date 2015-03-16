<?php
namespace PR\Form\DataTransformer;

use PR\Entity\Expertise;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ExpertiseToDisciplineTransformer extends AbstractDataTransformer
{
    /**
     * @param Expertise $expertise
     *
     * @return String
     *
     */
    public function transform($expertise)
    {
        if (null === $expertise) {
            return "";
        }

        return $expertise->getDiscipline();
    }

    /**
     *
     * @param string $discipline
     *
     * @return Expertise
     */
    public function reverseTransform($discipline)
    {
        if ( ! $discipline) {
            return null;
        }

        $expertise = $this->entityManager
            ->getRepository('PR\Entity\Expertise')
            ->findOneBy(['discipline' => $discipline]);

        if (null === $expertise) {
            throw new TransformationFailedException(sprintf(
                'Expertise with discipline "%s" does not exist!',
                $discipline
            ));
        }

        return $expertise;
    }
}
