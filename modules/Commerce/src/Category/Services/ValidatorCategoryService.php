<?php

namespace modules\Commerce\src\Category\Services;

use modules\Commerce\src\Category\DTO\CategoryDTO;
use modules\Commerce\src\Category\Validator\ValidatorInterface;

class ValidatorCategoryService implements  ValidatorCategoryServiceInterface
{
    /**
     * @var ValidatorInterface[] $validators
     */
    private array $validators;
    private array $errorMessages;

    /**
     * @param ValidatorInterface[] $validators
     */
    public function __construct(array $validators)
    {
        $this->validators = $validators;
        $this->errorMessages = [];
    }

    /**
     * validate if the category data is ok
     * @param CategoryDTO $categoryDTO
     * @return string
     */
    public function validated(CategoryDTO $categoryDTO): string
    {
        foreach ($this->validators as $validator) {
            $this->addErrorMessages($validator->validator($categoryDTO));
        }
        return $this->getErrorMessages();
    }

    /**
     * add message error in the array of error
     * @param string $errorMessage
     * @return void
     */
    private function addErrorMessages(string $errorMessage): void
    {
        if ($errorMessage) {
            $this->errorMessages[] = $errorMessage;
        }
    }

    /**
     * return error messages
     * @return string
     */
    public function getErrorMessages(): string
    {
        if (count($this->errorMessages) > 0) {
            return implode(', ', $this->errorMessages);
        }
        return '';
    }
}