# oscom_responsiveimages
W3C HTML5 standard real `<picture>` adaptation for oscommerce project

## Goals
* adapt a php image cache system for media screens
* adapt html5 picture standard tag into oscommerce codebase
* research for an App solution

## Timesheet
| Project       | Start Date    | End   |
| ------------- |:-------------:| -----:|
| Initate github page | 2018-01-27 | :heavy_check_mark: |
| Research for php script | 2018-01-27 | :heavy_check_mark: |
| Rewrite v2.3 tep_image function first | 2018-01-27 | :soon: |


## Testing instructions
1. download zip file
2. unzip your catalog on desktop enviroment or upload package on live web server
3. open example.php in web browser

Note: cache directory will be created automaticaly

## PHP Script Usage in HTML
```html
<picture>
  <source media="(max-width: 640px)" srcset="<?= "resize.php?file=maxresdefault.png&size=640"; ?>">
  <source media="(max-width: 768px)" srcset="<?= "resize.php?file=maxresdefault.png&size=768";?>">
  <source media="(max-width: 1080px)" srcset="<?= "resize.php?file=maxresdefault.png&size=1080"; ?>">
  <source media="(max-width: 1280px)" srcset="<?= "resize.php?file=maxresdefault.png&size=1280"; ?>">
  <source media="(max-width: 1440px)" srcset="<?= "resize.php?file=maxresdefault.png&size=1440"; ?>">
  <img class="img-responsive" src="images/maxresdefault.png" alt="Full HD Example Picture">
</picture>
```

## Sources:
1. https://github.com/osCommerce/oscommerce2

2. https://responsiveimages.org/

## Support:
https://forums.oscommerce.com
