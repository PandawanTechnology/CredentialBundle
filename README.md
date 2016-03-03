# PandawanTechnology Credential Bundle
This symfony bundle allows you to quickly visualize your application role definitions.

## Installation
From your project root directory :
```bash
$ composer require --dev pandawan-technology/credential-bundle
```
Then enable the bundle in your application in your `app/AppKernel.php` file:
```php
    public function registerBundles()
    {
        // ... your bundles
        
        if ($this->getEnvironment() == 'dev') {
            // ... your dev bundles
            $bundles[] = new PandawanTechnology\CredentialBundle\PandawanTechnologyCredentialBundle();
        }
    }

```

And voilà. The credentials will now be available for visualisation in your web profiler.
