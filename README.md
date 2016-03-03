# PandawanTechnologyRoleVizBundle
This Symfony bundle allows you to quickly visualize your application role definitions.

## Installation
From your project root directory :
```bash
$ composer require --dev pandawan-technology/role-viz-bundle
```
Then enable the bundle in your application in your `app/AppKernel.php` file:
```php
    public function registerBundles()
    {
        // ... your bundles
        
        if ($this->getEnvironment() == 'dev') {
            // ... your dev bundles
            $bundles[] = new PandawanTechnology\RoleVizBundle\PandawanTechnologyRoleVizBundle();
        }
    }

```

And voilà. The roles will now be available for visualisation in your web profiler.
