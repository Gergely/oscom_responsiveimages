# oscom_responsiveimages
W3C HTML5 standard real `<picture>` adaptation for oscommerce project

## Goals
* Adapt a php image cache system for media screens
* Adapt html5 picture standard tag into oscommerce codebase
* Research for an App solution

## Timesheet
| Project       | Start Date    | End   |
| ------------- |:-------------:| -----:|
| Initate github page | 2018-01-27 | :heavy_check_mark: |
| Research for php script | 2018-01-27 | :heavy_check_mark: |
| Rewrite v2.3 tep_image function | 2018-01-27 | not need if image resizer installed before |
| KISS Image provider | 2018-01-29 | :heavy_check_mark: |
| V2.4 provider | 2018-01-29 | comming soon |

## Testing instructions
1. download zip package
2. unzip your catalog on desktop enviroment or upload package on live web server
3. open example.php in web browser

Note: cache directory will be created automaticaly

## PHP Script Usage in template files
```html
<picture>
  <source media="(max-width: 640px)" srcset="<?= "resize.php?file=maxresdefault.png&size=640"; ?>">
  <source media="(max-width: 768px)" srcset="<?= "resize.php?file=maxresdefault.png&size=768"; ?>">
  <source media="(max-width: 1080px)" srcset="<?= "resize.php?file=maxresdefault.png&size=1080"; ?>">
  <source media="(max-width: 1280px)" srcset="<?= "resize.php?file=maxresdefault.png&size=1280"; ?>">
  <source media="(max-width: 1440px)" srcset="<?= "resize.php?file=maxresdefault.png&size=1440"; ?>">
  <img class="img-responsive" src="images/maxresdefault.png" alt="Full HD Example Picture">
</picture>
```

## Standalone usage
There are 2 php script in the package. First is a simple `resize.php` which be able to provide large image into required width in pixels and keep the origin aspect ratio. Second option is when KISSER contribution used and we want to use it. This file name is `kiss_resize.php`.
Both of them figured out with the same URL GET request parameters.

**Parameters:**
 - `file` - file origin large image name in source directory
 - `size` - output image width in pixels

### Standalone File Setup for v2.3 systems
Correct configure section in resize.php or in kiss_resize.php. There are two path variable to edit.
Origin settings:

**resize.php**
```php
$imagedir = "images";
$cachedir = "images/cache";
```

**kiss_resize.php**
```php
$imagedir = "images";
$cachedir = "includes/modules/kiss_image_thumbnailer/thumbs/";
```

## Use in FB feeder or somewhere else
Minimal required image size in 600px width so in php code:

```php
../../resize.php?file=<picturename>&size=600
```

in html code:
```php
<img src="https://<yourdomain>/resize.php?file=<picturename>&size=600" />
```

## Sources:
1. [oscommerce project](https://github.com/osCommerce/oscommerce2)

2. [HTML5](https://responsiveimages.org/)

## Support:
https://forums.oscommerce.com
