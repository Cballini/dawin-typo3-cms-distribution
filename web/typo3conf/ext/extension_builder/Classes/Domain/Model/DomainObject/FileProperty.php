<?php
namespace EBT\ExtensionBuilder\Domain\Model\DomainObject;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * File property
 */
class FileProperty extends AbstractProperty
{
    /**
     * the property's default value
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $defaultValue = null;
    /**
     * allowed file types for this property
     *
     * @var string (comma separated filetypes)
     */
    protected $allowedFileTypes = '';
    /**
     * not allowed file types for this property (comma-separated file types)
     *
     * @var string
     */
    protected $disallowedFileTypes = 'php';
    /**
     * flag that this property needs an upload folder
     *
     * @var bool
     */
    protected $needsUploadFolder = true;
    /**
     * @var int
     */
    protected $maxItems = 1;
    /**
     * @var string
     */
    protected $type = 'File';

    public function getTypeForComment()
    {
        return '\TYPO3\CMS\Extbase\Domain\Model\FileReference';
    }

    public function getTypeHint()
    {
        return '\TYPO3\CMS\Extbase\Domain\Model\FileReference';
    }

    public function getSqlDefinition()
    {
        return $this->getFieldName() . " int(11) unsigned NOT NULL default '0',";
    }

    /**
     * getter for allowed file types
     *
     * @return string
     */
    public function getAllowedFileTypes()
    {
        return $this->allowedFileTypes;
    }

    /**
     * setter for allowed file types
     *
     * @return string
     */
    public function setAllowedFileTypes($allowedFileTypes)
    {
        return $this->allowedFileTypes = $allowedFileTypes;
    }

    /**
     * getter for disallowed file types
     *
     * @return string
     */
    public function getDisallowedFileTypes()
    {
        return $this->disallowedFileTypes;
    }

    /**
     * setter for disallowed file types
     *
     * @return string
     */
    public function setDisallowedFileTypes($disallowedFileTypes)
    {
        return $this->disallowedFileTypes = $disallowedFileTypes;
    }

    /**
     * The string to be used inside object accessors to display this property.
     *
     * @return string
     */
    public function getNameToBeDisplayedInFluidTemplate()
    {
        return $this->name . '.originalResource.name';
    }

    /**
     * @return int
     */
    public function getMaxItems()
    {
        return $this->maxItems;
    }

    /**
     * @param int $maxItems
     */
    public function setMaxItems($maxItems)
    {
        $this->maxItems = $maxItems;
    }
}
