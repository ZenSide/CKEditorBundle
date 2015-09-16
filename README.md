ZenSide CKEditor Bundle
=======================

Replace Textarea of your project with CKEditor components. File upload is already included

1.Add Bundle to AppKernel
--------------
    public function registerBundles()
    {
        $bundles = array(
            ...
            new ZenSide\CKEditorBundle\ZenSideCKEditorBundle(),
        )
    }

2.Add route to routing.yml
--------------
    zenside_ckeditor:
        resource: "@ZenSideCKEditorBundle/Resources/config/routing.yml"

3.Add initialisation to your layout
--------------

<code>{% include 'ZenSideCKEditorBundle::ckeditor_init.html.twig' %}</code>
    
By default all <code>textarea</code> will be replaced. To filter it you can pass a css selector to the include call :

<code>{% include 'ZenSideCKEditorBundle::ckeditor_init.html.twig' with {'selector':'textarea.ckeditor' %}</code>
    
4.File Upload configuration (optional)
--------------
By default, files uploaded are moved into /web/uploads/cke. You can change this with parameter ckeditor.upload_dir in parameters.yml.
Note that this folder will be relative to /web folder (had to be visible from browser to be included in CKEditor visualisation).

    // parameters.yml
    parameters:
        ...
        ckeditor.upload_dir = "/myuploaddir"
    
5.Change CKEditor configuration (optional)
--------------
You can import (after previous include) your own config.js file to overide default bundle configuration