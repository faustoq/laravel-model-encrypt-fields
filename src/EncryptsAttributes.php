<?php

namespace ModelEncryptFields;

use \Illuminate\Support\Facades\Crypt;

trait EncryptsAttributes
{
    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();
        foreach ($this->getEncrypts() as $key) {
            if (array_key_exists($key, $attributes)) {
                $attributes[$key] = $this->decrypt($attributes[$key]);
            }
        }
        return $attributes;
    }

    /**
     * Get decrypted field value
     *
     * @param mixed $key
     * @return mixed
     */
    public function getAttributeValue($key)
    {
        if (config('encrypt-fields.enabled', false) && in_array($key, $this->getEncrypts())) {
            return $this->decrypt($this->attributes[$key]);
        }
        return parent::getAttributeValue($key);
    }

    /**
     * Set encrypted field value
     *
     * @param mixed $key
     * @param mixed $value
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        if (config('encrypt-fields.enabled', false) && in_array($key, $this->getEncrypts())) {
            $this->attributes[$key] = $this->encrypt($value);
        } else {
            parent::setAttribute($key, $value);
        }

        return $this;
    }

    /**
     * Get model `encrypts` attribute
     *
     * @return mixed
     */
    protected function getEncrypts()
    {
        return property_exists($this, 'encrypts') ? $this->encrypts : [];
    }

    /**
     * Encrypt field value
     *
     * @param mixed $value
     * @return null|string
     */
    public function encrypt($value)
    {
        return is_null($value) ? $value : Crypt::encryptString($value);
    }

    /**
     * Decrypt field value
     *
     * @param mixed $value
     * @return null|string
     */
    public function decrypt($value)
    {
        return is_null($value) ? $value : Crypt::decryptString($value);
    }
}
