<?php

namespace App\Models\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait HasSpatieMedia
{
    /**
     * Saving image.
     *
     * @param string $field
     * @param UploadedFile $value
     *
     * @return void
     */
    public function saveImage(string $field, UploadedFile $value, $type = null)
    {
        $collectionName = Str::plural($field);
        $data = $this->getFirstMedia($collectionName);
        if ($value !== null) {
            if ($data !== null) {
                if ($data->file_name != $value->getClientOriginalName()) {
                    $data->delete();
                    $this->addImageByType($field, $value, $collectionName, $type);
                }
            } else {
                $this->addImageByType($field, $value, $collectionName, $type);
            }
        }
    }

    /**
     * Saving image.
     *
     * @param string $field
     * @param string $value
     *
     * @return void
     */
    public function saveImageUrl(string $field, $value, $type = null)
    {
        $collectionName = Str::plural($field);
        $data = $this->getFirstMedia($collectionName);
        if ($value !== null) {
            if ($data !== null) {
                if ($data->file_name != $value) {
                    $data->delete();
                    $this->addImageByType($field, $value, $collectionName, $type);
                }
            } else {
                $this->addImageByType($field, $value, $collectionName, $type);
            }
        }
    }

    /**
     * Adding image by type.
     *
     * @param string $field
     * @param string $value
     *
     * @return void
     */
    protected function addImageByType($field, $value, $collectionName, $type)
    {
        if ($type == null) {
            $this->addMedia($value)
                ->preservingOriginal()
                ->toMediaCollection($collectionName);
        } elseif ($type == 'request') {
            $this->addMediaFromRequest($field)->toMediaCollection($collectionName);
        } elseif ($type == 'url') {
            $this->addMediaFromUrl($value)->toMediaCollection($collectionName);
        }
    }
}