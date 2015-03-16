<?php
namespace PR\Form\DataTransformer;

use PR\Entity\Level;
use Symfony\Component\Form\Exception\TransformationFailedException;

class LevelToIndicationTransformer extends AbstractDataTransformer
{
    /**
     * Transforms an Level object to its string equivalent
     *
     * @param  Level|null $level
     *
     * @return string
     */
    public function transform($level)
    {
        if (null === $level || !is_a($level, 'PR\Entity\Level')) {
            return "";
        }

        return $level->getIndication();
    }

    /**
     * Transforms an an indication (string) to a Level object
     *
     * @param mixed $indication
     *
     * @return null|object
     * @throws TransformationFailedException
     */
    public function reverseTransform($indication)
    {
        if ( ! $indication) {
            return null;
        }

        $level = $this->entityManager
            ->getRepository('PR\Entity\Level')
            ->findOneBy(array('indication' => $indication));

        if (null === $level) {
            throw new TransformationFailedException(sprintf(
                'Level with indication "%s" does not exist!',
                $indication
            ));
        }

        return $level;
    }
}
